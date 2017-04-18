<!--suppress XmlInvalidId -->
<template>
    <div id="app-news-view">
        <md-whiteframe md-elevation="3">
            <md-toolbar>
                <md-button class="md-icon-button" v-on:click.native="doneAction">
                    <md-icon>arrow_back</md-icon>
                </md-button>
                <h1 class="md-title">Add News</h1>
                <span style="flex: 1"></span>
                <md-button class="md-icon-button">
                    <md-icon>more_vert</md-icon>
                </md-button>
            </md-toolbar>
        </md-whiteframe>
        <md-layout id="news-view-mainframe">
            Lorem ipsum dolor sit amet
        </md-layout>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {

            };
        },
        methods: {
            doneAction(){
                this.$router.back();
            }
        }
    }
</script>