<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { onMounted, ref, computed } from "vue";
import leaflet from "leaflet";
import { usePage } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import PrimaryButton from "../Components/PrimaryButton.vue";

let map;
let vehiclesLayerGroup = ref(leaflet.layerGroup());
let trackingLayerGroup = ref(leaflet.layerGroup());
let selectedIndex = ref(0);

let truckIcon = L.icon({
    iconUrl: "/images/box-truck.png",
    iconSize: [30, 30],
});

const formatDate = (str) => {
    const oldDate = new Date(str);

    return oldDate.toString();
};

// console.log(formatDate('2022-12-29T10:03:50.000000Z'));

defineProps({
    // vehicles: Array,
    vehicleTrack: Array,
    errors: Object,
    mapProps: Object,
});

function AddTrackingToMap(vehicle) {
    // remove all layer
    console.log(vehicle);
    removeAllLayer();

    if (!vehicle.active_routes) {
        return;
    }

    trackingLayerGroup = ref(leaflet.layerGroup());
    // add marking start
    const fromLat = Number(vehicle.active_routes.from_lat);
    const fromLong = Number(vehicle.active_routes.from_long);
    const fromLatlong = leaflet.latLng(fromLat, fromLong);
    const fromMarking = leaflet
        .marker(fromLatlong)
        .bindPopup(`From: ${vehicle.active_routes.from}`);
    trackingLayerGroup.value.addLayer(fromMarking);

    // add marking end
    const toLat = Number(vehicle.active_routes.to_lat);
    const toLong = Number(vehicle.active_routes.to_long);
    const toLatlong = leaflet.latLng(toLat, toLong);
    const toMarking = leaflet
        .marker(toLatlong)
        .bindPopup(`Destination: ${vehicle.active_routes.to}`);
    trackingLayerGroup.value.addLayer(toMarking);

    if (vehicle.active_routes.vehicle_tracking.length > 0) {
        const latlngs = [fromLatlong];

        for (
            let index = vehicle.active_routes.vehicle_tracking.length - 1;
            index >= 0;
            index--
        ) {
            const currentLat = Number(
                vehicle.active_routes.vehicle_tracking[index].lat
            );
            const currentLong = Number(
                vehicle.active_routes.vehicle_tracking[index].long
            );

            const currentLatlong = leaflet.latLng(currentLat, currentLong);

            console.log('kepanggil');
            // add dot marker
            const dotMarking = leaflet.circleMarker(currentLatlong, {
                radius: 3, color: 'red',
            });

            trackingLayerGroup.value.addLayer(dotMarking);

            latlngs.push(currentLatlong);
        }

        // add marking last position
        const currentLat = Number(
            vehicle.active_routes.vehicle_tracking[0].lat
        );
        const currentLong = Number(
            vehicle.active_routes.vehicle_tracking[0].long
        );
        const currentLatlong = leaflet.latLng(currentLat, currentLong);
        const currentMarking = leaflet.marker(currentLatlong, {
            icon: truckIcon,
        }).bindPopup(`Nama Kendaraan: ${vehicle.name} <br />
                        Plat Nomor: ${vehicle.plate} <br />
                        Date and Time: ${formatDate(
                            vehicle.active_routes.vehicle_tracking[0].created_at
                        )} <br />
                        Speed: ${
                            vehicle.active_routes.vehicle_tracking[0].speed ||
                            "0"
                        } km/h`);
        trackingLayerGroup.value.addLayer(currentMarking);

        const polyline = L.polyline(latlngs, { color: "red" });
        trackingLayerGroup.value.addLayer(polyline);
    } else {
        const currentMarking = leaflet.marker(fromLatlong, { icon: truckIcon })
            .bindPopup(`Nama Kendaraan: ${vehicle.name} <br />
                        Plat Nomor: ${vehicle.plate} <br />
                        Date and Time: ${formatDate(
                            vehicle.active_routes.vehicle_tracking[0].created_at
                        )} <br />
                        Speed: ${
                            vehicle.active_routes.vehicle_tracking[0].speed ||
                            "0"
                        } km/h`);
        trackingLayerGroup.value.addLayer(currentMarking);
    }

    trackingLayerGroup.value.addTo(map);
}

