<template>
    <b-card
        class="card-preview"
        v-if="type === 'unit-preview'"
        img-src="https://img-9gag-fun.9cache.com/photo/agYA1zq_460s.jpg"
        img-top
        no-body
        tag="article"
    >
        <b-card-body>
            <h4 class="card-title">{{ this.displayed.name }}</h4>
        </b-card-body>

        <b-list-group flush>
            <b-list-group-item>
                <b>Typ</b> : {{ this.getType(this.displayed.type) }}
            </b-list-group-item>
            <b-list-group-item>
                <b>Krajina</b> : {{ this.displayed.country.name }}
            </b-list-group-item>
            <b-list-group-item>
                <b>Miesto</b> : {{ this.displayed.location }}
            </b-list-group-item>
        </b-list-group>

        <b-card-body>
            <b-card-text class="card-text">
                {{ this.displayed.description }}
            </b-card-text>
            <b-button @click="displayView()" class="btn-action mt-2">Zobraziť viac</b-button>
        </b-card-body>
    </b-card>
</template>

<script>

    export default {
        data() {
            return {
                types: [
                    { enum: 'a', text: 'Peší pluk' },
                    { enum: 'b', text: 'Honvédsky peší pluk' },
                    { enum: 'c', text: 'Prápor poľných strelcov' },
                    { enum: 'd', text: 'Poľný delostrelecký pluk' },
                    { enum: 'e', text: 'Ťažký poľný delostrelecký pluk' }
                ]
            }
        },

        props: {
            type: '',
            displayed: ''
        },

        methods: {
            getType: function(value) {
                var tmp = this.types.find((e) => e.enum == value);
                return tmp.text;
            },

            displayView: function() {
                this.$emit('displayView', 'unit-view');
            }
        }
    }

</script>