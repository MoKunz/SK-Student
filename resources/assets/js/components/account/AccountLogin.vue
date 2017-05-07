<template>
    <div id="app-account-login">
        <md-whiteframe md-elevation="3">
            <md-toolbar>
                <md-button class="md-icon-button" v-on:click.native="$router.back()">
                    <md-icon>close</md-icon>
                </md-button>
                <h1 class="md-title">Login</h1>
            </md-toolbar>
        </md-whiteframe>
        <md-layout id="news-add-mainframe">
            <md-layout md-flex="25" md-flex-small="10" md-hide-xsmall></md-layout>
            <md-layout id="news-section" md-align="center" md-flex-small="80" md-flex-xsmall="100" md-flex="50"
                       md-row :md-gutter="true">
                <md-layout md-row md-flex="100" md-align="center">
                    <form novalidate @submit.stop.prevent="submit" style="width: 100%">
                        <md-input-container v-bind:class="{ 'md-input-invalid': raiseError}">
                            <label>Email</label>
                            <md-input v-model="username" v-bind:disabled="processing"></md-input>
                        </md-input-container>
                        <md-input-container md-has-password v-bind:class="{ 'md-input-invalid': raiseError}">
                            <label>Password</label>
                            <md-input type="password" v-model="password" v-bind:disabled="processing"></md-input>
                            <span class="md-error">{{errorMessage}}</span>
                        </md-input-container>
                        <md-button type="submit" v-bind:disabled="processing" class="md-raised md-primary"
                                   v-on:click.native="login">Login
                        </md-button>
                        <md-spinner md-indeterminate v-show="processing"></md-spinner>
                    </form>
                </md-layout>
            </md-layout>
            <md-layout md-flex="25" md-flex-small="10" md-hide-xsmall></md-layout>
        </md-layout>
    </div>
</template>

<script>
    import axios from 'axios';
    const LOG_PREFIX = '[Account/login] ';
    export default{
        data: function () {
            return {
                username: '',
                password: '',
                processing: false,
                raiseError: false,
                errorMessage: 'Invalid username or password!'
            }
        },
        methods: {
            login() {
                var self = this;
                this.raiseError = false;
                this.processing = true;
                console.log(LOG_PREFIX + 'Logging in');
                this.$parent.loginSystem.login(this.username, this.password).then(
                        () => {
                            this.processing = false;
                            self.$router.back();
                        }
                ).catch(
                        () => {
                            this.processing = false;
                            this.raiseError = true;
                        }
                )
            }
        }

    }
</script>