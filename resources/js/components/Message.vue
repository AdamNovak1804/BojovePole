<style scoped>

    .message
    {
        border-left: 4px solid transparent;
    }

    .message:hover
    {
        background-color: #EEEEEE;
    }

    img
    {
        float: left;
        margin: 10px;
        border-radius: 50%;
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

</style>

<template>
    <div class="message">
        <img class="profile-pic" :src="require('../../../public/img/' + this.image).default" width="50px" height="50px" alt="">
        <div class="message-content">
            <h3>{{ user }}</h3>
            <p class="subject">{{ subject }}</p>
            <div class="date-container">
                <small class="date">{{ formatDate(posted) }}</small>
            </div>
        </div>
        <div hidden>
            <p>{{ email }}</p>
            <p>{{ message }}</p>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {

        props: [
            'image',
            'user',
            'message',
            'subject',
            'email',
            'posted'
        ],

        methods: {
            formatDate: function(date) {
                return moment(date).format('DD.MM.YYYY');
            }
        }

    }

</script>
