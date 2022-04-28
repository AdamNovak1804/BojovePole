<style scoped>

    .intro-card
    {
        height: 100vh;
    }

    .card-container
    {
        min-height: 100vh;
    }

</style>

<template>
    <div>
        <navbar-header />
        
        <div class="container card-container">
            <intro-card
                class="intro-card"
                v-for="card in cards"
                :key="card.id"
                :heading="card.heading"
                :description="card.description"
                :slides_prop="card.slides"
                :id="card.id"
            />
        </div>

        <scroll-button
            v-on:nextCard="updatePosition"
            v-on:checkLast="updateLast"
            :index="this.viewing"
            :count="this.count"
            v-show="this.notLast"
        />

        <navbar-footer />
    </div>
</template>

<script>
import NavbarFooter from './NavbarFooter.vue';

    export default {
        components: { NavbarFooter },

        mounted() {
            console.log('Component mounted.');

            this.getSlides(this.prop_id);
        },

        data() {
            return {
                cards: '',
                viewing: 1,
                count: '',
                notLast: true
            }
        },  

        methods: {
            getSlides: function(id) {
                axios.get('api/get_cards').then(response => {
                    this.cards = response.data;
                    this.count = this.cards.length;
                }).catch(error => {
                    console.log(error);
                });
            },

            updatePosition: function(value) {
                this.viewing = value;
            },

            updateLast: function(value) {
                this.notLast = value;
            }
        }
    }

</script>
