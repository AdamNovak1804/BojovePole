<template>
    <b-modal
        size="xl"
        hide-footer
        ref="unit-modal"
    >
        <b-card-body>
            <h3 class="modal-title">
                {{ this.name }}
            </h3>
        </b-card-body>

        <b-carousel
            v-if="this.gallery"
            background="#ababab"
            :interval="4000"
            controls
            fade
        >
            <b-carousel-slide
                v-for="slide in this.gallery.images"
                :key="slide.id"
            >
                <template #img>
                    <img
                        class="d-block img-fluid slide-img"
                        :src="'/api/userContent/' + slide.path"
                        alt="image slot"
                    >
                </template>
            </b-carousel-slide>
        </b-carousel>
        <b-card-body>
            <b-row>
                <b-col cols="12" lg="4">
                    <label class="label-center fw-bold mb-3" for="info-box">
                        Základné informácie
                    </label>
                    <b-list-group id="info-box" flush>
                        <b-list-group-item>
                            <b-row>
                                <b-col>
                                    <p><b>Typ útvaru</b> :</p>
                                </b-col>
                                <b-col cols="auto">
                                    <p>{{ this.type }}</p>
                                </b-col>
                            </b-row>
                        </b-list-group-item>
                        <b-list-group-item>
                            <b-row>
                                <b-col>
                                    <p><b>Lokácia</b> :</p>
                                </b-col>
                                <b-col cols="auto">
                                    <p>{{ this.location }}</p>
                                </b-col>
                            </b-row>
                        </b-list-group-item>
                        <b-list-group-item>
                            <b-row>
                                <b-col>
                                    <p><b>Krajina pôvodu</b> :</p>
                                </b-col>
                                <b-col cols="auto">
                                    <p>{{ this.country }}</p>
                                </b-col>
                            </b-row>
                        </b-list-group-item>
                    </b-list-group>
                </b-col>
                <b-col>
                    <label class="label-center fw-bold mb-3" for="description-box">
                        História a opis vojenskej jednotky
                    </label>
                    <div id="description-box">
                        <p>{{ this.description }}</p>
                    </div>
                </b-col>
            </b-row>
        </b-card-body>

    </b-modal>
</template>

<script>

    export default {
        mounted() {
            console.log('Component mounted.');
        },

        data() {
            return {
                name: '',
                type: '',
                location: '',
                country: '',
                description: '',
                reliability: '',
                gallery: '',

                types: [
                    { id: 1, text: 'Peší pluk', value: 'a' },
                    { id: 2, text: 'Honvédsky peší pluk', value: 'b' },
                    { id: 3, text: 'Prápor poľných strelcov', value: 'c' },
                    { id: 4, text: 'Poľný delostrelecký pluk', value: 'd' },
                    { id: 5, text: 'Ťažký poľný delostrelecký pluk', value: 'e' }
                ]
            }
        },

        props: {
            unit: ''
        },

        methods: {            
            showModal: function() {
                this.name = this.unit.name;
                this.location = this.unit.location;
                this.country = this.unit.country.name;

                var tmp = this.types.find((e) => e.value == this.unit.type);
                this.type = tmp.text;
    
                this.description = this.unit.description;

                this.gallery = JSON.parse(this.unit.gallery);

                this.$refs['unit-modal'].show();
            }
        }
    }

</script>