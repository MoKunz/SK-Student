/**
 * Core script for progressive web app
 */
// Main library
import VueRouter from 'vue-router';
import routesDef from './routes';

// Vue maaterial
window.Vue = require('vue');
window.VueMaterial = require('vue-material');
window.VueRouter = require('vue-router');
Vue.use(window.VueMaterial);
Vue.use(VueRouter);
Vue.material.setCurrentTheme('default');

// Library stuff
window._ = require('lodash');

// constant
const APP_NAME = "SK Student";

// Router
var router = new VueRouter({
    mode: 'history',
    routes: routesDef,
});
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.title)) {
        document.title = to.meta.title + " - " + APP_NAME;
    }
    else {
        document.title = APP_NAME;
    }
    next()
});
// App
window.app = new Vue({
    router,
    data: {
        searchBar: false,
        loginSystem: {
            loggedIn: false,
            user: 'fd',
            name: 'Wittaya Srichompoo',
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