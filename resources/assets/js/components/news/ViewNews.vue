<!--suppress XmlInvalidId -->
<template>
    <div class="app-overlay-container">
        <md-whiteframe :md-elevation="elevation">
            <md-toolbar id="toolbar-transparent">
                <md-button class="md-icon-button" v-on:click.native="doneAction">
                    <md-icon>arrow_back</md-icon>
                </md-button>
                <h1 class="md-title">{{$route.params.name}}</h1>
                <span style="flex: 1"></span>
                <md-button class="md-icon-button">
                    <md-icon>more_vert</md-icon>
                </md-button>
            </md-toolbar>
            <div id="toolbar-fake-background" class="toolbar-background" :style="{opacity:toolbarAlpha}"></div>
        </md-whiteframe>
        <md-layout ref="mainContent" id="news-view-mainframe" class="content-container">
            <div class="news-image-container"><img src="/img/test.jpg" :style="imageStyle"></div>
            <div class="news-content-main">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque mattis tellus erat, quis pretium dui
                    dapibus in. Nunc maximus tincidunt nisl, eget dapibus mauris vestibulum a. Nullam nulla nunc,
                    elementum vel orci eget, molestie fringilla felis. Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit. Mauris non aliquet sapien. Duis in mollis tortor. Duis facilisis mollis nulla, quis
                    auctor dui pellentesque et. Pellentesque nunc arcu, pharetra non lacus tempor, pellentesque
                    imperdiet quam. Integer molestie ligula a tempor rhoncus. Donec in imperdiet ligula. Maecenas sed mi
                    eu sapien facilisis tincidunt. Nunc volutpat lacus a felis pretium, quis varius tellus luctus. Ut
                    egestas lacus quis libero egestas, et dictum nulla aliquet. Pellentesque tincidunt tellus orci,
                    tincidunt elementum lacus vulputate at. Duis vehicula interdum nisl non lacinia.</p>
                <p>Aenean euismod quam vel odio aliquet, sed eleifend mauris consequat. Proin suscipit pulvinar quam,
                    non luctus lacus blandit ac. Fusce non sem metus. Lorem ipsum dolor sit amet, consectetur adipiscing
                    elit. Phasellus ultrices dolor vitae arcu faucibus, id dictum ligula ultricies. Curabitur a rhoncus
                    sapien, vitae faucibus libero. Phasellus condimentum nulla libero, ac congue diam ornare id.</p>
                <p>Nulla massa metus, ultricies nec egestas posuere, ullamcorper vitae metus. Nunc finibus lacinia neque
                    ac rhoncus. Phasellus erat nisl, rutrum a orci eget, sagittis varius neque. Duis venenatis, eros ut
                    porttitor posuere, ipsum nibh scelerisque dui, id aliquet odio neque non justo. Quisque ac nibh quis
                    justo fermentum auctor id facilisis ipsum. Nulla sit amet scelerisque erat, non accumsan dui. Donec
                    sollicitudin nisi dapibus, varius elit ut, viverra elit.</p>
                <p>Fusce consequat metus est, non malesuada eros lobortis eget. In hac habitasse platea dictumst.
                    Integer nec erat interdum tortor vestibulum rhoncus. Donec sit amet velit at nulla convallis mollis.
                    Duis augue nunc, iaculis vel libero non, malesuada viverra quam. Nullam euismod fringilla dui, quis
                    porttitor risus euismod at. Vivamus laoreet ipsum justo, quis convallis sem dapibus ac. In porta
                    arcu ut massa pellentesque, vitae faucibus est scelerisque. Proin ultricies fringilla mi, id gravida
                    dui eleifend et. Cras pretium nisi vel velit sodales, vitae posuere nunc finibus. Nulla faucibus
                    diam in quam placerat, quis maximus erat maximus.</p>
                <p>Cras at quam placerat, bibendum libero ut, tempus est. Nam mollis est justo, elementum suscipit
                    lectus tristique sed. Pellentesque a accumsan massa. Pellentesque felis justo, maximus quis est nec,
                    tincidunt tincidunt velit. Praesent elit libero, volutpat id mollis in, vehicula vel mi. Nunc libero
                    mi, faucibus sit amet tempor nec, vulputate quis tortor. Nunc eget pulvinar nisl, a dictum nisi.
                    Praesent vel sodales mauris, in luctus odio. Orci varius natoque penatibus et magnis dis parturient
                    montes, nascetur ridiculus mus. Pellentesque mi libero, molestie vel ultricies laoreet, iaculis
                    vitae augue. Nunc molestie mi quis magna malesuada mattis. Aenean mattis nisl arcu, quis elementum
                    mauris dapibus non. Maecenas eu sapien id lorem ultrices varius interdum vel augue. Ut mattis odio
                    quis magna pretium, ac ullamcorper justo molestie. Donec tempor dictum elementum. Curabitur libero
                    leo, fringilla in faucibus vitae, viverra id massa.</p>
            </div>
        </md-layout>
    </div>
</template>

<style>
    #toolbar-fake-background {
        background-color: #2196F3;
    }

    #toolbar-transparent {
        background-color: rgba(0, 0, 0, 0);
        z-index: 5;
    }

    #news-view-mainframe {
        margin-top: -64px;
    }

    .news-content-main {
        padding: 12px;
    }

    .news-image-container {
        background-color: #2196F3;
    }
</style>

<script>
    let mainContainer = null;
    export default {
        data: function () {
            return {
                scrollPos: 0,
                imageHeightPercent: 56.5,
                windowWidth: 0,
            };
        },
        props: ['name'],
        mounted(){
            // Dynamic background toolbar
            mainContainer = document.getElementById('news-view-mainframe');
            mainContainer.addEventListener('scroll', _.throttle(this.handleScroll, 16));
            // Responsive image
            window.addEventListener('resize', this.handleResize);
            this.handleResize();
            console.log(this.name);
        },
        methods: {
            doneAction(){
                this.$router.back();
            },
            handleScroll(){
                this.scrollPos = mainContainer.scrollTop;
            },
            handleResize(){
                this.windowWidth = window.outerWidth;
            }
        },
        computed: {
            imageHeight: function () {
                return (this.imageHeightPercent / 100) * this.windowWidth;
            },
            imageStyle: function () {
                return {
                    width: '100%',
                    height: this.imageHeight + 'px',
                    opacity: -(this.containerAlpha - 1)
                };
            },
            containerAlpha: function () {
                var pos = this.scrollPos;
                if (pos == 0) return 0;
                else if (pos >= this.imageHeight - 64) return 1;
                else return (pos) / (this.imageHeight - 64.0);
            },
            toolbarAlpha: function () {
                if (this.containerAlpha >= 1) return 1;
                else return 0;
            },
            elevation: function () {
                if (this.toolbarAlpha >= 1) return 3;
                else return 0;
            }
        }
    }
</script>