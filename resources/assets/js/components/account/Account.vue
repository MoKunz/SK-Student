<template>
    <div id="app-account">
        <div v-if="$parent.loginSystem.loggedIn">
            Lorem ipsum
        </div>
        <div v-else>
            <md-layout id="news-container">
                <md-layout md-flex="25" md-flex-small="10" md-hide-xsmall></md-layout>
                <md-layout id="news-section" md-align="center" md-flex-small="80" md-flex-xsmall="100" md-flex="50"
                           md-row :md-gutter="true">
                    <md-layout md-row md-flex="100" md-align="center">
                        <template v-for="item in news.data">
                            <md-card class="news-card">
                                <md-card-header>
                                    <md-avatar>
                                        <img src="//vuematerial.github.io/assets/avatar.png"
                                             alt="Wittaya Srichompoo">
                                    </md-avatar>
                                    <div class="md-title">{{item.name}}</div>
                                    <div class="md-subhead">{{item.created_at}} - {{item.category.name}}</div>
                                </md-card-header>

                                <md-card-content>
                                    {{item.content.substring(0,100)}}
                                </md-card-content>
                                <md-card-media md-ratio="16:9" v-if="Math.random() > 0.5">
                                    <img src="//lorempixel.com/1600/900/" alt="People">
                                </md-card-media>
                            </md-card>
                        </template>
                        <md-spinner md-indeterminate id="loading" v-show="spinner"></md-spinner>
                    </md-layout>
                </md-layout>
                <md-layout md-flex="25" md-flex-small="10" md-hide-xsmall></md-layout>
            </md-layout>
        </div>
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