<template>
    <b-card
        no-body
        img-top
        class="request-card"
        :img-src="getPreviewImage(landmark)"
    >
        <b-card-body>
            <h4 class="card-title">{{ landmark.name }}</h4>
        </b-card-body>

        <b-card-body>
            <b-card-text class="card-text">
                {{ landmark.description }}
            </b-card-text>
            <b-button @click="displayView(landmark)" class="btn-action mt-2">Zobraziť na posúdenie</b-button>
        </b-card-body>
    </b-card>
</template>

<script>

    export default {
        data() {
            return {
                
            }
        },
 
        props: {
            landmark: ''
        },

        methods: {
            getPreviewImage(landmark) {
                if ( !!landmark.gallery ) {
                    var gallery = JSON.parse(landmark.gallery);
                    return '/api/userContent/' + gallery.images[0].path;
                }
                else {
                    return '/api/image/0.png';
                }
            },

            displayView: function(data) {
                this.$emit('displayView', { name: 'landmark-edit', data: data });
            }
        }
    }

</script>