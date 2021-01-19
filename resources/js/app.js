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

/* router.beforeEach((to, from, next) => {
    if (to.name !== 'Login' && !isAuthenticated) next({ name: 'Login' })
    else next()
  }) */

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App)
});


/*************************************
        Geolocalozacion
*************************************/

function geoFindMe() {
  var output = document.getElementById("out");

  if (!navigator.geolocation){
    output.innerHTML = "<p>Geolocation is not supported by your browser</p>";
    return;
  }

  function success(position) {
    var latitude  = position.coords.latitude;
    var longitude = position.coords.longitude;

    output.innerHTML = '<p>Latitude is ' + latitude + '° <br>Longitude is ' + longitude + '°</p>';

    var img = new Image();
    img.src = "http://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=13&size=300x300&sensor=false";

    output.appendChild(img);
  };

  function error() {
    output.innerHTML = "Unable to retrieve your location";
  };

  output.innerHTML = "<p>Locating…</p>";

  navigator.geolocation.getCurrentPosition(success, error);
}
