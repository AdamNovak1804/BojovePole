<style scoped>

    .card-container
    {
        margin: 10px;
    }

    .historian-select-navigation
    {
        margin-left: 10px;
    }

    .request-card
    {
        width: calc(50% - 10px);
        margin: 5px;
    }

    @media screen and (max-width: 768px) {
        .request-card
        {
            width: calc(100% - 10px) !important;
        }
    }

</style>

<template>
    <div>
        <b-row>
            <b-col cols="4">
                <div class="historian-select-navigation">
                    <label class="label-form" for="historian-view-type">
                        Typ žiadosti
                    </label>
                    <select
                        class="options"
                        @change="loadRequests()"
                        v-model="selected"
                        name="historian-view-type"
                        id="historian-view-type"
                    >
                        <option value="" disabled>Vybrať typ žiadosti na posúdenie</option>
                        <option
                            v-for="option in options"
                            v-bind:value="option.value"
                            :key="option.id"
                        >
                            {{ option.text }}
                        </option>
                    </select>
                </div>
            </b-col>
        </b-row>
        <div class="row g-0 card-container" v-if="this.selected == 'family_members'">
            <family-member-edit-card
                v-on:displayView="showModal"
                v-for="member in this.family_member_requests"
                :key="'family-member' + member.id"
                :member="member"
            />
            <family-member-edit
                ref="family-member-edit"
                v-if="this.displayed"
                :member="this.displayed"
            />
        </div>
        <div class="row g-0 card-container" v-if="this.selected == 'units'">
            <unit-edit-card
                v-on:displayView="showModal"
                v-for="unit in this.unit_requests"
                :key="'battle' + unit.id"
                :unit="unit"
            />
            <unit-edit
                ref="unit-edit"
                v-if="this.displayed"
                :unit="this.displayed"
            />
        </div>
        <div class="row g-0 card-container" v-if="this.selected == 'battles'">
            <battle-edit-card
                v-on:displayView="showModal"
                v-for="battle in this.battle_requests"
                :key="'battle' + battle.id"
                :battle="battle"
            />
            <battle-edit 
                ref="battle-edit"
                v-if="this.displayed"
                :battle="this.displayed"
            />
        </div>
        <div class="row g-0 card-container" v-if="this.selected == 'cemeteries'">
            <cemetery-edit-card
                v-on:displayView="showModal"
                v-for="cemetery in this.cemetery_requests"
                :key="'cemetery' + cemetery.id"
                :cemetery="cemetery"
            />
            <cemetery-edit
                ref="cemetery-edit"
                v-if="this.displayed"
                :cemetery="this.displayed"
            />
        </div>
        <div class="row g-0 card-container" v-if="this.selected == 'landmarks'">
            <landmark-edit-card
                v-on:displayView="showModal"
                v-for="landmark in this.landmark_requests"
                :key="'landmark' + landmark.id"
                :landmark="landmark"
            />
            <landmark-edit
                ref="landmark-edit"
                v-if="this.displayed"
                :landmark="this.displayed"
            />
        </div>
        <div class="row g-0 card-container" v-if="this.selected == 'territories'">
            <territory-edit-card
                v-on:displayView="showModal"
                v-for="territory in this.territory_requests"
                :key="'territory' + territory.id"
                :territory="territory"
            />
            <territory-edit
                ref="territory-edit"
                v-if="this.displayed"
                :territory="this.displayed"
            />
        </div>
    </div>    
</template>

<script>

    export default {
        data() {
            return {
                selected: '',
                displayed: '',

                family_member_requests: '',
                unit_requests: '',
                battle_requests: '',
                cemetery_requests: '',
                landmark_requests: '',
                territory_requests: '',

                options: [
                    { text : 'Žiadosti rodinných príslušníkov', value : 'family_members' },
                    { text : 'Žiadosti útvarov', value : 'units' },
                    { text : 'Žiadosti bitiek', value : 'battles' },
                    { text : 'Žiadosti cintorínov', value : 'cemeteries' },
                    { text : 'Žiadosti pamiatok', value : 'landmarks' },
                    { text : 'Žiadosti zmeny frontovej línie', value : 'territories' }
                ]
            }
        },

        methods: {
            loadRequests: function() {
                switch (this.selected) {
                    case 'family_members':
                        this.getFamilyMemberRequests();
                        break;
                    case 'units':
                        this.getUnitRequests();
                        break;
                    case 'battles':
                        this.getBattleRequests();
                        break;
                    case 'cemeteries':
                        this.getCemeteryRequests();
                        break;
                    case 'landmarks':
                        this.getLandmarkRequests();
                        break;
                    case 'territories':
                        this.getTerritoryRequests();
                        break;
                    default:
                        console.log('Unknown selected value.');
                        break;
                }
            },

            getFamilyMemberRequests: function() {
                axios.get('/api/get_family_member_requests').then((response) => {
                    this.family_member_requests = response.data;
                }).catch((error) => {
                    console.log(error.response);
                })
            },

            getUnitRequests: function() {
                axios.get('/api/get_unit_requests').then((response) => {
                    this.unit_requests = response.data;
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            getBattleRequests: function() {
                axios.get('/api/get_battle_requests').then((response) => {
                    this.battle_requests = response.data;
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            getCemeteryRequests: function() {
                axios.get('/api/get_cemetery_requests').then((response) => {
                    this.cemetery_requests = response.data;
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            getLandmarkRequests: function() {
                axios.get('/api/get_landmark_requests').then((response) => {
                    this.landmark_requests = response.data;
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            getTerritoryRequests: function() {
                axios.get('/api/get_territory_requests').then((response) => {
                    this.territory_requests = response.data;
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            async showModal({ name, data }) {
                await this.updateDisplayed(data);
                this.$refs[name].showModal();
            },

            updateDisplayed: function(data) {
                this.displayed = data;
            }
        }
    }

</script>