<template>
    <div>
        <user-card
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
            }
        }
    }

</script>