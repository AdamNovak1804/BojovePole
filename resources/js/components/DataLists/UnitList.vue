<template>
    <div>
        <b-row align-h="center">
            <b-col cols="auto"
                class="mb-3"
                v-for="unit in getDisplayedUnits()"
                :key="'unit' + unit.id"
            >
                <unit-preview
                    v-on:displayView="displayView"
                    :displayed="unit"
                    :type="'unit-preview'"
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
        <unit-view
            ref="unit-view"
            :unit="this.selected"
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

                units: [],
                displayed: []
            }
        },

        mounted() {
            console.log('Component mounted.');

            this.getUnits();
        },

        methods: {
            getUnits: function() {
                axios.get('/api/get_units').then((response) => {
                    this.units = response.data;
                    this.rows = this.units.length;
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            getDisplayedUnits: function() {
                return this.units.slice(
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