require('./bootstrap');
window.Vue = require('vue');

import App from './App.vue';
import Form_Registro from './components/Form_Registro.vue';
import Form_Inicio_Sesion from './components/Form_Inicio_Sesion.vue';
import MapaExplorador from './components/components-subparts/Explorador_mapa.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
import {LMap, LTileLayer, LMarker} from 'vue2-leaflet';
import 'leaflet/dist/leaflet.css';
import VueGeolocation from 'vue-browser-geolocation';
import Vue from 'vue';
import * as VueGoogleMaps from 'vue2-google-maps';
 

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VueGeolocation);

Vue.use(VueGoogleMaps, {
    load: {
      key: 'YOUR_API_TOKEN',
      libraries: 'places', // This is required if you use the Autocomplete plugin
      // OR: libraries: 'places,drawing'
      // OR: libraries: 'places,drawing,visualization'
      // (as you require)
   
      //// If you want to set the version, you can do so:
      // v: '3.26',
    },
   
    //// If you intend to programmatically custom event listener code
    //// (e.g. `this.$refs.gmap.$on('zoom_changed', someFunc)`)
    //// instead of going through Vue templates (e.g. `<GmapMap @zoom_changed="someFunc">`)
    //// you might need to turn this on.
    // autobindAllEvents: false,
   
    //// If you want to manually install components, e.g.
    //// import {GmapMarker} from 'vue2-google-maps/src/components/marker'
    //// Vue.component('GmapMarker', GmapMarker)
    //// then disable the following:
    // installComponents: true,
  })

// Mapa Explorador
Vue.component('mapa-exp', MapaExplorador);
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

/* router.beforeEach((to, from, next) => {
    if (to.name !== 'Login' && !isAuthenticated) next({ name: 'Login' })
    else next()
  }) */

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App)
});

