<style scoped>

    .row-center
    {
        display: table-row;
    }

    .carousel 
    {
        border-radius: 15px;
        text-shadow: 1px 1px 2px #333;
    }

    .col-center
    {
        display: table-cell;
        vertical-align: middle;
    }

</style>

<template>
    <div class="row row-center">
        <div class="col-6 col-center">
            <b-carousel
                id="carousel"
                :interval="4000"
                fade
                class="carousel-inner"
            >
                <b-carousel-slide
                    v-for="slide in slides.slides"
                    :key="slide.id"
                    :caption="slide.heading"
                    :text="slide.description"
                    img-src="https://picsum.photos/1024/480/?image=52"
                />
            </b-carousel>
        </div>
        <div class="col-6 col-center text-center">
            <h1>{{ heading }}</h1>
            <p>{{ description }}</p>
        </div>
    </div>
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