/**
 * Core script for progressive web app
 */
// Main library
import VueRouter from 'vue-router';

// Import app component
import News from './components/news/News.vue';
import Timeline from './components/timeline/Timeline.vue';
import AddNews from './components/news/AddNews.vue';

// Vue maaterial
window.Vue = require('vue');
window.VueMaterial = require('vue-material');
window.VueRouter = require('vue-router');
Vue.use(window.VueMaterial);
Vue.use(VueRouter);
Vue.material.setCurrentTheme('default');

// Library stuff
window._ = require('lodash');

const APP_NAME = "SK Student";

// Router
const router = new VueRouter({
    mode: 'history',
    routes: [
        // News app
        {
            name: 'news',
            path: '/app/news',
            components: {
                default: News
            },
            meta: {
                title: 'News',
                appTitle: 'News'
            },
            children: []
        },
        // News add
        {
            name: 'news-add',
            path: '/app/news/add',
            meta: {
                title: 'Add News',
                appTitle: 'News'
            },
            components: {
                default: News,
                overlay: AddNews
            }
        },
        // Timeline app
        {
            name: 'timeline',
            path: '/app/timeline',
            meta: {
                title: 'Timeline',
                appTitle: 'Timeline'
            },
            components: {
                default: Timeline
            }
        }
    ]
});
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.title)) {
        document.title = to.meta.title + " - " + APP_NAME;
        app.appTitle = to.meta.appTitle;
    }
    else {
        document.title = app.appTitle = APP_NAME;
    }
    next()
});

// App
window.app = new Vue({
    router,
    data: {
        searchBar: false,
        appTitle: "SK Student",
        loginSystem: {
            token: '1234',
            user: 'fd',
            group: 'admin',
        }
    },
    methods: {
        toggleLeftSideNav (){
            this.$refs.leftSidenav.toggle();
        },
        toggleSearchBar (){
            this.searchBar = !this.searchBar;
            if(this.searchBar){
                _.delay(() => {
                    this.$refs.searchInput.$el.focus();
                },1);
            }
        }
    }
}).$mount('#app');