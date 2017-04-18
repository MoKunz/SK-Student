<!--suppress XmlInvalidId -->
<template>
    <div id="app-news-add">
        <md-whiteframe md-elevation="3">
            <md-toolbar>
                <md-button class="md-icon-button" v-on:click.native="doneAction">
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
                            <md-input placeholder="Title"></md-input>
                        </md-input-container>
                        <md-input-container>
                            <label for="category">Category</label>
                            <md-select name="category" id="category">
                                <md-option value="1">Student Space</md-option>
                                <md-option value="2">Student Committee</md-option>
                                <md-option value="3">School</md-option>
                                <md-option value="4">Developer</md-option>
                            </md-select>
                        </md-input-container>
                        <md-chips v-model="tags" md-input-placeholder="Add a tag">
                            <template scope="chip">{{ chip.value }}</template>
                        </md-chips>

                        <md-input-container>
                            <label>Content</label>
                            <md-textarea></md-textarea>
                        </md-input-container>
                    </form>
                </md-layout>
            </md-layout>
            <md-layout md-flex="25" md-flex-small="10" md-hide-xsmall></md-layout>
        </md-layout>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                tags: []
            };
        },
        methods: {
            doneAction(){
                this.$router.back();
            }
        }
    }
</script>