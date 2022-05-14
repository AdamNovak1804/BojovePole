<style scoped>

    .map
    {
        border-radius: 5px;
        border: 2px solid #540202;
        height: 500px;
    }

</style>

<template>
    <div>
        <l-map id="addMap" ref="addMap" class="map" :zoom="zoom" :center="center" @click="updateMarker">
            <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
            <l-polygon
                :color="this.polygon.color"
                :lat-lngs="this.vertices ? JSON.parse(this.vertices).vertices : this.polygon.vertices"
            />
        </l-map>
    </div>
</template>

<script>

    export default {

        mounted() {
            console.log('Component mounted.');
        },

        name: 'Map',
        data: function() {
            return {
                zoom: 8,
                center: L.latLng(48.811280, 19.506797),
                url: 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a target="_blank" href="http://osm.org/copyright">OpenStreetMap</a> contributors',

                visibility: false,
                position: L.latLng(48.811280, 19.506797),
                
                polygon: {
                    color: 'red',
                    vertices: []
                }
            }
        },

        props: {
            vertices: ''
        },

        methods: {
            updateMarker: function(event) {
                this.polygon.vertices.push(event.latlng)
                this.$emit('updatePolygon', this.polygon);
            },

            refreshSize: function() {
                this.$refs.addMap.mapObject.invalidateSize();
            }
        }

    }

</script>
