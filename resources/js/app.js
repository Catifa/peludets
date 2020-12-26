require('./bootstrap');
window.Vue = require('vue');

import App from './App.vue';
import Form_Registro from './components/Form_Registro.vue';
import Form_Inicio_Sesion from './components/Form_Inicio_Sesion.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
import {LMap, LTileLayer, LMarker} from 'vue2-leaflet';
import 'leaflet/dist/leaflet.css';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

// Mapa
Vue.component('l-map', LMap);
Vue.component('l-title-layer', LTileLayer);
Vue.component('l-maker', LMarker);

// Forms Usuario
Vue.component('form_registro', Form_Registro);
Vue.component('form_inicio_sesion', Form_Inicio_Sesion);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App)
});
