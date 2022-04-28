<template>
    <b-card
        class="card-preview"
        v-if="type === 'battle-preview'"
        img-src="https://filmdaily.co/wp-content/uploads/2021/02/walter-dog-lede-1300x731.jpg"
        img-top
        no-body
        tag="article"
    >
        <b-card-body>
            <h4 class="card-title">{{ this.displayed.title }}</h4>
        </b-card-body>

        <b-list-group flush>
            <b-list-group-item>
                <div class="row">
                    <div class="col">
                        <b>Začiatok</b> : {{ formatDate(this.displayed.start) }}
                    </div>
                    <div class="col">
                        <b>Koniec</b> : {{ formatDate(this.displayed.end) }}
                    </div>
                </div>
            </b-list-group-item>
            <b-list-group-item>
                <div class="row">
                    <div class="col">
                        <b>Útočník</b> : {{ this.displayed.side1.name }}
                    </div>
                    <div class="col">
                        <b>Obranca</b> : {{ this.displayed.side2.name }}
                    </div>
                </div>
            </b-list-group-item>
            <b-list-group-item>
                <b>Výsledok</b> : {{ formatOutcome(this.displayed.outcome) }}
            </b-list-group-item>
        </b-list-group>

        <b-card-body>
            <b-card-text class="card-text">
                {{ this.displayed.description }}
            </b-card-text>
            <b-button @click="displayView()" class="btn-action mt-2">Zobraziť viac</b-button>
        </b-card-body>
    </b-card>
</template>

<script>
    import moment from 'moment';

    export default {

        data() {
            return {
                outcomes: [
                    { enum: 'side1_victory', text: 'Víťazstvo útočníka' },
                    { enum: 'stalemate', text: 'Patová situácia' },
                    { enum: 'side2_vicotry', text: 'Víťazstvo obrancu' }
                ]
            }
        },

        props: {
            type: '',
            displayed: ''
        },

        methods: {
            formatDate: function(value) {
                return moment(value).format('DD.MM.YYYY')
            },

            formatOutcome: function(value) {
                var tmp = this.outcomes.find((e) => e.enum == value);
                return tmp.text;
            },

            displayView: function() {
                this.$emit('displayView', 'battle-view');
            }
        }
    }

</script>