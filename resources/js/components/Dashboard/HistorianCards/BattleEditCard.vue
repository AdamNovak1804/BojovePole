<template>
    <b-card
        no-body
        img-top
        class="request-card"
        :img-src="getPreviewImage(battle)"
    >
        <b-card-body>
            <h4 class="card-title">{{ battle.title }}</h4>
        </b-card-body>

        <b-list-group flush>
            <b-list-group-item>
                <div class="row">
                    <div class="col">
                        <b>Začiatok</b> : {{ formatDate(battle.start) }}
                    </div>
                    <div class="col">
                        <b>Koniec</b> : {{ formatDate(battle.end) }}
                    </div>
                </div>
            </b-list-group-item>
            <b-list-group-item>
                <div class="row">
                    <div class="col">
                        <b>Útočník</b> : {{ battle.side1.name }}
                    </div>
                    <div class="col">
                        <b>Obranca</b> : {{ battle.side2.name }}
                    </div>
                </div>
            </b-list-group-item>
            <b-list-group-item>
                <b>Výsledok</b> : {{ formatOutcome(battle.outcome) }}
            </b-list-group-item>
        </b-list-group>
        <b-card-body>
            <b-card-text class="card-text">
                {{ battle.description }}
            </b-card-text>
            <b-button @click="displayView(battle)" class="btn-action mt-2">Zobraziť na posúdenie</b-button>
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
            battle: ''
        },

        methods: {
            formatDate: function(value) {
                return moment(value).format('DD.MM.YYYY')
            },

            formatOutcome: function(value) {
                var tmp = this.outcomes.find((e) => e.enum == value);
                return tmp.text;
            },

            getPreviewImage(battle) {
                if ( !!battle.gallery ) {
                    var gallery = JSON.parse(battle.gallery);
                    return '/api/userContent/' + gallery.images[0].path;
                }
                else {
                    return '/api/image/generic-profile.png';
                }
            },

            displayView: function(data) {
                this.$emit('displayView', { name: 'battle-edit', data: data });
            }
        }
    }

</script>