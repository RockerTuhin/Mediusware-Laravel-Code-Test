

require('./bootstrap');

//For using Vue Router Copied from https://router.vuejs.org/installation.html#direct-download-cdn
import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
//End For using Vue Router Copied from https://router.vuejs.org/installation.html#direct-download-cdn

//For connecting routes.js in this file
import {routes} from './routes';

//import User class
import User from './Helpers/User';
window.User = User;

//import Notification class
import Notification from './Helpers/Notification';
window.Notification = Notification;

//sweet alert start
import Swal from 'sweetalert2'
window.Swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
})
window.Toast = Toast;
//sweet alert end

window.Reload = new Vue();//For refresh

const router = new VueRouter({
  base: '/inventoryWithVueAndAPI/public',
  routes, // short for `routes: routes`
  mode: 'history',
})



const app = new Vue({
    el: '#app',
    router
});
