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
        height: 200vh;
    }

</style>

<template>
    <div>
        <navbar-header></navbar-header>
        <div class="container" style="margin-top: 150px">
            <div class="row">
                <div class="sidenav col-12 col-xl-3 pr-2">
                    <div class="position-fixed">
                        <h1>Môj účet</h1>
                    <ul>
                        <li>
                            <input @click="selected = 1" :v-model="selected" type="radio" name="selection" id="messages" checked>
                            <label class="btn-select" for="messages">Správy a žiadosti</label>
                        </li>
                        <li>
                            <input @click="selected = 2" :v-model="selected" type="radio" name="selection" id="family">
                            <label class="btn-select" for="family">Rodinní príslušníci</label>
                        </li>
                        <li>
                            <input @click="selected = 3" :v-model="selected" type="radio" name="selection" id="settings">
                            <label class="btn-select" for="settings">Ďalšie nastavenia</label>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="content col-12 col-xl-9">
                    <div v-if="selected === 1">
                        messages
                    </div>
                    <div v-if="selected === 2">
                        family_members
                    </div>
                    <div v-if="selected === 3">
                        settings
                    </div>
                </div>
            </div>
            <button @click.prevent="logOut">Odhlásiť sa</button>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                user: '',
                selected: 1,
                options: [
                    { text: 'Správy a žiadosti', value: 'messages' },
                    { text: 'Rodinní príslušníci', value: 'family' },
                    { text: 'Ďalšie nastavenia', value: 'settings' }
                ]
            }
        },

        mounted() {
            axios.get('api/user').then((response) => {
                this.user = response.data
            })
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
            }
        }
    }

</script>
