<style scoped>

    .map
    {
        border-radius: 5px;
        border: 2px solid #540202;
        height: 500px;
    }

</style>

<template>
    <l-map id="addMap" ref="addMap" class="map" :zoom="zoom" :center="center" @click="updateMarker">
        <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
        <l-marker :lat-lng="position" :visible="visibility" />
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

                visibility: false,
                position: L.latLng(48.811280, 19.506797),
                
            }
        },

        methods: {
            updateMarker: function(event) {
                this.visibility = true;
                this.position = event.latlng;
                this.$emit('changeMarker', this.position);
            },

            refreshSize: function() {
                this.$refs.addMap.mapObject.invalidateSize();
            }
        }

    }

</script>
