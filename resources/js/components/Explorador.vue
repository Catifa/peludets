<style>
@import "../../css/explorador.css";
</style>
<template>
  <div class="row">
    <div class="row container-fluid mx-auto mt-2" id="banner-info">
      <div class="mx-auto banner-info">
        <div align="right" class="mr-3 mt-1">
          <i class="fas fa-times" @click="hideBannerInfo"></i>
        </div>
        <div align="center" class="ml-4 mr-4 mb-4">
          Benvingut a l'explorador. <br />
          Aquí podràs trobar llocs d'interès com botigues, parcs, veterinaris i
          molt mes! <br />
          A més si ets un dels nostres afiliats podràs
          trobar treballs a la teva zona aquí!
        </div>
      </div>
    </div>
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
        <button
          class="btn btn-azul-peludets mr-2"
          type="button"
          @click="listarSitiosInteres(geoLoc)"
        >
          {{ $t("explorador.buttonSitios") }}
        </button>
        <button
          class="btn btn-azul-peludets"
          type="button"
          @click="listarOfertas(geoLoc)"
        >
          {{ $t("explorador.buttonTrabajos") }}
        </button>
      </div>
      <div class="row mt-3" id="cards">
        <div
          class="card card-explorador mb-3"
          style="max-width: 320px"
          v-for="obj in tarjetas"
          :key="obj.nombre"
        >
          <div class="row no-gutters">
            <div class="col-md-4">
              <img v-bind:src="obj.photo" class="card-img" />
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">{{ obj.nombre }}</h5>
                <p class="card-text">{{ obj.descripcion }}</p>
                <button
                  class="btn btn-azul-peludets"
                  type="button"
                  @click="enviarMapa(sitio)"
                >
                  {{ $t("explorador.buttonMostrarMapa") }}
                </button>
                <button v-if="obj.idUser != undefined">
                  {{ obj.idUser }}
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import MapaExplorador from './components-subparts/Explorador_mapa.vue';
import { utils } from "../utils";
import Swal from "sweetalert2";

export default {
  components: {
    'mapa-exp': MapaExplorador
  },
  data() {
    return {
      tarjetas: [],
      sitioMapa: {},
      geoLoc: [],
      cargarCoord: true,
    };
  },
  methods: {
    enviarMapa(obj) {
      this.sitioMapa = obj;
    },
    listarSitiosInteres(geoloc) {
      $("#cards").html("");
      //geoloc es la posicion del usuario en el mapa
      var arrSitios = [];
      axios.post("/api/explorador/getSitiosInteres").then((res) => {
        //console.log(res.data);
        res.data.forEach((element) => {
          let dist = utils.calcDistancia(element, geoloc);
          let obj = {
            sitioObject: element,
            distancia: dist,
          };
          arrSitios.push(obj);
        });
        arrSitios.sort((a, b) => (a.distancia > b.distancia ? 1 : -1));

        arrSitios.forEach((element) => {
          let obj = {
            nombre: element.sitioObject.nombre,
            descripcion: element.sitioObject.descripcion,
            photo: element.sitioObject.photo,
            latLng: L.latLng(element.sitioObject.lat, element.sitioObject.lon),
          };
          this.tarjetas.push(obj);
        });
        //console.log(arrSitios);
      });
    },
    listarOfertas(geoloc) {
      $("#cards").html("");
      //geoloc es la posicion del usuario en el mapa
      var arrOfertas = [];
      axios.post("/api/explorador/getOfertas").then((res) => {
        //console.log(res.data);
        res.data.forEach((element) => {
          let dist = utils.calcDistancia(element, geoloc);
          let obj = {
            ofertaObject: element,
            distancia: dist,
          };
          arrOfertas.push(obj);
        });
        arrOfertas.sort((a, b) => (a.distancia > b.distancia ? 1 : -1));

        arrOfertas.forEach((element) => {
          let obj = {
            idUser: element.ofertaObject.idUser,
            nombre: element.ofertaObject.nombre,
            descripcion: element.ofertaObject.descripcion,
            photo: element.ofertaObject.photo,
            latLng: L.latLng(
              element.ofertaObject.lat,
              element.ofertaObject.lon
            ),
          };
          this.tarjetas.push(obj);
        });
        //console.log(arrOfertas);
      });
    },
    hideBannerInfo(){
      document.getElementById('banner-info').style.display = 'none';
    }
  },
  mounted() {
    if (!navigator.geolocation) {
      Swal.fire({
        icon: "error",
        title:
          "Tu navegador no soporta la geolocalizacion, pero intentaremos obtener una localizacion cercana.",
      });
      this.cargarCoord = false;
      this.geoLoc = {
        latLng: [41.50546, 2.11775],
      };
    } else {
      this.cargarCoord = false;
      navigator.geolocation
        .getCurrentPosition((position) => {
          this.cargarCoord = true;
          this.geoLoc = [position.coords.latitude, position.coords.longitude];
        })
        .fail(() => {
          this.cargarCoord = true;
          this.geoLoc = [41.50546, 2.11775];
        });
    }
  },
};
</script>