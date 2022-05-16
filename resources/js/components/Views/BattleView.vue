<template>
    <b-modal
        size="xl"
        hide-footer
        ref="battle-modal"
    >
        <b-card-body>
            <b-row class="d-flex align-items-end">
                <b-col>
                    <h3 class="modal-title">{{ this.title }}</h3>
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
                                    <p><b>Začiatok</b> :</p>
                                </b-col>
                                <b-col cols="auto">
                                    <p>{{ formatDate(this.start) }}</p>
                                </b-col>
                            </b-row>
                        </b-list-group-item>
                        <b-list-group-item>
                            <b-row>
                                <b-col>
                                    <p><b>Koniec</b> :</p>
                                </b-col>
                                <b-col cols="auto">
                                    <p>{{ formatDate(this.end) }}</p>
                                </b-col>
                            </b-row>
                        </b-list-group-item>
                        <b-list-group-item>
                            <b-row>
                                <b-col>
                                    <p><b>Útočník</b> :</p>
                                </b-col>
                                <b-col cols="auto">
                                    <p>{{ this.side1 }}</p>
                                </b-col>
                            </b-row>
                        </b-list-group-item>
                        <b-list-group-item>
                            <b-row>
                                <b-col>
                                    <p><b>Obranca</b> :</p>
                                </b-col>
                                <b-col cols="auto">
                                    <p>{{ this.side2 }}</p>
                                </b-col>
                            </b-row>
                        </b-list-group-item>
                        <b-list-group-item>
                            <b-row>
                                <b-col>
                                    <p><b>Výsledok</b> :</p>
                                </b-col>
                                <b-col cols="auto">
                                    <p>{{ this.outcome }}</p>
                                </b-col>
                            </b-row>
                        </b-list-group-item>
                    </b-list-group>
                </b-col>
                <b-col>
                    <label class="label-center fw-bold mb-3" for="description-box">
                        Priebeh a opis bitky
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
    import moment from 'moment';

    export default {
        mounted() {
            console.log('Component mounted.');
        },

        data() {
            return {
                reliability: '',
                title: '',
                start: '',
                end: '',
                side1: '',
                side2: '',
                outcome: '',
                description: '',
                gallery: '',

                outcomes: [
                    { enum: 'side1_victory', text: 'Víťazstvo útočníka' },
                    { enum: 'stalemate', text: 'Patová situácia' },
                    { enum: 'side2_vicotry', text: 'Víťazstvo obrancu' }
                ]
            }
        },

        props: {
            battle: ''
        },

        methods: {
            formatDate: function(value) {
                return moment(value).format('DD.MM.YYYY')
            },
            
            showModal: function() {
                this.reliability = this.battle.reliability;
                this.title = this.battle.title;
                this.start = this.battle.start;
                this.end = this.battle.end;
                this.side1 = this.battle.side1.name;
                this.side2 = this.battle.side2.name;

                var tmp = this.outcomes.find((e) => e.enum == this.battle.outcome);
                this.outcome = tmp.text;
                this.description = this.battle.description;

                this.gallery = JSON.parse(this.battle.gallery);

                this.$refs['battle-modal'].show();
            }
        }
    }

</script>