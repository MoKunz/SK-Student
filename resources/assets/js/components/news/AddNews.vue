<!--suppress XmlInvalidId -->
<template>
    <div id="app-news-add" class="app-overlay-container">
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
        <md-layout id="news-add-mainframe" class="content-container">
            <md-layout md-flex="25" md-flex-medium="10" md-flex-small="5" md-hide-xsmall></md-layout>
            <md-layout id="news-section" md-align="center" md-flex-medium="80" md-flex-small="90" md-flex-xsmall="100"
                       md-flex="50"
                       md-row :md-gutter="true">
                <md-layout md-row md-align="start" md-flex="100" style="flex-flow: column">
                    <form novalidate @submit.stop.prevent="submit" id="news-add-form" style="flex: 0">
                        <md-input-container>
                            <label>Title</label>
                            <md-input v-model="title"></md-input>
                        </md-input-container>
                        <span class="input-helper-text">This will be the main title</span>

                        <md-chips v-model="tags" md-input-placeholder="Add a tag" class="input-chip-adjust-padding">
                            <template scope="chip">{{ chip.value }}</template>
                        </md-chips>
                        <span class="input-helper-text">Should have at most 5 tags</span>

                        <md-input-container>
                            <label>Content</label>
                            <md-textarea v-model="content"></md-textarea>
                        </md-input-container>
                        <span class="input-helper-text">You can use markdown for the content</span>

                        <md-input-container>
                            <md-file ref="imageFile" placeholder="Select image"
                                     v-on:selected="imageFileChanged"></md-file>
                        </md-input-container>
                        <span class="input-helper-text">Maximum file size is 2MB. Image should be in 16:9 ratio</span>
                    </form>
                    <img ref="imagePreview" class="image-responsive-default" src="//via.placeholder.com/1280x720"
                         style="padding: 8px 0 8px 0;">
                </md-layout>
            </md-layout>
            <md-layout md-flex="25" md-flex-medium="10" md-flex-small="5" md-hide-xsmall></md-layout>
        </md-layout>
    </div>
</template>

<script>
    import axios from 'axios';
    import _ from 'lodash';
    const LOG_PREFIX = '[News/Add] ';
    export default {
        data: function () {
            return {
                touch: false,
                title: '',
                tags: [],
                content: '',
                imageFile: null,
            };
        },
        mounted(){

        },
        methods: {
            doneAction(){
                var self = this;
                var data = new FormData();
                data.append('title', this.title);
                this.tags.forEach((tag) => {
                    data.append('tags[]', tag)
                });
                //data.append('tags',this.tags);
                data.append('content', this.content);
                data.append('image', this.imageFile);
                axios.post(APP_API_ENTRY + '/news/add', data).then((response) => {
                    if (response.data.success)
                        console.log(LOG_PREFIX + 'Posted');
                    self.$parent.$emit('news.posted');
                    self.$router.back();
                }).catch((err) => {
                    console.log(err);
                });
                console.log(LOG_PREFIX + 'Posting news...');
            },
            imageFileChanged(e){
                var reader = new FileReader();
                var self = this;
                reader.onload = function (e) {
                    // get loaded data and render thumbnail.
                    self.$refs.imagePreview.src = e.target.result;
                };
                // set current file
                this.imageFile = e[0];
                // read the image file as a data URL.
                if (e[0] instanceof Blob)
                    reader.readAsDataURL(e[0]);
                else
                    self.$refs.imagePreview.src = '//via.placeholder.com/1280x720';
            },
            doTouch(){
                this.touch = true;
            }
        }
    }
</script>