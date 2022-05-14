<template>
    <b-card
        no-body
        img-top
        class="request-card"
    >
        <b-card-body>
            <h4 class="card-title">Frontová línia</h4>
        </b-card-body>

        <b-list-group flush>
            <b-list-group-item>
                <b-row align-h="between">
                    <b-col>
                        <p><b>Začiatok situácie</b> :</p>
                    </b-col>
                    <b-col cols="auto">
                        <p>{{ formatDate(territory.start_date) }}</p>
                    </b-col>
                </b-row>
            </b-list-group-item>
            <b-list-group-item>
                <b-row align-h="between">
                    <b-col>
                        <p><b>Koniec situácie</b> :</p>
                    </b-col>
                    <b-col cols="auto">
                        <p>{{ formatDate(territory.end_date) }}</p>
                    </b-col>
                </b-row>
            </b-list-group-item>
            <b-list-group-item v-if="territory.country">
                <b-row align-h="between">
                    <b-col>
                        <p><b>Krajina</b> :</p>
                    </b-col>
                    <b-col cols="auto">
                        <p>{{ territory.country.name }}</p>
                    </b-col>
                </b-row>
            </b-list-group-item>
        </b-list-group>

        <b-card-body>
            <b-button @click="displayView(territory)" class="btn-action mt-2">Zobraziť na posúdenie</b-button>
        </b-card-body>
    </b-card>
</template>

<script>
    import moment from 'moment';

    export default {
        data() {
            return {
                
            }
        },
 
        props: {
            territory: ''
        },

        methods: {
            formatDate: function(value) {
                return moment(value).format('DD.MM.YYYY')
            },

            displayView: function(data) {
                this.$emit('displayView', { name: 'territory-edit', data: data });
            }
        }
    }

</script>