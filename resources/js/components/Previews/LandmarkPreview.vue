<template>
   <b-card
        class="card-preview"
        v-if="type === 'landmark-preview'"
        img-src="https://i.kym-cdn.com/entries/icons/mobile/000/013/564/doge.jpg"
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
                this.$emit('displayView', 'landmark-view');
            }
        }
    }

</script>