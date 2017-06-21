<template>
    <div id="app-news-add" class="app-overlay-container">
        <md-whiteframe md-elevation="3">
            <md-toolbar id="news-search-toolbar">
                <md-button class="md-icon-button absolute" v-on:click.native="$router.back()">
                    <md-icon>arrow_back</md-icon>
                </md-button>
                <form @submit.stop.prevent="search">
                    <input ref="inputSearch" v-model="searchQuery" id="news-search-input"
                           placeholder="Search"
                           class="input-full-width"/>
                    <input type="submit" style="display: none">
                </form>
                <md-button class="md-icon-button absolute" style="right:0" @click.native="clearSearch($event)">
                    <md-icon>close</md-icon>
                </md-button>
            </md-toolbar>
            <div class="toolbar-background"></div>
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
        padding-top: 12px;
        padding-bottom: 8px;
        height: 32px;
        font-size: 18px;
        color: rgba(255, 255, 255, .87);
        width: 100%;
    }

    #news-search-toolbar {
        z-index: 5;
    }

    #news-search-input:-webkit-autofill {
        -webkit-box-shadow: 0 0 0 1000px rgb(33, 150, 243) inset !important;
        -webkit-text-fill-color: #fff !important;
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
                fieldName: ''
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