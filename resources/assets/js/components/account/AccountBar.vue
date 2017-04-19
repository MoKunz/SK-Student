<template>
    <md-whiteframe md-elevation="3" class="nav-wrapper">
        <md-toolbar>
            <div class="md-toolbar-container">
                <md-button class="md-icon-button" @click.native="$parent.toggleLeftSideNav">
                    <md-icon>menu</md-icon>
                </md-button>
                <h1 class="md-title">Account</h1>
                <span style="flex: 1"></span>
            </div>
        </md-toolbar>
    </md-whiteframe>
</template>