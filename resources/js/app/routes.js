import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from './Home.vue';
import Login from './Login.vue';
import Dashboard from './Dashboard.vue';

Vue.use(VueRouter);

export const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/dashboard',
        component: Dashboard
    }
]