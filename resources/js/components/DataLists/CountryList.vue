<template>
    <div>
        <b-row align-h="center">
            <b-col cols="auto"
                class="mb-3"
                v-for="country in getDisplayedCountries()"
                :key="'country' + country.id"
            >
                <country-preview
                    v-on:displayView="displayView"
                    :displayed="country"
                    :type="'country-preview'"
                />
            </b-col>
        </b-row>
        <b-pagination
            class="pb-3"
            v-model="current"
            :total-rows="this.rows"
            :per-page="this.max"
            aria-controls="messages"
            align="center"
        />
        <country-view
            ref="country-view"
            :country="this.selected"
        />
    </div>
</template>

<script>

    export default {
        data() {
            return {
                current: 1,
                max: 9,
                rows: '',
                selected: '',

                countries: [],
                displayed: []
            }
        },

        mounted() {
            console.log('Component mounted.');

            this.getCountries();
        },

        methods: {
            getCountries: function() {
                axios.get('/api/get_countries').then((response) => {
                    this.countries = response.data;
                    this.rows = this.countries.length;
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            getDisplayedCountries: function() {
                return this.countries.slice(
                    (this.current - 1) * this.max,
                    this.current * this.max,
                );
            },

            async displayView({ view, prop }) {
                await (this.selected = prop);
                this.$refs[view].showModal();
            },
        }
    }

</script>