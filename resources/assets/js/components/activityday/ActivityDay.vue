<template>
    <div class="app-container">
        <md-whiteframe md-elevation="4">
            <md-toolbar>
                <md-button class="md-icon-button" @click="$parent.toggleLeftSideNav()">
                    <md-icon>menu</md-icon>
                </md-button>
                <h1 class="md-title">Activity Day 2017</h1>
            </md-toolbar>
        </md-whiteframe>
        <div class="content-container" style="padding: 12px;">
            <md-layout md-flex="100" style="width: 100%; height: 100%;">
                <form novalidate @submit.stop.prevent="submit"
                      style="width: 100%; height: 100%;display: flex;flex-flow: column">
                    <!-- Second row -->
                    <md-layout :md-gutter="true" md-flex="10" style="min-height: 64px;">
                        <!-- Phone number -->
                        <md-layout md-gutter md-flex="100">
                            <md-input-container>
                                <label>Mobile phone number (For SMS)</label>
                                <md-input v-model="phone" type="tel" maxlength="10"></md-input>
                            </md-input-container>
                        </md-layout>
                    </md-layout>
                    <!-- Third row -->
                    <md-layout :md-gutter="true" md-flex="80" style="margin-top: 16px; padding: 8px;overflow-y:scroll;">
                        <!-- Select your club -->
                        <template v-for="club in clubs">
                            <md-layout md-row :md-gutter="true" md-flex="20" md-flex-small="50" md-flex-xsmall="100">
                                <md-radio v-model="clubSelection" v-bind:name="clubName(club.id)"
                                          v-bind:md-value="club.id">{{club.name}}
                                </md-radio>
                            </md-layout>
                        </template>
                    </md-layout>
                    <!-- Forth row -->
                    <md-layout :md-gutter="true" style="margin-top: 16px;" md-flex="10">
                        <span style="flex: 1"></span>
                        <md-button class="md-raised md-primary" @click="requestOTP">Vote</md-button>
                        <span style="flex: 1"></span>
                    </md-layout>
                </form>
            </md-layout>
        </div>
        <md-dialog :md-click-outside-to-close="false" ref="sms">
            <md-dialog-title>Enter your OTP</md-dialog-title>

            <md-dialog-content>
                <form novalidate @submit.stop.prevent="submit">
                    <md-input-container>
                        <label>OTP (Ref: {{otpRef}})</label>
                        <md-input type="tel" maxlength="6" v-model="otp"></md-input>
                    </md-input-container>
                </form>
                The OTP has been sent to your phone ({{phone}}), please enter it to continue.
            </md-dialog-content>

            <md-dialog-actions>
                <md-button class="md-primary" @click="closeDialog('sms')">Cancel</md-button>
                <md-button class="md-primary" @click="vote">Vote</md-button>
            </md-dialog-actions>
        </md-dialog>
        <md-dialog-alert
                :md-title="phoneUsed.title"
                :md-content-html="phoneUsed.contentHtml"
                ref="phoneUsed">
        </md-dialog-alert>

    </div>
</template>

<script>
    import axios from 'axios';
    export default{
        data: function () {
            return {
                voted: false,
                voteMessage: 'VOTE',
                nextMessage: 'NEXT',
                inProgress: false,
                otp: '',
                otpSent: false,
                otpRef: '000000',
                clubSelection: '',
                phone: '',
                clubs: [],
                phoneUsed: {
                    title: 'Error',
                    contentHtml: 'message'
                }
            };
        },
        mounted() {
            axios.get(APP_API_ENTRY + '/activity-day/clubs')
                    .then((response) => {
                        this.clubs = response.data;
                    })
                    .catch(() => {
                        console.log('Error while loading clubs list');
                    });
        },
        methods: {
            requestOTP(){
                axios.post(APP_API_ENTRY + '/activity-day/request-otp', {
                    'phone': this.phone,
                    'userAgent': navigator.userAgent,
                }).then((response) => {
                    if (response.data.success) {
                        this.otpRef = response.data.ref;
                        this.openDialog('sms');
                    }
                    else {
                        this.phoneUsed.contentHtml = response.data.message;
                        this.openDialog('phoneUsed');
                    }
                }).catch((err) => {
                    console.log('Unexpected error occurred');
                });
            },
            vote(){
                axios.post(APP_API_ENTRY + '/activity-day/vote', {
                    'phone': this.phone,
                    'otp': this.otp,
                    'club': this.clubSelection
                }).then((response) => {
                    this.closeDialog('sms');
                    if (response.data.succes) {
                        console.log('Success!');
                    }
                    else {

                    }
                }).catch((err) => {
                    console.log('Unexpected error occurred');
                });
            },
            clubName(name){
                return 'club-name-' + name;
            },
            openDialog(ref) {
                this.$refs[ref].open();
            },
            closeDialog(ref) {
                this.$refs[ref].close();
            },
        }
    }
</script>
