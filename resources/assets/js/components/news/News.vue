<template>
    <div class="app-news">
        <md-speed-dial id="action-add-news" md-mode="scale" class="md-fab-bottom-right" style="position: fixed">
            <md-button class="md-fab" v-on:click.native="actionAddNews">
                <md-icon>add</md-icon>
            </md-button>
        </md-speed-dial>
        <md-layout>
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
                    <br>
                </md-layout>
            </md-layout>
            <md-layout md-flex="25" md-flex-small="10" md-hide-xsmall></md-layout>
        </md-layout>
    </div>
</template>

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
            document.getElementById('main-section').addEventListener('scroll', _.throttle(this.loadNews, 500));
            this.getNewsFromServer();
        },
        methods: {
            actionAddNews() {
                var router = this.$router;
                router.push({'name': 'news-add'});
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
            getNewsFromServer() {
                var self = this;
                self.loading = true;
                axios.get('/api/app/news', {
                    params: {skip: self.news.count, take: NEWS_TAKE}
                })
                        .then(function (response) {
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