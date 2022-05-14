<template>
   <b-card
        class="card-preview"
        v-if="type === 'cemetery-preview'"
        :img-src="getImage()"
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
                this.$emit('displayView', { view: 'cemetery-view', prop: this.displayed });
            },

            getImage: function() {
                if (this.displayed.gallery) {
                    return ('/api/userContent/' + JSON.parse(this.displayed.gallery).images[0].path); 
                }
                else {
                    return '/api/image/generic-cemetery.png';
                }
            }
        }
    }

</script>