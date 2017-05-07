<template>
    <md-whiteframe md-elevation="3" class="nav-wrapper">
        <md-toolbar>
            <div class="md-toolbar-container">
                <md-button class="md-icon-button" @click.native="$parent.toggleLeftSideNav">
                    <md-icon>menu</md-icon>
                </md-button>
                <h1 class="md-title">News</h1>
                <span style="flex: 1"></span>
                <!-- TODO: proper event for reloading -->
                <md-button class="md-icon-button" @click.native="$parent.$router.push({ name: 'news-search'})">
                    <md-icon>search</md-icon>
                </md-button>
                <md-button class="md-icon-button" @click.native="$parent.$emit('news.posted')">
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
    </md-whiteframe>
</template>