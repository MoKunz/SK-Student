/**
 * Core script for progressive web app
 */
// Main library
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueMaterial from 'vue-material';
import VeeValidate from 'vee-validate';
import routesDef from './routes';
import AccountSystem from "./AccountSystem";
import AppConfig from './config';

// Vue maaterial
window.Vue = Vue;
Vue.use(VueMaterial);
Vue.use(VueRouter);
Vue.use(VeeValidate, AppConfig.validatorConfig);
Vue.material.registerTheme('default', AppConfig.defaultAppTheme);
Vue.material.setCurrentTheme('default');

// Library stuff
window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common = AppConfig.axiosHeader;

// constant
window.APP_NAME = "SK Student";
window.APP_API_ENTRY = "/app-api";

// Router
var router = new VueRouter({
    mode: 'history',
    routes: routesDef,
});
let guard = (to, from, next) => {
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
        show: false,
        loginSystem: new AccountSystem(window.app)
    },
    methods: {
        toggleLeftSideNav (){
            this.$refs.leftSidenav.toggle();
        },
        logout() {
            var self = this;
            this.loginSystem.logout().then(
                () => {
                    self.loginSystem.sync();
                    self.toggleLeftSideNav();
                }
            );
        }
    },
    computed: {
        appDisplay: function () {
            return {
                'app-show-animation': this.show
            }
        }
    },
    mounted(){
        var self = this;
        this.loginSystem.sync();
        _.delay(() => self.show = true, 100);
    }
}).$mount('#app');
window.app.name = APP_NAME;
window.app.apiEntry = APP_API_ENTRY;
window.app.version = '1.0.2';