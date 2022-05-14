<style scoped>

    .user-card-body
    {
        display: flex;
        justify-content: space-between;
        height: 100px;
        background-color: #EDE0A6;
        box-shadow: 0px 2px 3px #999;
    }

    .user-card-info
    {
        display: flex;
    }

    .user-card-body h4
    {
        font-weight: 900;
    }

    .user-card-image
    {
        margin: 10px;
        border-radius: 50%;
        outline: 2px solid #540202;
    }

    .user-card-text
    {
        align-self: center;
        padding: 10px;
    }

    .user-card-buttons
    {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 10px;
    }

    .user-card-roles
    {
        color: #EDE0A6;
        border: none;
        border-radius: 5px;
        background-color: #540202;
        padding: 8px 5px 8px 5px;
        width: 120px;
    }

    .user-card-upper-buttons
    {
        display: flex;
        flex-shrink: 0;
        justify-content: space-between;
    }

    .remove-user-button
    {
        margin-left: 5px;
        height: 34px;
        width: 34px;
        background: url('/images/btn-delete.png') no-repeat center center;
        background-size: 34px 34px;
        outline: none;
        border: none;
        border-radius: 5px;
    }

</style>

<template>
    <form v-if="this.user" action="#" @submit.prevent="">
        <div class="user-card-body mb-3">
            <div class="user-card-info">
                <img class="user-card-image" :src="'/api/image/' + this.user.image" width="80px" height="80px" alt="Profilový obrázok">
                <div class="user-card-text">
                    <h4>{{ this.user.name }}</h4>
                    <small>{{ this.user.email }}</small>
                </div>
            </div>
            <div class="user-card-buttons">
                <div class="user-card-upper-buttons">
                    <select 
                        class="user-card-roles" 
                        v-model="form.role" 
                        name="" 
                        id=""
                    >
                        <option
                            v-for="option in options"
                            :key="option.id"
                            v-bind:value="option.type"
                        >
                            {{ option.name }}
                        </option>
                    </select>
                    <button @click="showDeleteModal()" class="remove-user-button" />
                </div>
                <button @click="updateUserRole()" class="btn-action btn">Aktualizovať</button>
            </div>
        </div>
        <b-modal
            hide-footer
            ref="delete-modal"
        >
            <b-row>
                <p class="text-center">Naozaj chcete odstrániť používateľa {{ user.name }}?</p>
                <b-col>
                    <b-button @click="closeModal()" class="float-end" variant="outline-primary">Nie</b-button>
                </b-col>
                <b-col>
                    <b-button @click="deleteUser()" variant="danger">Áno</b-button>
                </b-col>
            </b-row>
        </b-modal>
    </form>
</template>

<script>

    export default {
        data() {
            return {
                options: [
                    { id: 1, name: 'Používateľ', type: 'user' },
                    { id: 2, name: 'Historik', type: 'historian' },
                    { id: 3, name: 'Administrátor', type: 'admin' }
                ],

                form: {
                    id: this.user.id,
                    role: this.user.role,
                }
            }
        },

        props: {
            user: ''
        },

        methods: {
            updateUserRole: function() {
                axios.post('/api/update_user_role', this.form).then((response) => {
                    alert('Úspešne sa podarilo aktualizovať rolu používateľa!');
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            showDeleteModal: function() {
                this.$refs['delete-modal'].show();
            },

            closeModal: function() {
                this.$refs['delete-modal'].hide();
            },

            deleteUser: function() {
                axios.delete('/api/delete_user', { data: this.form }).then((response) => {
                    var msg = 'Používateľ ' + response.data.name + ' úspešne zmazaný!';
                    alert(msg);
                    this.$refs['delete-modal'].hide();
                    this.$emit('deleteUser', this.user.id);
                }).catch((error) => {
                    console.log(error.response);
                });
            }
        }
    }

</script>