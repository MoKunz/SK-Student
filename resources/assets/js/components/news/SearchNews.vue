<template>
    <div id="app-news-add">
        <md-whiteframe md-elevation="3">
            <md-toolbar>
                <md-button class="md-icon-button absolute" v-on:click.native="$router.back()">
                    <md-icon>arrow_back</md-icon>
                </md-button>
                <form @submit.stop.prevent="search">
                    <input type="text" ref="inputSearch" v-model="searchQuery" id="news-search-input"
                           placeholder="Search"
                           class="input-full-width"/>
                    <input type="submit" style="display: none">
                </form>
                <md-button class="md-icon-button absolute" style="right:0" @click.native="clearSearch($event)">
                    <md-icon>close</md-icon>
                </md-button>
            </md-toolbar>
        </md-whiteframe>
        <md-layout id="news-add-mainframe">
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

<style>
    #news-search-input {
        margin-left: 56px;
        margin-right: 32px;
        padding-top: 8px;
        padding-bottom: 8px;
        height: 32px;
        font-size: 18px;
        color: rgba(255, 255, 255, .87);
        width: 100%;
    }

    #news-search-input::-webkit-input-placeholder {
        color: rgba(224, 224, 224, .87);
    }
</style>

<script>
    const LOG_PREFIX = '[News/Search] ';
    export default{
        data: function () {
            return {
                searchQuery: '',
            }
        },
        mounted(){
            _.delay(() => this.$refs.inputSearch.focus());
        },
        methods: {
            clearSearch(){
                this.searchQuery = '';
                this.$refs.inputSearch.focus();
            },
            autoComplete(){
                return new Promise((resolve, reject) => {
                    reject('Not implemented!');
                })
            },
            search(){
                this.$refs.inputSearch.blur();
                console.log(LOG_PREFIX + 'Begin complete search');
                console.warn(LOG_PREFIX + 'Not implemented!');
            }
        }
    }
</script>