/**
 * Core script for progressive web app
 */
// Main library
import VueRouter from 'vue-router';
import routesDef from './routes';
import AccountSystem from "./AccountSystem";

// Vue maaterial
window.Vue = require('vue');
window.VueMaterial = require('vue-material');
window.VueRouter = require('vue-router');
Vue.use(window.VueMaterial);
Vue.use(VueRouter);
Vue.material.setCurrentTheme('default');

// Library stuff
window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

// constant
window.APP_NAME = "SK Student";
window.APP_API_ENTRY = "/app-api";

// Router
var router = new VueRouter({
    mode: 'history',
    routes: routesDef,
});
var guard = (to, from, next) => {
    if (to.matched.some(record => record.meta.title)) {
        document.title = to.meta.title + " - " + APP_NAME;
    }
    else {
        document.title = APP_NAME;
    }
    next()
};
router.beforeEach(guard);
// App
window.app = new Vue({
    router,
    data: {
        searchBar: false,
        loginSystem: new AccountSystem(window.app)
    },
    methods: {
        toggleLeftSideNav (){
            this.$refs.leftSidenav.toggle();
        },
        logout() {
            var self = this;
            this.loginSystem.logout().then(
                (res) => {
                    self.loginSystem.sync();
                    console.log('Logout success');
                    self.toggleLeftSideNav();
                }
            );
        }
    },
    mounted(){
        this.loginSystem.sync();
    }
}).$mount('#app');