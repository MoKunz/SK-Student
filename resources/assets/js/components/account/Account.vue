<template>
    <div class="app-container">
        <md-layout id="content-container">
            <md-layout md-flex="25" md-flex-small="10" md-hide-xsmall></md-layout>
            <md-layout id="news-section" md-align="center" md-flex-small="80" md-flex-xsmall="100" md-flex="50"
                       md-row :md-gutter="true">
                <md-layout md-row md-flex="100" md-align="center">
                </md-layout>
            </md-layout>
            <md-layout md-flex="25" md-flex-small="10" md-hide-xsmall></md-layout>
        </md-layout>
    </div>
</template>

<script>
    export default{
        mounted(){
            var app = this.$parent;
            if (app.loginSystem.loggedIn) app.appTitle = 'Account';
            else app.appTitle = 'Login/Register';
        },
    }
</script>