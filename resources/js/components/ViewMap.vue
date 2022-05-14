<style scoped>

    ul
    {
        padding-left: 0;
        margin-bottom: 10px;
        list-style: none;
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
        width: 280px;
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
        outline: none;
        border-radius: 5px;
        padding: 0 !important;
        height: 50px;
        width: 50px;
        float: right;
        background-color: transparent;
    }

    .btn:focus {
        box-shadow: none;
    }

    .btn-img
    {
        border-radius: 5px;
        height: 50px;
        width: 50px;
        background-size: cover;
        background-repeat: no-repeat;
        box-shadow: 0px 2px 3px #999;
    }

    .map-controls
    {
        min-width: 400px;
    }

    .map
    {
        height: calc(100vh - 110px);
    }

    .btn-add, .btn-add:hover
    {
        border: none;
        background-image: url('/images/btn-add.png');
        background-size: cover;
        border-radius: 50%;
        height: 75px;
        width: 75px;
        box-shadow: 0px 2px 3px #999;
    }

    .col-legend
    {
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .date-input
    {
        background-color: #540202;
        color: #EDE0A6
    }

    .icon-legend
    {
        width: auto;
        margin-top: 5px;
        margin-bottom: 5px;
        height: 28px;
    }

</style>

<template>
    <l-map class="map" :zoom="zoom" :center="center" @click="hidePreview">
        <l-tile-layer :url="url" :attribution="attribution" />
        <l-control position="topright">
            <div class="map-controls">
                <button class="btn btn-collapse" @click="changeState()" v-b-toggle.collapse-1 variant="primary">
                    <img class="btn-img" :src="'/api/image/' + this.button">
                </button>
                <b-collapse id="collapse-1">
                    <b-card class="map-nav">
                        <h3 class="text-center">Legenda</h3>
                        <b-row class="justify-content-between">
                            <b-col class="col-legend">
                                <input type="checkbox" id="units" name="units" value="True" @change="display_units = !display_units" checked>
                                <label for="units">Vojenské útvary</label>
                            </b-col>
                            <b-col cols="auto">
                                <img class="icon-legend" :src="'/images/icon-unit.png'">
                            </b-col>
                        </b-row>
                        <b-row class="justify-content-between">
                            <b-col class="col-legend">
                                <input type="checkbox" id="battles" name="battles" value="True" @change="display_battles = !display_battles" checked>
                                <label for="battles">Bitky</label>
                            </b-col>
                            <b-col cols="auto">
                                <img class="icon-legend" :src="'/images/icon-battle.png'">
                            </b-col>
                        </b-row>
                        <b-row class="justify-content-between">
                            <b-col class="col-legend">
                                <input type="checkbox" id="cemeteries" name="cemeteries" value="True" @change="display_cemeteries = !display_cemeteries" checked>
                                <label for="cemeteries">Cintoríny</label>
                            </b-col>
                            <b-col cols="auto">
                                <img class="icon-legend" :src="'/images/icon-cemetery.png'">
                            </b-col>
                        </b-row>
                        <b-row class="justify-content-between">
                            <b-col class="col-legend">
                                <input type="checkbox" id="landmarks" name="landmarks" value="True" @change="display_landmarks = !display_landmarks" checked>
                                <label for="landmarks">Pamiatky</label>
                            </b-col>
                            <b-col cols="auto">
                                <img class="icon-legend" :src="'/images/icon-landmark.png'">
                            </b-col>
                        </b-row>
                        <b-row class="justify-content-between">
                            <b-col class="col-legend">
                                <input type="checkbox" id="territories" name="territories" value="True" @change="display_territories = !display_territories" checked>
                                <label for="territories">Frontová línia</label>
                            </b-col>
                        </b-row>
                        <div>
                            <h3 class="text-center">Zvoliť časový rozsah</h3>
                            <b-row>
                                <b-col cols="6">
                                    <label class="label-form" for="start-date">Od:</label>
                                    <input class="date-input" v-model="interval.start" @change="sliceTerritories()" type="date" name="start-date" id="start-date">
                                </b-col>
                                <b-col cols="6">
                                    <label class="label-form" for="end-date">Do:</label>
                                    <input class="date-input" v-model="interval.end" @change="sliceTerritories()" type="date" name="end-date" id="end-date">
                                </b-col>
                            </b-row>
                        </div>
                    </b-card>
                </b-collapse>
            </div>
        </l-control>
        <l-control position="bottomright">
            <router-link to="/pridat">
                <button class="btn-add"></button>
            </router-link>
        </l-control>
        
        <!-- Previews -->

        <l-control position="bottomleft">
            <unit-preview
                v-on:displayView="displayView"
                :type="this.type"
                :displayed="this.displayed"
            />
            <battle-preview
                v-on:displayView="displayView"
                :type="this.type"
                :displayed="this.displayed"
            />
            <cemetery-preview
                v-on:displayView="displayView"
                :type="this.type"
                :displayed="this.displayed"
            />
            <landmark-preview
                v-on:displayView="displayView"
                :type="this.type"
                :displayed="this.displayed"
            />
        </l-control>

        <!-- Views -->
        
        <unit-view
            ref="unit-view"
            :unit="this.displayed"
        />
        <battle-view
            ref="battle-view"
            :battle="this.displayed"
        />
        <cemetery-view
            ref="cemetery-view"
            :cemetery="this.displayed"
        />
        <landmark-view
            ref="landmark-view"
            :landmark="this.displayed"
        />

        <!-- Map markers -->

        <l-marker
            v-for="unit in sorted.units"
            :key="'unit-' + unit.id"
            :lat-lng="[unit.latitude, unit.longtitude]"
            :visible="display_units"
            @click="displayPreview(unit.id, 'unit-preview', sorted.units)"
        >
            <l-icon
                icon-url="/images/icon-unit.png"
                :icon-size="[35, 57.4]"
                :icon-anchor="[17.5, 57.4]"
            />
        </l-marker>
        <l-marker
            v-for="battle in sorted.battles"
            :key="'battle-' + battle.id"
            :lat-lng="[battle.latitude, battle.longtitude]"
            :visible="display_battles"
            @click="displayPreview(battle.id, 'battle-preview', sorted.battles)"
        >
            <l-icon
                icon-url="/images/icon-battle.png"
                :icon-size="[35, 57.4]"
                :icon-anchor="[17.5, 57.4]"
            />
        </l-marker>
        <l-marker
            v-for="cemetery in sorted.cemeteries"
            :key="'cemetery-' + cemetery.id"
            :lat-lng="[cemetery.latitude, cemetery.longtitude]"
            :visible="display_cemeteries"
            @click="displayPreview(cemetery.id, 'cemetery-preview', sorted.cemeteries)"
        >
            <l-icon
                icon-url="/images/icon-cemetery.png"
                :icon-size="[35, 57.4]"
                :icon-anchor="[17.5, 57.4]"
            />
        </l-marker>
        <l-marker
            v-for="landmark in sorted.landmarks"
            :key="'landmark-' + landmark.id"
            :lat-lng="[landmark.latitude, landmark.longtitude]"
            :visible="display_landmarks"
            @click="displayPreview(landmark.id, 'landmark-preview', sorted.landmarks)"
        >
            <l-icon
                icon-url="/images/icon-landmark.png"
                :icon-size="[35, 57.4]"
                :icon-anchor="[17.5, 57.4]"
            />
        </l-marker>
        <l-polygon
            v-for="polygon in territories_sliced"
            :key="'polygon' + polygon.id"
            :color="polygon.color"
            :lat-lngs="(JSON.parse(polygon.map)).vertices"
            :visible="display_territories"
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

                markers: {
                    units: '',
                    battles: '',
                    cemeteries: '',
                    landmarks: '',
                    territories: ''
                },

                sorted: {
                    units: '',
                    battles: '',
                    cemeteries: '',
                    landmarks: '',
                    territories: ''
                },

                territories_sliced: '',

                interval: {
                    start: '1914-07-28',
                    end: '1918-11-11'
                },

                type: '',
                displayed: null,
                button: 'btn-map-closed.png',

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
                    this.markers.units = response.data;
                    this.sorted.units = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },

            getBattles: function() {
                axios.get('/api/get_battles').then(response => {
                    this.markers.battles = response.data;
                    this.sorted.battles = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },

            getCemeteries: function() {
                axios.get('/api/get_cemeteries').then(response => {
                    this.markers.cemeteries = response.data;
                    this.sorted.cemeteries = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },

            getLandmarks: function() {
                axios.get('/api/get_landmarks').then(response => {
                    this.markers.landmarks = response.data;
                    this.sorted.landmarks = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },

            getTerritories: function() {
                axios.get('/api/get_territories').then(response => {
                    this.markers.territories = response.data;
                    this.sorted.territories = response.data;
                    this.territories_sliced = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },

            displayPreview: function(value, string, markers) {
                this.type = string;
                this.displayed = markers.find((e) => e.id == value);
            },

            displayView: function({ view }) {
                this.$refs[view].showModal();
            },

            hidePreview: function() {
                this.type = '';
            },

            changeState: function() {
                if ( this.button === 'btn-map-open.png' ) {
                    this.button = 'btn-map-closed.png';
                }
                else {
                    this.button = 'btn-map-open.png';
                }
            },

            sliceTerritories: function() {
                var start, end, h_start, h_end, tmp;
                tmp = [];

                h_start = new Date('1914-07-28');
                h_end = new Date('1918-11-11');

                start = new Date(this.interval.start);
                end = new Date(this.interval.end);

                // check if date is not before start of war
                if ( start < h_start ) {
                    this.interval.start = '1914-07-28';
                    start = h_start;
                }
                else if ( start > h_end ) {
                    this.interval.start = '1918-11-11';
                    start = h_end;
                }

                // check if date is not after the end of war
                if ( end > h_end ) {
                    this.interval.end = '1918-11-11';
                    end = h_end;
                }
                else if ( end < h_start ) {
                    this.interval.end = '1914-07-28';
                    end = h_start;
                }

                // check if start and finish dates are in logical order
                if ( start > end ) {
                    this.interval.end = this.interval.start;
                    end = start;
                }

                // find territories within fit interval
                for ( var i = 0; i < this.sorted.territories.length; i++ ) {
                    var this_start = new Date(this.sorted.territories[i].start_date);
                    var this_end = new Date(this.sorted.territories[i].end_date);

                    if ( (this_start >= start) && (this_end <= end) ) {
                        tmp.push(this.sorted.territories[i]);
                    }
                }

                this.territories_sliced = tmp;
            }
        }

    }

</script>
