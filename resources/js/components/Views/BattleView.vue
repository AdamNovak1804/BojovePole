<template>
    <b-modal
        size="xl"
        hide-footer
        ref="battle-modal"
    >
        <h1 class="modal-title">{{ this.title }}</h1>
        <b-carousel
            class="view-carousel"
            id="battle-carousel"
            :interval="4000"
            controls
            fade
        >
            <b-carousel-slide
                class="view-carousel-slides"
                v-for="slide in this.gallery.slides"
                :key="slide.id"
                :img-src="slide.image"
            />
        </b-carousel>
        <b-row
            no-gutters
            class="mt-3"
        >
            <b-col
                col lg="3"
            >
                <div class="modal-info">
                    <ul>
                        <li><b>Začiatok</b> : {{ formatDate(this.start) }}</li>
                        <li><b>Koniec</b> : {{ formatDate(this.end) }}</li>
                        <li><b>Útočník</b> : {{ this.side1 }}</li>
                        <li><b>Obranca</b> : {{ this.side2 }}</li>
                        <li><b>Výsledok</b> : {{ this.outcome }}</li>
                    </ul>
                </div>
            </b-col>
            <b-col>
                <div class="modal-text">
                    {{ this.description }}
                </div>
            </b-col>
        </b-row>
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
                console.log(this.battle);
                this.title = this.battle.title;
                this.start = this.battle.start;
                this.end = this.battle.end;
                this.side1 = this.battle.side1.name;
                this.side2 = this.battle.side2.name;

                var tmp = this.outcomes.find((e) => e.enum == this.battle.outcome);
                this.outcome = tmp.text;
                this.description = this.battle.description;

                this.gallery = JSON.parse(this.battle.gallery);

                this.$refs['battle-modal'].show()
            }
        }
    }

</script>