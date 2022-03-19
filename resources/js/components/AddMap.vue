<style scoped>

    .map
    {
        border-radius: 5px;
        border: 2px solid #540202;
        height: 500px;
    }

</style>

<template>
    <l-map class="map" :zoom="zoom" :center="center">
        <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
    </l-map>
</template>

<script>

    export default {

        name: 'Map',
        data: function() {
            return {
                zoom: 8,
                center: L.latLng(48.811280, 19.506797),
                url: 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a target="_blank" href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                marker: L.latLng(48.811280, 19.506797),
            }
        },

    }

</script>
