<template>
    <div>
        <b-row align-h="center">
            <b-col cols="auto"
                class="mb-3"
                v-for="battle in getDisplayedBattles()"
                :key="'battle' + battle.id"
            >
                <battle-preview
                    v-on:displayView="displayView"
                    :displayed="battle"
                    :type="'battle-preview'"
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
        <battle-view
            ref="battle-view"
            :battle="this.selected"
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

                battles: [],
                displayed: []
            }
        },

        mounted() {
            console.log('Component mounted.');

            this.getBattles();
        },

        methods: {
            getBattles: function() {
                axios.get('/api/get_battles').then((response) => {
                    this.battles = response.data;
                    this.rows = this.battles.length;
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            getDisplayedBattles: function() {
                return this.battles.slice(
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