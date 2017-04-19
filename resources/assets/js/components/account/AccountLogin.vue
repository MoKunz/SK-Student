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
                        <md-input-container>
                            <label>Email</label>
                            <md-input></md-input>
                        </md-input-container>
                        <md-input-container md-has-password>
                            <label>Password</label>
                            <md-input type="password"></md-input>
                        </md-input-container>
                        <md-button class="md-raised md-primary">Login</md-button>
                    </form>
                </md-layout>
            </md-layout>
            <md-layout md-flex="25" md-flex-small="10" md-hide-xsmall></md-layout>
        </md-layout>
    </div>
</template>

<script>
    export default{}
</script>