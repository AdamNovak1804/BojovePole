<template>
   <b-card
        class="card-preview"
        v-if="type === 'cemetery-preview'"
        img-src="https://cdn.better-pets.net/4123017/la_historia_de_hachiko-_el_perro_fiel.jpg.webp"
        img-top
        no-body
        tag="article"
    >
        <b-card-body>
            <h4 class="card-title">{{ this.displayed.name }}</h4>
            <b-card-text class="card-text">
                {{ this.displayed.description }}
            </b-card-text>
            <b-button @click="displayView()" class="btn-action mt-2">Zobraziť viac</b-button>
        </b-card-body>
    </b-card> 
</template>

<script>

    export default {
        props: {
            type: '',
            displayed: ''
        },

        methods: {
            displayView: function() {
                this.$emit('displayView', 'cemetery-view');
            }
        }
    }

</script>