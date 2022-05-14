<template>
    <div>
        <user-card
            v-on:deleteUser="deleteUser"
            v-for="user in users"
            :key="user.id"
            :user="user"
        />
    </div>
</template>

<script>

    export default {
        data() {
            return {
                users: ''
            }
        },

        mounted() {
            this.getUsers();
        },

        methods: {
            getUsers: function() {
                axios.get('/api/get_users_and_roles').then((response) => {
                    this.users = response.data;
                }).catch((error) => {
                    console.log(error);
                });
            },

            deleteUser: function(id) {
                var index = this.users.findIndex((e) => e.id == id);
                this.users.splice(index, 1);
            }
        }
    }

</script>