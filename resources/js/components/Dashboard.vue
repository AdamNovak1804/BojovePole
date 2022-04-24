<style scoped>

    ul
    {
        width: 100%;
        list-style: none;
        padding-left: 0px;
    }

    input[type=radio]
    {
        display: none;
    }

    .btn-select
    {
        user-select: none;
        position: relative;
        display: flex;
        padding: 10px 10px 10px 10px;
        border-left: 4px solid transparent;
    }

    input[type=radio]:checked + label
    {
        background-color: #EEEEEE;
        border-left: 4px solid #540202;
    }


    @media screen and (max-width: 1200px) {

        .position-fixed
        {
            position: relative !important;
        }
    }

    .content
    {
        height: auto;
    }

    .container
    {
        margin-top: 150px;
        margin-bottom: 40px;
    }

</style>

<template>
    <div>
        <navbar-header />
        <div class="container">
            <div class="row">
                <div class="sidenav col-12 col-xl-3 pr-2">
                    <div class="position-fixed">
                        <h1>Môj účet</h1>
                        <ul>
                            <li>
                                <input @click="selected_form = 1" :v-model="selected_form" type="radio" name="selection" id="messages" checked>
                                <label class="btn-select" for="messages">Správy a žiadosti</label>
                            </li>
                            <li>
                                <input @click="selected_form = 2" :v-model="selected_form" type="radio" name="selection" id="family">
                                <label class="btn-select" for="family">Rodinní príslušníci</label>
                            </li>
                            <li>
                                <input @click="selected_form = 3" :v-model="selected_form" type="radio" name="selection" id="settings">
                                <label class="btn-select" for="settings">Ďalšie nastavenia</label>
                            </li>
                        </ul>
                        <button class="btn btn-action d-none d-xl-block" @click.prevent="logOut">Odhlásiť sa</button>
                    </div>
                </div>
                <div class="content col-12 col-xl-9">
                    <div v-if="selected_form === 1">
                        <messenger-form />
                    </div>
                    <div v-if="selected_form === 2">
                        <family-member-view />
                    </div>
                    <div v-if="selected_form === 3">
                        <user-settings
                            v-on:updateUser="updateUser"
                            :user="user"
                        />
                    </div>
                    <button class="btn btn-action d-xl-none mt-3" @click.prevent="logOut">Odhlásiť sa</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                user: '',
                selected_form: 1,
                options: [
                    { text: 'Správy a žiadosti', value: 'messages' },
                    { text: 'Rodinní príslušníci', value: 'family' },
                    { text: 'Ďalšie nastavenia', value: 'settings' }
                ],
            }
        },

        mounted() {
            axios.get('api/user').then((response) => {
                this.user = response.data;
            });
        },

        methods: {
            logOut() {
                axios.post('api/logout').then(() => {
                    this.$router.push({
                        name: 'Login'
                    }).catch((error) => {
                        console.log(error.response)
                    })
                })
            },

            updateUser: function(value) {
                this.user = value;
            }
        }
    }

</script>
