
require('./bootstrap');

window.Vue = require('vue').default;

// Vue.component('app', require('./app/App.vue').default);
import App from './app/App.vue'
import { routes } from './app/routes';
import { stores } from './app/store';
import VueRouter from 'vue-router';

const router = new VueRouter({
    routes,
    mode: 'history'
})
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router: router,
    store: stores,
    render: app => app(App)
});
