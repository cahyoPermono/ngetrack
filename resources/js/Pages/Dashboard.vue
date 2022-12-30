<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { onMounted, ref, watch } from "vue";
import leaflet from "leaflet";
import { usePage } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import DialogModal from "../Components/DialogModal.vue";

let map;
let vehiclesLayerGroup = ref(leaflet.layerGroup());
let trackingLayerGroup = ref(leaflet.layerGroup());
let selectedIndex = ref(0);

let truckIcon = L.icon({
    iconUrl: "/images/box-truck.png",
    iconSize: [30, 30],
});

defineProps({
    // vehicles: Array,
    vehicleTrack: Array,
    errors: Object,
    mapProps: Object,
});

function AddTrackingToMap(vehicle) {
    // remove all layer
    removeAllLayer();

    if(!vehicle.active_routes){
        return
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

    if (vehicle.active_routes.vehicle_tracking) {
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
            console.log("test", { currentLat, currentLong, index });
            const currentLatlong = leaflet.latLng(currentLat, currentLong);

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
        const currentMarking = leaflet
            .marker(currentLatlong, { icon: truckIcon })
            .bindPopup(`${vehicle.name}`);
        trackingLayerGroup.value.addLayer(currentMarking);

        const polyline = L.polyline(latlngs, { color: "red" });
        trackingLayerGroup.value.addLayer(polyline);
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
            const mark = leaflet
                .marker(latlong, { icon: truckIcon })
                .bindPopup(`${vehicle.name}`);
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
    window.Echo.channel("tracking").listen("VehicleTrackingEvent", async (e) => {
        // reload all data
        await Inertia.reload({
          onFinish: () => updateMap(),
        });
    });
    console.log(usePage().props.value);
    // console.log(usePage().props.value.vehicles[0].active_routes.last_tracking);
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
                maxZoom: 10,
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
            </div>
        </div>
    </AppLayout>
</template>
