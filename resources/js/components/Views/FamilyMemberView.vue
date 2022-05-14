<template>
    <b-modal
        size="xl"
        ref="member-modal"
        hide-footer
    >
        <div v-if="this.member">
            <b-carousel
                v-if="member.gallery"
                background="#ababab"
                indicators
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
                <h1>{{ this.member.name }}</h1>
            </b-card-body>

            <b-row>
                <b-col cols="4">
                    <b-list-group flush>
                        <b-list-group-item>
                            <b-row>
                                <b-col>
                                    <p><b>Dátum narodenia</b> :</p>
                                </b-col>
                                <b-col cols="auto" class="text-end">
                                    <p>{{ formatDate(this.member.date_of_birth) }}</p>
                                </b-col>
                            </b-row>
                        </b-list-group-item>
                        <b-list-group-item>
                            <b-row>
                                <b-col>
                                    <p><b>Dátum úmrtia</b> :</p>
                                </b-col>
                                <b-col cols="auto" class="text-end">
                                    <p>{{ formatDate(this.member.date_of_death) }}</p>
                                </b-col>
                            </b-row>
                        </b-list-group-item>
                        <b-list-group-item v-if="this.member.cemetery">
                            <b-row>
                                <b-col>
                                    <p><b>Pochovaný v</b> :</p>
                                </b-col>
                                <b-col cols="auto" class="text-end">
                                    <p>{{ this.member.cemetery.name }}</p>
                                </b-col>
                            </b-row>
                        </b-list-group-item>
                        <b-list-group-item v-if="this.member.unit">
                            <b-row>
                                <b-col>
                                    <p><b>Vojenský útvar</b> :</p>
                                </b-col>
                                <b-col cols="auto" class="text-end">
                                    <p>{{ this.member.unit.name }}</p>
                                </b-col>
                            </b-row>
                        </b-list-group-item>
                    </b-list-group>
                </b-col>
                <b-col>
                    <p>{{ this.member.biography }}</p>
                </b-col>
            </b-row>
        </div>
    </b-modal>
</template>

<script>
    import moment from 'moment';

    export default {
        mounted() {
            console.log('Component mounted.');
        },

        props: {
            member: ''
        },

        methods: {
            formatDate: function(value) {
                return moment(value).format('DD.MM.YYYY')
            },

            showModal: function() {
                this.$refs['member-modal'].show();
            }
        }
    }

</script>