<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { onMounted } from "vue";
import leaflet from "leaflet";
import { usePage } from "@inertiajs/inertia-vue3";

let map;

onMounted(() => {
  console.log(usePage().props.value);
  // init map
  map = leaflet.map("map").setView([-2.54893, 118.01486], 5);

  //add tile layer
  leaflet
    .tileLayer(`https://api.mapbox.com/styles/v1/cahyopermono/clbiqwbm4000b14nytxkvrv3j/tiles/256/{z}/{x}/{y}@2x?access_token=${usePage().props.value.maptoken}`, {
    // .tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
      maxZoom: 10,
      attribution:
        '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    })
    .addTo(map);
});
</script>

<template>
  <AppLayout title="Dashboard">
    <div class="h-screen relative">
      <div id="map" class="h-full z-0"></div>
    </div>
  </AppLayout>
</template>
