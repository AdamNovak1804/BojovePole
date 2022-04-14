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
                                <input type="checkbox" id="units" name="units" value="True" @change="display_units = !display_units" checked>
                                <label for="units">
                                    Vojenské útvary
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="battles" name="battles" value="True" @change="display_battles = !display_battles" checked>
                                <label for="battles">
                                    Bitky
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="cemeteries" name="cemeteries" value="True" @change="display_cemeteries = !display_cemeteries" checked>
                                <label for="cemeteries">
                                    Cintoríny
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="sights" name="landmarks" value="True" @change="display_landmarks = !display_landmarks" checked>
                                <label for="landmarks">
                                    Pamiatky
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="territories" name="territories" value="True" @change="display_territories = !display_territories" checked>
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
        <l-marker
            v-for="unit in units"
            :key="'unit-' + unit.id"
            :lat-lng="[unit.latitude, unit.longtitude]"
            :visible="display_units"
        />
        <l-marker
            v-for="battle in battles"
            :key="'battle-' + battle.id"
            :lat-lng="[battle.latitude, battle.longtitude]"
            :visible="display_battles"
        />
        <l-marker
            v-for="cemetery in cemeteries"
            :key="'cemtery-' + cemetery.id"
            :lat-lng="[cemtery.latitude, cemetery.longtitude]"
            :visible="display_cemeteries"
        />
        <l-marker
            v-for="landmark in landmarks"
            :key="'landmark-' + landmark.id"
            :lat-lng="[landmark.latitude, landmark.longtitude]"
            :visible="display_landmarks"
        />
    </l-map>
</template>

<script>

    export default {

        name: 'Map',
        data() {
            return {
                zoom: 8,
                center: L.latLng(48.811280, 19.506797),
                url: 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a target="_blank" href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                marker: L.latLng(48.811280, 19.506797),

                units: '',
                battles: '',
                cemeteries: '',
                landmarks: '',
                territories: '',

                display_units: true,
                display_battles: true,
                display_cemeteries: true,
                display_landmarks: true,
                display_territories: true,
            }
        },

        mounted() {
            console.log('Component mounted.');
            
            this.getUnits();
            this.getBattles();
            this.getCemeteries();
            this.getLandmarks();
            this.getTerritories();
        },

        methods: {
            getUnits: function() {
                axios.get('/api/get_units').then(response => {
                    this.units = response.data;
                    console.log(this.units);
                }).catch(error => {
                    console.log(error);
                });
            },

            getBattles: function() {
                axios.get('/api/get_battles').then(response => {
                    this.battles = response.data;
                    console.log(this.battles);
                }).catch(error => {
                    console.log(error);
                });
            },

            getCemeteries: function() {
                axios.get('/api/get_cemeteries').then(response => {
                    this.cemeteries = response.data;
                    console.log(this.cemeteries);
                }).catch(error => {
                    console.log(error);
                });
            },

            getLandmarks: function() {
                axios.get('/api/get_landmarks').then(response => {
                    this.landmarks = response.data;
                    console.log(this.landmarks);
                }).catch(error => {
                    console.log(error);
                });
            },

            getTerritories: function() {
                axios.get('/api/get_territories').then(response => {
                    this.territories = response.data;
                    console.log(this.territories);
                }).catch(error => {
                    console.log(error);
                });
            }
        }

    }

</script>
