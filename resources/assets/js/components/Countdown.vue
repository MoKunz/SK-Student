<template>
    <div class="countdown-container">
        <p style="font-size: 36px; text-align: center;">Ready to vote in</p>
        <p class="digit" style="font-size: 32px; text-align: center; font-weight: 200">{{ hours | twoDigits }} : {{
            minutes | twoDigits }} : {{ seconds | twoDigits }}</p>
    </div>
</template>

<script>
    import Vue from 'vue'
    Vue.filter('twoDigits', (value) => {
        if (value.toString().length <= 1) {
            return '0' + value.toString()
        }
        return value.toString()
    });
    export default {
        props: ['deadline'],
        data() {
            return {
                now: Math.trunc((new Date()).getTime() / 1000),
                date: null
            }
        },
        mounted() {
            this.date = Math.trunc(Date.parse(this.deadline) / 1000)
            setInterval(() => {
                this.now = Math.trunc((new Date()).getTime() / 1000)
            }, 1000)
        },
        computed: {
            seconds() {
                return Math.trunc(this.date - this.now) % 60
            },
            minutes() {
                return Math.trunc((this.date - this.now) / 60) % 60
            },
            hours() {
                return Math.trunc((this.date - this.now) / 60 / 60) % 24
            },
            days() {
                return Math.trunc((this.date - this.now) / 60 / 60 / 24)
            }
        }
    }
</script>
<style lang="sass" rel="stylesheet/sass">
    .countdown-container
        transition: opacity 2s
        opacity: 1
        .vue-countdown
            padding: 0
            margin: 0
            li
                display: inline-block
                margin: 0 8px
                text-align: center
                position: relative
                &:after
                    content: ':'
                    position: absolute
                    top: 0
                    right: -16px
                    font-size: 32px
                &:first-of-type
                    margin-left: 0
                &:last-of-type
                    margin-right: 0
                    &:after
                        content: ''
            .digit
                font-size: 32px
                line-height: 1.4
                margin-bottom: 0
            .text
                text-transform: uppercase
                margin-bottom: 0
                font-size: 10px
</style>