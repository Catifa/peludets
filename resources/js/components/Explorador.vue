<style>
@import "../../css/explorador.css";
</style>
<template>
  <div class="row">
    <div class="col-md-6 mt-3 mx-auto">
      <div id="gifCargar" v-if="!cargarCoord">
        <img
          class="rounded-circle"
          src="https://media.tenor.com/images/bf12191c6d2e5416d13860b5a137dbb8/tenor.gif"
        />
        <h3>{{ $t("explorador.tituloExplorador") }}</h3>
      </div>
      <mapa-exp :props="sitioMapa" :geoLoc="geoLoc"></mapa-exp>
    </div>
    <div class="col-md-6 mt-3 mx-auto">
      <div class="row">
        <button class="btn btn-azul-peludets mr-2" type="button">{{ $t("explorador.buttonSitios") }}</button>
        <button class="btn btn-azul-peludets" type="button">{{ $t("explorador.buttonTrabajos") }}</button>
      </div>
      <div class="row mt-3">
        <div class="card bg-crema-peludets" v-for="sitio in sitiosInteres" :key="sitio.nombre">
          <img class="card-img-top" alt="Imagen" />
          <div class="card-body">
            <h5 class="card-title">{{ sitio.nombre }}</h5>
            <p class="card-text">{{ sitio.descripcion }}</p>
            <button
              class="btn btn-azul-peludets"
              type="button"
              @click="enviarMapa(sitio)"
            >{{ $t("explorador.buttonMostrarMapa")}}</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import utils from "../metodos";
import Swal from "sweetalert2";

export default {
  data() {
    return {
      sitiosInteres: [
        {
          nombre: "Parc de Can grocs",
          descripcion: "Parque guapisimo para ir con el perro",
          latLng: L.latLng(41.51076, 2.11969),
          center: [41.51076, 2.11969]
        },
        {
          nombre: "Parc Valles Central",
          descripcion: "Parque verificado por Aitor",
          latLng: L.latLng(41.52103, 2.1121),
          center: [41.52103, 2.1121]
        },
        {
          nombre: "Aiguestortes",
          descripcion: "Esta lejos, pero mola",
          latLng: L.latLng(42.5719, 0.9425),
          center: [42.5719, 0.9425]
        }
      ],
      sitioMapa: {},
      geoLoc: [],
      cargarCoord: true
    };
  },
  methods: {
    enviarMapa(obj) {
      this.sitioMapa = obj;
    },
    // Metodo para calcular la distancia entre los sitios de interes y el usuario
    calcDistancia() {
      // Primer parametro del objeto es latitud, el segundo longitud.
      let posicionActual = this.geoLoc;
      let arrayAux = [];
      this.sitiosInteres.forEach(sitio => {
        arrayAux.push(this.haversine(sitio, posicionActual));
      });
      console.log(arrayAux);
    },
    haversine(sitio, posicionActual) {
      Number.prototype.toRad = function() {
        return (this * Math.PI) / 180;
      };

      var lat2 = sitio.latLng.lat;
      var lon2 = sitio.latLng.lang;
      var lat1 = posicionActual[0];
      var lon1 = posicionActual[1];

      var R = 6371; // km
      //has a problem with the .toRad() method below.
      var x1 = lat2 - lat1;
      var dLat = x1.toRad();
      var x2 = lon2 - lon1;
      var dLon = x2.toRad();
      var a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(lat1.toRad()) *
          Math.cos(lat2.toRad()) *
          Math.sin(dLon / 2) *
          Math.sin(dLon / 2);
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
      var d = R * c;

      return d;
    }
  },
  mounted: function() {
    if (!navigator.geolocation) {
      Swal.fire({
        icon: "error",
        title:
          "Tu navegador no soporta la geolocalizacion, pero intentaremos obtener una localizacion cercana."
      });
      this.cargarCoord = false;
      this.geoLoc = {
        latLng: [41.50546, 2.11775]
      };
      this.calcDistancia();
    } else {
      this.cargarCoord = false;
      navigator.geolocation
        .getCurrentPosition(position => {
          this.cargarCoord = true;
          this.geoLoc = [position.coords.latitude, position.coords.longitude];
          this.calcDistancia();
        })
        .fail(() => {
          this.cargarCoord = true;
          this.geoLoc = [41.50546, 2.11775];
          this.calcDistancia();
        });
    }
  }
};
</script>


