@extends('app.layouts.app')

@section('title','News')
@section('body-class','md-theme-default')

@section('meta')
    <link rel="manifest" href="/manifest.json">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="{{config('app.name')}}">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#2196f3">
@endsection

@section('body')
    <div id="app">
        <!-- splash screen -->
        <div id="app-splash" class="app-hide" :class="appDisplay" style="background: #2196f3;"></div>
        <!-- overlay -->
        <router-view name="overlay"></router-view>
        <router-view name="appBar"></router-view>
    <!--<md-whiteframe md-elevation="3" class="nav-wrapper">
            <md-toolbar>
                <div class="md-toolbar-container">
                    <md-button class="md-icon-button" @click.native="toggleLeftSideNav">
                        <md-icon>menu</md-icon>
                    </md-button>
                    <h1 class="md-title">@{{appTitle}}</h1>
                    <span style="flex: 1"></span>
                    <md-input-container v-show="searchBar" md-inline style="width: 50%">
                        <label>Search</label>
                        <md-input id="search" ref="searchInput" autofocus v-on:blur.native="toggleSearchBar"></md-input>
                    </md-input-container>
                    <md-button v-on:click.native="toggleSearchBar" class="md-icon-button">
                        <md-icon>search</md-icon>
                    </md-button>
                    <md-button class="md-icon-button">
                        <md-icon>refresh</md-icon>
                    </md-button>
                    <md-menu md-direction="bottom left" md-size="4">
                        <md-button class="md-icon-button" md-menu-trigger>
                            <md-icon>more_vert</md-icon>
                        </md-button>
                        <md-menu-content>
                            <md-menu-item>
                                <span>Find on map</span>
                                <md-icon>near_me</md-icon>
                            </md-menu-item>

                            <md-menu-item>
                                <span>Call</span>
                                <md-icon>phone</md-icon>
                            </md-menu-item>
                        </md-menu-content>
                    </md-menu>
                </div>
            </md-toolbar>
        </md-whiteframe>-->
        <md-sidenav id="sidebar-section" class="md-left md-fixed" ref="leftSidenav" md-swipeable style="z-index:9">
            <md-toolbar class="md-large md-account-header">
                <md-list class="md-transparent">
                    <md-list-item class="md-avatar-list">
                        <md-avatar class="md-large">
                            <img src="/img/android-chrome-192x192.png" alt="Kornor">
                        </md-avatar>

                        <span style="flex: 1"></span>
                    </md-list-item>

                    <md-list-item id="profile-name">
                        <div class="md-list-text-container">
                            <template v-if="loginSystem.loggedIn">
                                <span>@{{loginSystem.data.name}}</span>
                                <span>@{{loginSystem.data.email}} <a href="#" v-on:click="logout()">(Logout)</a></span>
                            </template>
                            <template v-else>
                                <span>Guest</span>
                                <span id="login-register-text">
                                    <router-link :to="{ name: 'account-login'}">Login</router-link>  <!-- | <router-link
                                            :to="{ name: 'account-register'}">Register</router-link>-->
                                </span>
                            </template>
                        </div>
                        <md-button class="md-icon-button md-list-action hidden">
                            <md-icon>arrow_drop_down</md-icon>
                        </md-button>
                    </md-list-item>
                </md-list>
                <md-list id="menu-section">
                    <router-link id="app-link-news" :to="{ name: 'news'}">
                        <md-list-item v-on:click.native="toggleLeftSideNav">
                            <md-icon>announcement</md-icon>
                            <span>News</span>
                        </md-list-item>
                    </router-link>

                    <md-list-item>
                        <md-icon>today</md-icon>
                        <span>Timeline/Schedule(Coming Soon)</span>
                    </md-list-item>
                    <router-link id="app-link-activity-day" :to="{ name: 'activity-day'}">
                        <md-list-item v-on:click.native="toggleLeftSideNav">
                            <md-icon>toys</md-icon>
                            <span>Activity Day 2017</span>
                        </md-list-item>
                    </router-link>
                    <md-divider class="menu-divider"></md-divider>
                    <router-link id="app-link-account" :to="{ name: 'account'}">
                        <md-list-item v-on:click.native="toggleLeftSideNav">
                            <md-icon>account_box</md-icon>
                            <span>Account</span>
                        </md-list-item>
                    </router-link>
                </md-list>
            </md-toolbar>
        </md-sidenav>
        <main id="main-content" class="main-content">
            <router-view></router-view>
        </main>
    </div>
@endsection