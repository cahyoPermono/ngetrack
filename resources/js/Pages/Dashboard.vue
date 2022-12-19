<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { onMounted, ref } from "vue";
import leaflet from "leaflet";
import { usePage } from "@inertiajs/inertia-vue3";

let map;
let vehiclesLayerGroup = ref(leaflet.layerGroup());

let truckIcon = L.icon({
    iconUrl: '/images/box-truck.png',
    iconSize: [30, 30],
});

defineProps({
  vehicles: Array,
  errors: Object,
  mapProps: Object,
});

function AddVehicleToMap(){
  for (const vehicle of usePage().props.value.vehicles) {
    const tracking = vehicle?.active_routes?.last_tracking;

    if(tracking){
      const lat = Number(tracking.lat);
      const long = Number(tracking.long);

      const latlong = leaflet.latLng(lat,long);
      const mark = leaflet.marker(latlong, {icon: truckIcon}).bindPopup(`${vehicle.name}`);
      vehiclesLayerGroup.value.addLayer(mark)
    }
  }

  vehiclesLayerGroup.value.addTo(map);
}

function RemoveVehicleLayer(){
  map.removeLayer(vehiclesLayerGroup.value);
}

onMounted(() => {
  console.log(usePage().props.value);
  console.log(usePage().props.value.vehicles[0].active_routes.last_tracking);
  // init map
  map = leaflet.map("map").setView([-2.54893, 118.01486], 5);

  //add tile layer
  leaflet
    .tileLayer(
      `https://api.mapbox.com/styles/v1/${usePage().props.value.mapProps.user}/${usePage().props.value.mapProps.style}/tiles/256/{z}/{x}/{y}@2x?access_token=${
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
});
</script>

<template>
  <AppLayout title="Dashboard">
    <div class="h-screen relative">
      <div id="map" class="h-full z-0"></div>
    </div>
  </AppLayout>
</template>
