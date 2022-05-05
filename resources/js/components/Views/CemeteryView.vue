<template>
    <b-modal
        size="xl"
        hide-footer
        ref="cemetery-modal"
    >
        <b-card-body>
            <h3 class="modal-title">
                {{ this.name }}
            </h3>
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
                História a opis cintorínu
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
            cemetery: ''
        },

        methods: {            
            showModal: function() {
                this.name = this.cemetery.name;
                this.location = this.cemetery.location;
                this.description = this.cemetery.description;

                this.gallery = JSON.parse(this.cemetery.gallery);

                this.$refs['cemetery-modal'].show();
            }
        }
    }

</script>