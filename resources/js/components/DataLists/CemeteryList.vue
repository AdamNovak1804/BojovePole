<template>
    <div>
        <b-row align-h="center">
            <b-col cols="auto"
                class="mb-3"
                v-for="cemetery in getDisplayedCemeteries()"
                :key="'cemetery' + cemetery.id"
            >
                <cemetery-preview
                    :displayed="cemetery"
                    :type="'cemetery-preview'"
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
    </div>
</template>

<script>

    export default {
        data() {
            return {
                current: 1,
                max: 9,
                rows: '',

                cemeteries: [],
                displayed: []
            }
        },

        mounted() {
            console.log('Component mounted.');

            this.getCemeteries();
        },

        methods: {
            getCemeteries: function() {
                axios.get('/api/get_cemeteries').then((response) => {
                    this.cemeteries = response.data;
                    this.rows = this.cemeteries.length;
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            getDisplayedCemeteries: function() {
                return this.cemeteries.slice(
                    (this.current - 1) * this.max,
                    this.current * this.max,
                );
            }
        }
    }

</script>