function AddVehicleToMap() {
    // remove all layer first
    removeAllLayer();

    vehiclesLayerGroup = ref(leaflet.layerGroup());
    for (const vehicle of usePage().props.value.vehicleTrack) {
        const tracking = vehicle?.active_routes;

        if (tracking?.vehicle_tracking.length > 0) {
            const lat = Number(tracking.vehicle_tracking[0].lat);
            const long = Number(tracking.vehicle_tracking[0].long);

            const latlong = leaflet.latLng(lat, long);
            const mark = leaflet.marker(latlong, { icon: truckIcon })
                .bindPopup(`Nama Kendaraan: ${vehicle.name} <br />
                        Plat Nomor: ${vehicle.plate} <br />
                        Date and Time: ${formatDate(
                            vehicle.active_routes.vehicle_tracking[0].created_at
                        )} <br />
                        Speed: ${
                            vehicle.active_routes.vehicle_tracking[0].speed ||
                            "0"
                        } km/h`);
            vehiclesLayerGroup.value.addLayer(mark);
        }
    }

    vehiclesLayerGroup.value.addTo(map);
}

function removeVehicleGroupLayer() {
    map.removeLayer(vehiclesLayerGroup.value);
}

function removeTrackingGroupLayer() {
    map.removeLayer(trackingLayerGroup.value);
}

function removeAllLayer() {
    removeVehicleGroupLayer();
    removeTrackingGroupLayer();
}

function onChangeTracking(event) {
    selectedIndex.value = event.target.selectedIndex;
    updateMap();
}

function updateMap() {
    if (selectedIndex.value === 0) {
        AddVehicleToMap();
    } else {
        AddTrackingToMap(
            usePage().props.value.vehicleTrack[selectedIndex.value - 1]
        );
    }
}

onMounted(() => {
    window.Echo.channel("tracking").listen(
        "VehicleTrackingEvent",
        async (e) => {
            // reload all data
            await Inertia.reload({
                onFinish: () => updateMap(),
            });
        }
    );

    // init map
    map = leaflet.map("map").setView([-2.54893, 118.01486], 5);

    //add tile layer
    leaflet
        .tileLayer(
            `https://api.mapbox.com/styles/v1/${
                usePage().props.value.mapProps.user
            }/${
                usePage().props.value.mapProps.style
            }/tiles/256/{z}/{x}/{y}@2x?access_token=${
                usePage().props.value.mapProps.token
            }`,
            {
                maxZoom: 15,
                attribution:
                    '&copy; <a href="http://www.openstreetmap.org/copyright">MapBox</a> <a href="https://www.flaticon.com/free-icons/truck" title="truck icons">Truck icons created by Freepik - Flaticon</a>',
            }
        )
        .addTo(map);

    AddVehicleToMap();
    // AddTrackingToMap(usePage().props.value.vehicleTrack[0]);
    // removeTrackingGroupLayer();
});
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="flex">
            <div id="map" class="h-screen w-full z-0"></div>
            <div class="m-2 relative">
                <label
                    for="location"
                    class="block text-sm font-medium text-gray-700"
                    >Tracking</label
                >
                <select
                    id="tracking"
                    name="tracking"
                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                    @change.prevent="onChangeTracking($event)"
                >
                    <option :value="null" selected="">All</option>
                    <option
                        v-for="vehicle in vehicleTrack"
                        :value="vehicle"
                        :key="vehicle.id"
                    >
                        {{ vehicle.name }}
                    </option>
                </select>
                <a :href="route('reportcsv')">
                    <PrimaryButton class="mt-4 w-44">
                        <svg
                            aria-hidden="true"
                            focusable="false"
                            data-prefix="fas"
                            data-icon="download"
                            class="w-3 mr-2"
                            role="img"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"
                        >
                            <path
                                fill="currentColor"
                                d="M216 0h80c13.3 0 24 10.7 24 24v168h87.7c17.8 0 26.7 21.5 14.1 34.1L269.7 378.3c-7.5 7.5-19.8 7.5-27.3 0L90.1 226.1c-12.6-12.6-3.7-34.1 14.1-34.1H192V24c0-13.3 10.7-24 24-24zm296 376v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h146.7l49 49c20.1 20.1 52.5 20.1 72.6 0l49-49H488c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"
                            ></path>
                        </svg>
                        Weekly Report
                    </PrimaryButton>
                </a>
            </div>
        </div>
    </AppLayout>
</template>
<style>
.doticon {
    height: 25px;
    width: 25px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
}
</style>
