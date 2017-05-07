<!--suppress XmlInvalidId -->
<template>
    <div id="app-news-add">
        <md-whiteframe md-elevation="3">
            <md-toolbar>
                <md-button class="md-icon-button" v-on:click.native="$router.back()">
                    <md-icon>arrow_back</md-icon>
                </md-button>
                <h1 class="md-title">Add News</h1>
                <span style="flex: 1"></span>
                <md-button class="md-icon-button" v-on:click.native="doneAction">
                    <md-icon>done</md-icon>
                </md-button>
            </md-toolbar>
        </md-whiteframe>
        <md-layout id="news-add-mainframe">
            <md-layout md-flex="25" md-flex-small="10" md-hide-xsmall></md-layout>
            <md-layout id="news-section" md-align="center" md-flex-small="80" md-flex-xsmall="100" md-flex="50"
                       md-row :md-gutter="true">
                <md-layout md-row md-flex="100" md-align="center">
                    <form novalidate @submit.stop.prevent="submit" id="news-add-form">
                        <md-input-container>
                            <label>Title</label>
                            <md-input placeholder="Title" v-model="title"></md-input>
                        </md-input-container>
                        <md-chips v-model="tags" md-input-placeholder="Add a tag">
                            <template scope="chip">{{ chip.value }}</template>
                        </md-chips>

                        <md-input-container>
                            <label>Content</label>
                            <md-textarea v-model="content"></md-textarea>
                        </md-input-container>
                    </form>
                </md-layout>
            </md-layout>
            <md-layout md-flex="25" md-flex-small="10" md-hide-xsmall></md-layout>
        </md-layout>
    </div>
</template>

<script>
    import axios from 'axios';
    const LOG_PREFIX = '[News/Add] ';
    export default {
        data: function () {
            return {
                touch: false,
                title: '',
                tags: [],
                content: ''
            };
        },
        mounted(){

        },
        methods: {
            doneAction(){
                var self = this;
                axios.post(APP_API_ENTRY + '/news/add', {
                    title: self.title,
                    tags: self.tags,
                    content: self.content
                }).then((response) => {
                    if (response.data.success)
                        console.log(LOG_PREFIX + 'Posted');
                    self.$parent.$emit('news.posted');
                    self.$router.back();
                }).catch((err) => {
                    console.log(err);
                });
                console.log(LOG_PREFIX + 'Posting news...');
            },
            doTouch(){
                this.touch = true;
            }
        }
    }
</script>