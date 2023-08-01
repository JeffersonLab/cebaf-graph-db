// import './bootstrap';

import Vue from 'vue'
window.Vue = Vue

import $ from 'jquery';
window.$ = $;

import datepicker from 'bootstrap-datepicker';


import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();
