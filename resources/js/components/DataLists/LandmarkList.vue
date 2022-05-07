<template>
    <div>
        <b-row align-h="center">
            <b-col cols="auto"
                class="mb-3"
                v-for="landmark in getDisplayedLandmarks()"
                :key="'landmark' + landmark.id"
            >
                <landmark-preview
                    :displayed="landmark"
                    :type="'landmark-preview'"
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

                landmarks: [],
                displayed: []
            }
        },

        mounted() {
            console.log('Component mounted.');

            this.getLandmarks();
        },

        methods: {
            getLandmarks: function() {
                axios.get('/api/get_landmarks').then((response) => {
                    this.landmarks = response.data;
                    this.rows = this.landmarks.length;
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            getDisplayedLandmarks: function() {
                return this.landmarks.slice(
                    (this.current - 1) * this.max,
                    this.current * this.max,
                );
            }
        }
    }

</script>