/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

//Routes
import { routes } from './routes';
const router = new VueRouter({
    routes
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('client', require('./Components/Client/Client.vue').default);
Vue.component('client-form', require('./Components/Client/ClientForm.vue').default);
Vue.component('client-list', require('./Components/Client/ClientList.vue').default);
Vue.component('transaction', require('./Components/Transaction/Transaction.vue').default);
Vue.component('transaction-form', require('./Components/Transaction/TransactionForm.vue').default);
Vue.component('transaction-list', require('./Components/Transaction/TransactionList.vue').default);
Vue.component('loader', require('./Components/Loader.vue').default);
Vue.component('header-bar', require('./Components/Layout/HeaderBar.vue').default);
Vue.component('client-page', require('./Components/Pages/ClientPage.vue').default);
Vue.component('transaction-page', require('./Components/Pages/TransactionPage.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
