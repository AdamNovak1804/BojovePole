<template>
    <b-card
        no-body
        img-top
        class="request-card"
        :img-src="getPreviewImage(cemetery)"
    >
        <b-card-body>
            <h4 class="card-title">{{ cemetery.name }}</h4>
        </b-card-body>

        <b-card-body>
            <b-card-text class="card-text">
                {{ cemetery.description }}
            </b-card-text>
            <b-button @click="displayView(cemetery)" class="btn-action mt-2">Zobraziť na posúdenie</b-button>
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
            cemetery: ''
        },

        methods: {
            getPreviewImage(cemetery) {
                if ( !!cemetery.gallery ) {
                    var gallery = JSON.parse(cemetery.gallery);
                    return '/api/userContent/' + gallery.images[0].path;
                }
                else {
                    return '/api/image/generic-profile.png';
                }
            },

            displayView: function(data) {
                this.$emit('displayView', { name: 'cemetery-edit', data: data });
            }
        }
    }

</script>