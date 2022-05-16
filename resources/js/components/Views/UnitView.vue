<template>
    <div>
        <b-modal
            size="xl"
            hide-footer
            ref="unit-modal"
        >
            <b-card-body>
                <b-row class="d-flex align-items-end">
                    <b-col>
                        <h3 class="modal-title">{{ this.name }}</h3>
                    </b-col>
                    <b-col class="text-end">
                        <p style="margin-bottom: 0;">Dôveryhodnosť informácie: {{ this.reliability }} / <b>5</b></p>
                    </b-col>
                </b-row>
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
                <label class="label-center fw-bold" for="unit-members">
                    V útvare slúžili:
                </label>
                <div class="mt-3" id="unit-members" name="unit-members">
                    <ul class="member-ul">
                        <li
                            class="member-li"
                            v-for="member in members"
                            :key="'family-member' + member.id"
                        >
                            <b-row class="justif-space-between" align-v="center">
                                <b-col>
                                    <p class="member-text">{{ member.name }}</p>
                                </b-col>
                                <b-col cols="auto">
                                    <button @click="showMember(member)" class="btn btn-action">Zobraziť podrobnosti</button>
                                </b-col>
                            </b-row>
                        </li>
                    </ul>
                </div>
            </b-card-body>
        </b-modal>
        <family-member-view
            ref="family-member-view"
            :member="this.member"
        />
    </div>
</template>

<script>

    export default {
        mounted() {
            console.log('Component mounted.');
        },

        data() {
            return {
                reliability: '',
                name: '',
                type: '',
                location: '',
                country: '',
                description: '',
                reliability: '',
                gallery: '',

                members: '',
                member: '',

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
            getUnitMembers: function() {
                axios.get('/api/get_unit_members', { params: { id: this.unit.id } }).then((response) => {
                    this.members = response.data;
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            showMember: function(member) {
                this.member = member;
                this.$refs['family-member-view'].showModal();
            },

            showModal: function() {
                this.getUnitMembers();

                this.reliability = this.unit.reliability;
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