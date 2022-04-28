<style scoped>

    .message
    {
        border-left: 4px solid transparent;
    }

    .message:hover
    {
        background-color: #EEEEEE;
    }

    .message-content
    {
        padding: 5px 10px 5px 5px;
        display: grid;
    }

    .message-content p
    {
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    .date-container
    {
        position: relative;
    }

    .date
    {
        position: absolute;
        bottom: 0;
        right: 0;
    }

    .subject
    {
        max-width: 140px;
    }

    .profile-pic
    {
        float: left;
        margin: 10px;
        border-radius: 50%;
        background-size: cover;
        background-position: center center;
    }

</style>

<template>
    <div class="message">
        <img class="profile-pic" :src="'/api/image/' + message.sender.image" width="50px" height="50px" alt="Profilový obrázok">
        <div class="message-content">
            <h3>{{ message.sender.name }}</h3>
            <p class="subject">{{ message.subject }}</p>
            <div class="date-container">
                <small class="date">{{ formatDate( message.created_at ) }}</small>
            </div>
        </div>
        <div hidden>
            <p>{{ message.sender.email }}</p>
            <p>{{ message.message }}</p>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {

        props: {
            message: '',
        },

        methods: {
            formatDate: function(date) {
                return moment(date).format('DD.MM.YYYY');
            },
        }

    }

</script>
