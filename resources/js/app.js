require('./bootstrap');
window.Vue = require('vue');

import App from './App.vue';
import MapaProfesionales from './components/components-subparts/Profesionales_mapa.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
import {LMap, LTileLayer, LMarker} from 'vue2-leaflet';
import 'leaflet/dist/leaflet.css';
import Vue from 'vue';
import i18n from '../i18n/i18n'; // Traduccion
import VueScheduler from 'v-calendar-scheduler';//calendario
import 'v-calendar-scheduler/lib/main.css';//etilos calendario
import VCalendar from 'v-calendar';

// Use v-calendar & v-date-picker components
Vue.use(VCalendar, {
  componentPrefix: 'vc',  // Use <vc-calendar /> instead of <v-calendar />
                // ...other defaults
});

Vue.use(VueScheduler);//calendario


Vue.use(VueRouter);
Vue.use(VueAxios, axios);

// Mapa Componente
Vue.component('l-map', LMap);
Vue.component('l-title-layer', LTileLayer);
Vue.component('l-maker', LMarker);

// Mapa Profesionales
Vue.component('mapa-prof', MapaProfesionales);
  
const router = new VueRouter({
    mode: 'history',
    routes: routes
});

Vue.config.devtools = true;

const app = new Vue({
    data:{
      user: {},
      photo:'sources/img/avatar.jfif',
      device: false,
    },
    el: '#app',
    router: router,
    i18n,
    render: h => h(App)
});
