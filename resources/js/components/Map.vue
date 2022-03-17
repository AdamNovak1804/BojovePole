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
        float: right;
        margin-right: 10px;
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

    .btn-collapse
    {
        float: right;
        height: 50px;
        width: 50px;
        background-color: #FFF;
    }

    .map-controls
    {
        width: 300px;
    }

    .map
    {
        height: calc(100vh - 110px);
    }

    .btn-add, .btn-add:hover
    {
        border: none;
        background-image: url('../../../public/img/add.png');
        background-size: cover;
        border-radius: 50%;
        height: 75px;
        width: 75px;
        box-shadow: 0px 2px 3px #999;
    }

</style>

<template>
    <div>
        <navbar-header></navbar-header>
        <l-map class="map" :zoom="zoom" :center="center">
            <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
            <l-control position="topright">
                <div class="map-controls">
                    <b-button v-b-toggle.collapse-1 variant="primary" class="btn-collapse"></b-button>
                    <b-collapse id="collapse-1">
                        <b-card class="map-nav">
                            <h3 class="text-center">Legenda</h3>
                            <ul>
                                <li>
                                    <input type="checkbox" id="units" name="units" value="True" checked>
                                    <label for="units">
                                        Vojenské útvary
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="battles" name="battles" value="True" checked>
                                    <label for="battles">
                                        Bitky
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="cemeteries" name="cemeteries" value="True" checked>
                                    <label for="cemeteries">
                                        Cintoríny
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="sights" name="sights" value="True" checked>
                                    <label for="sights">
                                        Pamiatky
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="territories" name="territories" value="True" checked>
                                    <label for="territories">
                                        Frontová línia
                                    </label>
                                </li>
                            </ul>
                        </b-card>
                    </b-collapse>
                </div>
            </l-control>
            <l-control position="bottomright">
                <router-link to="/pridat">
                    <button class="btn-add"></button>
                </router-link>
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
