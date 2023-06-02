require('./bootstrap');

import { App, plugin } from '@inertiajs/inertia-vue';
import Vue from 'vue';
import Vuex from 'vuex';
import VueSweetalert2 from 'vue-sweetalert2';
import FileManager from 'laravel-file-manager';
import BaseHelper from "./Helpers/BaseHelper";

Vue.prototype.minmaxConfig = require('./app-config.json');

Vue.use(plugin);
Vue.use(Vuex);
const store = new Vuex.Store({
  state: {
    formBusy: false
  },
  mutations: {
    setBusy (state) {
      state.formBusy = true;
    },
    clearBusy (state) {
      state.formBusy = false;
    }
  }
});
Vue.use(VueSweetalert2);
Vue.use(FileManager, {store});

Vue.mixin(BaseHelper);

const el = document.getElementById('app');

$(function () {
  new Vue({
    store,
    render: h => h(App, {
      props: {
        initialPage: JSON.parse(el.dataset.page),
        resolveComponent: name => import(/* webpackChunkName: "pages/[request]" */ `./Pages/${name}`).then(module => module.default),
      },
    }),
  }).$mount(el);
});
