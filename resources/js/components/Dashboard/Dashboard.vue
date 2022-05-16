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
        min-height: calc(100vh - 190px);
        margin-top: 150px;
        margin-bottom: 40px;
    }

    .special-label
    {
        display: block;
        font-weight: 900;
        text-align: center;
        margin-bottom: 1rem;
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
                                <input @click="selected_form = 1" :v-model="selected_form" type="radio" name="selection" id="dashboard-messages" checked>
                                <label class="btn-select" for="dashboard-messages">Prijaté a odoslané správy</label>
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
                        <ul v-if="this.user.role == 'historian'" name="dashboard-historian" id="dashboard-historian">
                            <label for="dashboard-historian" class="special-label">
                                Menu pre historika
                            </label>
                            <li>
                                <input @click="selected_form = 4" :v-model="selected_form" type="radio" name="selection" id="dashboard-d">
                                <label class="btn-select" for="dashboard-d">Schválenia žiadostí</label>
                            </li>
                        </ul>
                        <ul v-if="this.user.role == 'admin'" name="dashboard-admin" id="dashboard-admin">
                            <label for="dashboard-admin" class="special-label">
                                Menu pre administrátora
                            </label>
                            <li>
                                <input @click="selected_form = 5" :v-model="selected_form" type="radio" name="selection" id="dashboard-c">
                                <label class="btn-select" for="dashboard-c">Používateľské role</label>
                            </li>
                        </ul>
                        <button class="btn btn-action d-none d-xl-block" @click.prevent="logOut">Odhlásiť sa</button>
                    </div>
                </div>
                <div class="content col-12 col-xl-9">
                    <messenger-form
                        v-if="selected_form == 1"
                    />
                    <family-member-menu
                        v-if="selected_form == 2"
                    />
                    <user-settings
                        v-if="selected_form == 3"
                        v-on:updateUser="updateUser"
                        :user="user"
                    />
                    <historian-menu
                        v-if="selected_form == 4"
                    />                    
                    <admin-menu 
                        v-if="selected_form == 5"
                    />
                    <button class="btn btn-action d-xl-none mt-3" @click.prevent="logOut">Odhlásiť sa</button>
                </div>
            </div>
        </div>
        <navbar-footer />
    </div>
</template>

<script>

    export default {
        data() {
            return {
                user: '',
                selected_form: 1
            }
        },

        async mounted() {
            console.log('Component mounted.');

            await axios.get('api/user').then((response) => {
                this.user = response.data;
            });
        },

        methods: {
            logOut() {
                axios.post('api/logout').then(() => {
                    this.$router.push({
                        name: 'Prihlásenie'
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
