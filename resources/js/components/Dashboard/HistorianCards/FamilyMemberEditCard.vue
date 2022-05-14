<template>
    <b-card
        no-body
        img-top
        class="request-card"
    >
        <b-card-body>
            <h4 class="card-title">{{ member.name }}</h4>
        </b-card-body>

        <b-list-group flush>
            <b-list-group-item>
                <b-row align-h="between">
                    <b-col>
                        <p><b>Dátum narodenia</b> :</p>
                    </b-col>
                    <b-col cols="auto">
                        <p>{{ formatDate(member.date_of_birth) }}</p>
                    </b-col>
                </b-row>
            </b-list-group-item>
            <b-list-group-item>
                <b-row>
                    <b-col>
                        <p><b>Dátum úmrtia</b> :</p>
                    </b-col>
                    <b-col cols="auto">
                        <p>{{ formatDate(member.date_of_death) }}</p>
                    </b-col>
                </b-row>
            </b-list-group-item>
            <b-list-group-item v-if="member.cemetery">
                <b-row align-h="between">
                    <b-col>
                        <p><b>Pochovaný v</b> :</p>
                    </b-col>
                    <b-col cols="auto">
                        <p>{{ member.cemetery.name }}</p>
                    </b-col>
                </b-row>
            </b-list-group-item>
            <b-list-group-item v-if="member.unit">
                <b-row align-h="between">
                    <b-col>
                        <p><b>Vojenský útvar</b> :</p>
                    </b-col>
                    <b-col cols="auto">
                        <p>{{ member.unit.name }}</p>
                    </b-col>
                </b-row>
            </b-list-group-item>
        </b-list-group>

        <b-card-body>
            <b-card-text>
                {{ member.biography }}
            </b-card-text>
            <b-button @click="displayView(member)" class="btn-action mt-2">Zobraziť na posúdenie</b-button>
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
            member: ''
        },

        methods: {
            formatDate: function(value) {
                return moment(value).format('DD.MM.YYYY')
            },

            displayView: function(data) {
                this.$emit('displayView', { name: 'family-member-edit', data: data });
            }
        }
    }

</script>