/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';
import router from './routes';
import Vuex from 'vuex';

Vue.use(Vuex);

import { LMap, LTileLayer, LMarker, LControl, LIcon, LLayerGroup } from 'vue2-leaflet';
import {
  BButton,
  BFormRadioGroup,
  VBToggle,
  BCard,
  BCardText,
  BCollapse,
  BCarousel,
  BCarouselSlide,
  BPagination,
  BCardBody,
  BListGroup,
  BListGroupItem,
  BModal,
  VBModal,
  BRow,
  BCol,
  BCardGroup,
  BImg
} from 'bootstrap-vue';

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

Vue.component('user-settings', require('./components/Dashboard/UserSettings.vue').default);
Vue.component('unit-form', require('./components/Forms/UnitForm.vue').default);
Vue.component('battle-form', require('./components/Forms/BattleForm.vue').default);
Vue.component('cemetery-form', require('./components/Forms/CemeteryForm.vue').default);
Vue.component('landmark-form', require('./components/Forms/LandmarkForm.vue').default);
Vue.component('user-card', require('./components/Dashboard/UserCard.vue').default);

/**
 * Dashboard menus
 */
Vue.component('admin-menu', require('./components/Dashboard/Menu/AdminMenu.vue').default);
Vue.component('historian-menu', require('./components/Dashboard/Menu/HistorianMenu.vue').default);
Vue.component('family-member-menu', require('./components/Dashboard/Menu/FamilyMemberMenu.vue').default);

Vue.component('battle-edit-card', require('./components/Dashboard/HistorianCards/BattleEditCard.vue').default);
Vue.component('unit-edit-card', require('./components/Dashboard/HistorianCards/UnitEditCard.vue').default);

Vue.component('battle-edit', require('./components/Dashboard/BattleEdit.vue').default);
Vue.component('unit-edit', require('./components/Dashboard/UnitEdit.vue').default);

Vue.component('messenger-form', require('./components/Dashboard/Messenger.vue').default);
Vue.component('message', require('./components/Dashboard/Message.vue').default);
Vue.component('post-message', require('./components/Dashboard/PostMessage.vue').default);

Vue.component('intro-card', require('./components/IntroCard.vue').default);
Vue.component('scroll-button', require('./components/ScrollButton.vue').default);
Vue.component('error-list', require('./components/ErrorList.vue').default);

Vue.component('battle-preview', require('./components/Previews/BattlePreview.vue').default);
Vue.component('unit-preview', require('./components/Previews/UnitPreview.vue').default);
Vue.component('cemetery-preview', require('./components/Previews/CemeteryPreview').default);
Vue.component('landmark-preview', require('./components/Previews/LandmarkPreview.vue').default);

Vue.component('battle-view', require('./components/Views/BattleView.vue').default);
Vue.component('unit-view', require('./components/Views/UnitView.vue').default);
Vue.component('cemetery-view', require('./components/Views/CemeteryView.vue').default);
Vue.component('landmark-view', require('./components/Views/LandmarkView.vue').default);

Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-marker', LMarker);
Vue.component('l-control', LControl);
Vue.component('l-icon', LIcon);
Vue.component('l-layer-group', LLayerGroup);

Vue.component('b-button', BButton);
Vue.component('b-form-radio-group', BFormRadioGroup);
Vue.component('b-card', BCard);
Vue.component('b-card-group', BCardGroup);
Vue.component('b-card-text', BCardText);
Vue.component('b-collapse', BCollapse);
Vue.component('b-carousel', BCarousel);
Vue.component('b-carousel-slide', BCarouselSlide);
Vue.component('b-pagination', BPagination);
Vue.component('b-card-body', BCardBody);
Vue.component('b-list-group', BListGroup);
Vue.component('b-list-group-item', BListGroupItem);
Vue.component('b-modal', BModal);
Vue.component('b-row', BRow);
Vue.component('b-col', BCol);
Vue.component('b-img', BImg);

Vue.directive('b-toggle', VBToggle);
Vue.directive('b-modal', VBModal);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const store = new Vuex.Store({
  state: {
    image: ''
  },

  mutations: {
    changeImage(state, image) {
        state.image = image;
    },

    initImage(state, image) {
      if (state.image === '') {
        try {
          state.image = require('/images/' + image).default;
        } catch (error) {
          location.reload();
        }
      }
    },

    unselectImage(state) {
      state.image = '';
    }
  }
})

const app = new Vue({
    el: '#app',
    store,
    router,
});
