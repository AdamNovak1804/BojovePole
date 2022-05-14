<template>
    <form action="POST" @submit.prevent="">
        <b-modal
            size="xl"
            ref="territory-edit-view"
            hide-footer
            @shown="reloadSize()"
        >
            <h1 class="text-center">Návrh o pridaní frontovej línie</h1>
            <territory-map
                ref="territory-edit-map"
                v-on:changeMarker="updateLatLng"
                :vertices="polygon"
            />
            <b-row no-gutters class="mt-3">
                <b-col>
                    <label class="label-form" for="territory-edit-start-date">
                        Začiatok
                    </label>
                    <input class="date-input" v-model="form.start_date" type="date" name="territory-edit-start-date" id="territory-edit-start-date">
                </b-col>
                <b-col>
                    <label class="label-form" for="territory-edit-end-date">
                        Koniec
                    </label>
                    <input class="date-input" v-model="form.end_date" type="date" name="territory-edit-end-date" id="territory-edit-end-date">
                </b-col>
                <b-col>
                    <label class="label-form" for="territory-edit-country">
                        Krajina
                    </label>
                    <select class="options" v-model="form.country" name="territory-edit-country" id="territory-edit-country">
                        <option
                            v-for="country in countries"
                            v-bind:value="country.id"
                            :key="country.id"
                        >
                            {{ country.name }}
                        </option>
                    </select>
                </b-col>
            </b-row>
            <edit-footer
                v-on:saveRequest="saveRequest"
                v-on:deleteRequest="deleteRequest"
                v-on:uploadRequest="uploadRequest"
                v-on:reliabilityChange="reliabilityChange"
            />
        </b-modal>
        <b-modal
            ref="error-modal"
            hide-footer
        >
            <error-list 
                :errors="errors"
            />
        </b-modal>
    </form>
</template>

<script>

    export default {
        data() {
            return {
                form: {
                    visible: 0,
                    start_date: '',
                    end_date: '',
                    country: '',
                    color: '',
                    reliability: ''
                },

                polygon: '',
                gallery: '',
                countries: '',
                errors: '',
            }
        },

        mounted() {
            console.log('Component mounted.');

            this.getCountries();
        },

        props: {
            territory: ''
        },

        methods: {
            getCountries: function() {
                axios.get('/api/get_countries').then((response) => {
                    this.countries = response.data;
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            showModal: function() {
                this.form.id = this.territory.id;
                this.form.start_date = this.territory.start_date;
                this.form.end_date = this.territory.end_date;
                this.form.country = parseInt(this.territory.country.id);
                this.form.color = this.territory.color;
                this.polygon = this.territory.map;

                this.$refs['territory-edit-view'].show();
            },

            createForm: function() {
                var formData = new FormData();

                formData.append('id', this.form.id);
                formData.append('visible', this.form.visible);
                formData.append('start_date', this.form.start_date);
                formData.append('end_date', this.form.end_date);
                formData.append('country', this.form.country);
                formData.append('color', this.form.color);
                
                if ( this.territory.map ) {
                    var map = JSON.parse(this.territory.map);
                    for ( var i = 0; i < map.vertices.length; i++ ) {
                        formData.append('map[' + i + ']', 
                            [ map.vertices[i][0], map.vertices[i][1] ]
                        );
                    }
                }
                else {
                    formData.append('map', '');
                }

                return formData;
            },

            saveRequest: function() {
                var form = this.createForm();

                axios.post('/api/update_territory', form).then(() => {
                    alert('Zmeny boli úspešne uložené!');
                }).catch((error) => {
                    this.displayErrors(error.response.data.errors);
                });
            },

            uploadRequest: function() {
                this.form.visible = 1;
                var form = this.createForm();

                axios.post('/api/update_territory', form).then(() => {
                    alert('Objekt bol úspešne zverejnený!');
                }).catch((error) => {
                    this.displayErrors(error.response.data.errors);
                });
            },

            deleteRequest: function() {
                axios.delete('/api/delete_territory', { data: this.form }).then(() => {
                    alert('Žiadosť bola úspešne odstránená!');
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            displayErrors: function(value) {
                this.errors = value;
                this.$refs['error-modal'].show();
            },

            updateLatLng: function(value) {
                this.form.position = value;
            },

            reloadSize: function() {
                this.$refs['territory-edit-map'].refreshSize();
            },

            reliabilityChange: function(value) {
                this.form.reliability = value;
            }
        }
    }

</script>