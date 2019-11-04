// require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';

import VueSweetalert2 from 'vue-sweetalert2';
const options = {
  confirmButtonColor: '#41b882',
  cancelButtonColor: '#ff7674'
}
Vue.use(VueSweetalert2, options)

Vue.component('ponente', require('./components/Ponente.vue').default);

const app = new Vue({
    el: '#app'
});
