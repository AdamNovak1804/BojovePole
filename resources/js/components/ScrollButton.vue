<style scoped>

    .scroll-body
    {
        width: 100%;
        height: 200px;
        position: fixed;
        z-index: 100;
        bottom: 0;
        background-image: url('../../../public/img/scrollshadow.png');
        background-size: cover;
    }

    .scroll-btn
    {
        border: none;
        position: relative;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
        width: 70px;
        height: 70px;
        background-image: url('../../../public/img/scrollbutton.png');
        background-size: cover;
        border-radius: 50%;
        box-shadow: 0px 2px 3px #999;
    }

</style>

<template>
    
    <div class="scroll-body">
        <button class="scroll-btn" @click="scroll()" />
    </div>

</template>

<script>

    export default {

        data() {
            return {
                scrolling: false
            }
        },

        mounted() {
            console.log('Component mounted.')
        },

        created() {
            window.addEventListener('scroll', this.handleScroll);
        },

        destroyed() {
            window.removeEventListener('scroll', this.handleScroll);
        },

        props: {
            index: '',
            count: '',
        },

        methods: {
            scroll: function() {
                var nextCard = document.getElementById(this.index + 1);
                var nextTop = nextCard.offsetTop;
                window.scrollTo(0, nextTop);
            },

            handleScroll: function() {
                var windowTop = document.body.scrollTop;
                var windowBottom = windowTop + window.innerHeight;

                var thisCard = document.getElementById(this.index);
                var thisTop = thisCard.offsetTop;

                if (this.index != this.count) {
                    var nextCard = document.getElementById(this.index + 1);
                    var nextBottom = nextCard.offsetTop + nextCard.offsetHeight;
                }

                if (this.index != 1 && thisTop > windowTop) {
                    this.$emit('nextCard', (this.index - 1));
                    this.$emit('checkLast', true);
                }
                else if ((this.index + 1) >= this.count && nextBottom <= windowBottom) {
                    this.$emit('checkLast', false);
                }

                if (this.index != this.count && nextBottom <= windowBottom) {
                    this.$emit('nextCard', (this.index + 1));
                }
            }
        }

    }

</script>