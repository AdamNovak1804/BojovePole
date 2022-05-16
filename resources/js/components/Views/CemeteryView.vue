<template>
    <b-modal
        size="xl"
        hide-footer
        ref="cemetery-modal"
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
            <label class="label-center fw-bold mb-3" for="description-box">
                História a opis cintorína
            </label>
            <div id="description-box">
                <p>{{ this.description }}</p>
            </div>
            <label class="label-center fw-bold" for="cemetery-members">
                Pochovaní v cintoríne:
            </label>
            <div class="mt-3" id="cemetery-members" name="cemetery-members">
                <ul class="member-ul">
                    <li
                        class="member-li"
                        v-for="member in members"
                        :key="'family-member' + member.id"
                    >
                        {{ member.name }}
                    </li>
                </ul>
            </div>
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
                reliability: '',
                name: '',
                type: '',
                location: '',
                country: '',
                description: '',
                reliability: '',
                gallery: '',

                members: ''
            }
        },

        props: {
            cemetery: ''
        },

        methods: {
            getCemeteryMembers: function() {
                axios.get('/api/get_cemetery_members', { params: { id: this.cemetery.id } }).then((response) => {
                    this.members = response.data;
                }).catch((error) => {
                    console.log(error.response);
                });
            },
            
            showModal: function() {
                this.getCemeteryMembers();

                this.reliability = this.cemetery.reliability;
                this.name = this.cemetery.name;
                this.location = this.cemetery.location;
                this.description = this.cemetery.description;

                this.gallery = JSON.parse(this.cemetery.gallery);

                this.$refs['cemetery-modal'].show();
            }
        }
    }

</script>