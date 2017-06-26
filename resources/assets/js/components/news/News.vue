<template>
    <div class="app-container">
        <!--<md-speed-dial id="action-add-news" md-mode="scale" class="md-fab-bottom-right" style="position: fixed">
            <md-button class="md-fab" v-on:click.native="actionAddNews">
                <md-icon>add</md-icon>
            </md-button>
        </md-speed-dial>-->
        <md-speed-dial v-show="$parent.loginSystem.loggedIn" md-mode="scale" class="md-fab-bottom-right">
            <md-button class="md-fab" md-fab-trigger v-on:click.native="actionAddNews">
                <md-icon>add</md-icon>
            </md-button>

        </md-speed-dial>
        <md-layout id="content-container">
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
                                <div class="md-subhead">{{item.created_at}} by {{item.user.name}}</div>
                            </md-card-header>
                            <md-card-media md-ratio="16:9" v-if="item.media.length > 0">
                                <md-image :md-src="userImage(item.media[0].id)" :alt="item.media.name"></md-image>
                            </md-card-media>
                            <md-card-content>{{item.content.substring(0,100)}}</md-card-content>
                            <!-- Tag -->
                            <md-card-content v-if="item.tags.length > 0">
                                <template v-for="tag in item.tags">
                                    <md-chip>{{tag.name}}</md-chip>
                                    &nbsp;
                                </template>
                            </md-card-content>
                        </md-card>
                    </template>
                    <md-spinner class="app-spinner" md-indeterminate id="loading" v-show="spinner"></md-spinner>
                </md-layout>
            </md-layout>
            <md-layout md-flex="25" md-flex-small="10" md-hide-xsmall></md-layout>
        </md-layout>
    </div>
</template>

<style>

</style>

<script>
    import axios from 'axios';
    import * as ViewUtil from '../../util-view'
    const NEWS_TAKE = 5;
    export default {
        name: 'news',
        data: function () {
            return {
                loading: false,
                spinner: true,
                news: {
                    count: 0,
                    data: []
                }
            }
        },
        mounted() {
            document.getElementById('content-container').addEventListener('scroll', _.throttle(this.loadNews, 500));
            this.getNewsFromServer();
            this.$parent.$on('news.posted', () => {
                this.getNewsFromServer(true);
            });
        },
        methods: {
            actionAddNews() {
                var router = this.$router;
                router.push({'name': 'news-add'});
            },
            userImage(image) {
                return ViewUtil.userImageSrc(image);
            },
            loadNews() {
                var self = this;
                var el = document.getElementById('loading');
                if (ViewUtil.elementInViewport(el)) {
                    console.log('Loading...');
                    if (!self.loading) {
                        self.getNewsFromServer();
                    }
                }

            },
            getNewsFromServer(refresh = false) {
                var self = this;
                self.loading = true;
                axios.get('/app-api/news', {
                    params: {skip: refresh ? 0 : self.news.count, take: NEWS_TAKE}
                })
                        .then(function (response) {
                            if (refresh) self.news.data = [];
                            if (response.data.length > 0) {
                                _.each(response.data, function (value) {
                                    self.news.data.push(value);
                                });
                                self.news.count += NEWS_TAKE;
                            }
                            else{
                                console.log('Loading finished');
                                self.spinner = false;
                            }
                            self.loading = false;
                        })
                        .catch(function (error) {
                            console.error(error);
                            self.loading = false;
                        });
            }
        }
    }
</script>