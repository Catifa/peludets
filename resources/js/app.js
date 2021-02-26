require('./bootstrap');
window.Vue = require('vue');

import App from './App.vue';
import Form_Registro from './components/Form_Registro.vue';
import Form_Inicio_Sesion from './components/Form_Inicio_Sesion.vue';
import MapaExplorador from './components/components-subparts/Explorador_mapa.vue';
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


// Mapa Explorador
Vue.component('mapa-exp', MapaExplorador);

// Forms Usuario
Vue.component('form_registro', Form_Registro);
Vue.component('form_inicio_sesion', Form_Inicio_Sesion);
  
const router = new VueRouter({
    mode: 'history',
    routes: routes
});

Vue.config.devtools = true;

const app = new Vue({
    data:{
      user: {},
      photo:'sources/img/avatar.jfif',
    },
    el: '#app',
    router: router,
    i18n,
    render: h => h(App)
});
