<style scoped>

    .intro
    {
        height: 100vh;
    }

    .carousel
    {
        height: 400px;
    }

    .col-center
    {
        display: table-cell;
        vertical-align: middle;
    }

</style>

<template>
    <b-row class="intro" align-v="center">
        <b-col class="d-none d-lg-block">
            <b-carousel
                class="d-none d-lg-block"
                id="carousel"
                background="#fff"
                img-height="400px"
                controls
                fade
            >
                <b-carousel-slide
                    v-for="slide in slides.slides"
                    :key="slide.id"
                >
                    <template #img>
                        <img
                            class="d-block img-fluid slide-img"
                            :src="'/api/image/' + slide.path"
                            alt="image slot"
                        >
                    </template>
                </b-carousel-slide>
            </b-carousel>
        </b-col>
        <b-col class="text-center">
            <h1>{{ heading }}</h1>
            <b-row>
                <b-col offset="2" cols="8">
                    <p>{{ description }}</p>
                </b-col>
            </b-row>
        </b-col>
    </b-row>
</template>

<script>

    export default {

        mounted() {
            console.log('Component mounted.');

            this.slides = JSON.parse(this.slides_prop);
        },

        data() {
            return {
                slide: 0,
                sliding: null,
                slides: ''
            }
        },

        props: {
            heading: '',
            description: '',
            slides_prop: ''
        },

        methods: {

        }

    }

</script>