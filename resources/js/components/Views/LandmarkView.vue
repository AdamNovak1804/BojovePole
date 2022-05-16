<template>
    <b-modal
        size="xl"
        hide-footer
        ref="landmark-modal"
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
                História a opis pamätníka
            </label>
            <div id="description-box">
                <p>{{ this.description }}</p>
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
                gallery: ''
            }
        },

        props: {
            landmark: ''
        },

        methods: {            
            showModal: function() {
                this.reliability = this.landmark.reliability;
                this.name = this.landmark.name;
                this.location = this.landmark.location;
                this.description = this.landmark.description;

                this.gallery = JSON.parse(this.landmark.gallery);

                this.$refs['landmark-modal'].show();
            }
        }
    }

</script>