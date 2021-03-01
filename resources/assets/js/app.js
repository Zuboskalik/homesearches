
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import VueRouter from 'vue-router';

window.Vue.use(VueRouter);
window.Vue.use(ElementUI);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import HomesearchesIndex from './components/homesearches/HomesearchesIndex.vue';

const routes = [
    {
        path: '/',
        components: {
            homesearchesIndex: HomesearchesIndex
        }
    },
]

const router = new VueRouter({ routes })

Vue.component('paginate', require('vuejs-paginate'));

const app = new Vue({ router }).$mount('#app')

