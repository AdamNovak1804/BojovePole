/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';
import router from './routes';

import { LMap, LTileLayer, LMarker, LControl, LIcon, LLayerGroup } from 'vue2-leaflet';
import { BButton, BFormRadioGroup, VBToggle, BCard, BCardText, BCollapse, BCarousel, BCarouselSlide, BPagination } from 'bootstrap-vue';

import 'leaflet/dist/leaflet.css';

/**
 * This fixes double rendering of the marker icon
 */

delete L.Icon.Default.prototype._getIconUrl
L.Icon.Default.mergeOptions({
  iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png').default,
  iconUrl: require('leaflet/dist/images/marker-icon.png').default,
  shadowUrl: require('leaflet/dist/images/marker-shadow.png').default,
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

Vue.component('home', require('./components/Home.vue').default);
Vue.component('intro', require('./components/Intro.vue').default);
Vue.component('navbar-header', require('./components/NavbarHeader.vue').default);
Vue.component('navbar-footer', require('./components/NavbarFooter.vue').default);
Vue.component('view-map', require('./components/ViewMap.vue').default);
Vue.component('add-map', require('./components/AddMap.vue').default);
Vue.component('family-member', require('./components/FamilyMember.vue').default);
Vue.component('battle-form', require('./components/BattleForm.vue').default);
Vue.component('messenger-form', require('./components/Messenger.vue').default);
Vue.component('message', require('./components/Message.vue').default);
Vue.component('post-message', require('./components/PostMessage.vue').default);
Vue.component('intro-card', require('./components/IntroCard.vue').default);
Vue.component('scroll-button', require('./components/ScrollButton.vue').default);

Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-marker', LMarker);
Vue.component('l-control', LControl);
Vue.component('l-icon', LIcon);
Vue.component('l-layer-group', LLayerGroup);

Vue.component('b-button', BButton);
Vue.component('b-form-radio-group', BFormRadioGroup);
Vue.component('b-card', BCard);
Vue.component('b-card-text', BCardText);
Vue.component('b-collapse', BCollapse);
Vue.component('b-carousel', BCarousel);
Vue.component('b-carousel-slide', BCarouselSlide);
Vue.component('b-pagination', BPagination);

Vue.directive('b-toggle', VBToggle);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
});
