<style scoped>

    ul
    {
        list-style: none;
        padding: 0px 20px 10px 20px;
    }

    li
    {
        padding: 5px;
    }

    .navbar-custom
    {
        position: relative !important;
    }

    .map-nav
    {
        border-radius: 25px;
        background-color: #EDE0A6;
        box-shadow: 0px 2px 3px #999;
    }

    .map-nav h3
    {
        padding-top: 10px;
    }

    .map-nav label
    {
        padding-left: 5px;
    }

</style>

<template>
    <div>
        <navbar-header></navbar-header>
        <l-map :zoom="zoom" :center="center">
            <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
            <l-control position="topright">
                <b-button v-b-toggle.collapse-1 variant="primary">Toggle Collapse</b-button>
                <b-collapse id="collapse-1">
                    <b-card>
                        <h3 class="text-center">Legenda</h3>
                        <ul>
                            <li>
                                <input type="checkbox" id="units" name="units" value="True">
                                <label for="units">
                                    Vojenské útvary
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="battles" name="battles" value="True">
                                <label for="battles">
                                    Bitky
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="cemeteries" name="cemeteries" value="True">
                                <label for="cemeteries">
                                    Cintoríny
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="sights" name="sights" value="True">
                                <label for="sights">
                                    Pamiatky
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="territories" name="territories" value="True">
                                <label for="territories">
                                    Frontová línia
                                </label>
                            </li>
                        </ul>
                    </b-card>
                </b-collapse>
                <div class="map-nav">
                </div>
            </l-control>
        </l-map>
    </div>
</template>

<script>
    import L from 'leaflet';
    import { LMap, LTileLayer, LMarker, LControl } from 'vue2-leaflet';
    import { BButton, VBToggle, BCard, BCollapse } from 'bootstrap-vue';

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
        components: {
            LMap,
            LTileLayer,
            LMarker,
            LControl,
            BButton,
            VBToggle,
            BCard,
            BCollapse,
        },

    };

</script>
