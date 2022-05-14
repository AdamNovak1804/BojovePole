<template>
    <b-card
        no-body
        img-top
        class="request-card"
        :img-src="getPreviewImage(unit)"
    >
        <b-card-body>
            <h4 class="card-title">{{ unit.name }}</h4>
        </b-card-body>

        <b-list-group flush>
            <b-list-group-item>
                <b>Typ útvaru</b> : {{ unit.type }}
            </b-list-group-item>
            <b-list-group-item>
                <b>Lokácia</b> : {{ unit.location }}
            </b-list-group-item>
            <b-list-group-item>
                <b>Krajina pôvodu</b> : {{ unit.country.name }}
            </b-list-group-item>
        </b-list-group>
        <b-card-body>
            <b-card-text class="card-text">
                {{ unit.description }}
            </b-card-text>
            <b-button @click="displayView(unit)" class="btn-action mt-2">Zobraziť na posúdenie</b-button>
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
            unit: ''
        },

        methods: {
            getPreviewImage(unit) {
                if ( !!unit.gallery ) {
                    var gallery = JSON.parse(unit.gallery);
                    return '/api/userContent/' + gallery.images[0].path;
                }
                else {
                    return '/api/image/generic-profile.png';
                }
            },

            displayView: function(data) {
                this.$emit('displayView', { name: 'unit-edit', data: data });
            }
        }
    }

</script>