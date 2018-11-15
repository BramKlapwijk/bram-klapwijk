
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import TextComponent from './components/TextComponent.vue';
import CardListComponent from './components/CardListComponent.vue';
import SliderComponent from './components/SliderComponent.vue';

Vue.component('text-component', TextComponent);
Vue.component('card-list', CardListComponent);
Vue.component('slider-component', SliderComponent);

const app = new Vue({
    el: '#app'
});
