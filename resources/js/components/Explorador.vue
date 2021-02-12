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
        <button class="btn btn-azul-peludets mr-2" type="button">
          {{ $t("explorador.buttonSitios") }}
        </button>
        <button class="btn btn-azul-peludets" type="button">
          {{ $t("explorador.buttonTrabajos") }}
        </button>
      </div>
      <div class="row mt-3">
        <div
          class="card bg-crema-peludets"
          v-for="sitio in sitiosInteres"
          :key="sitio.nombre"
        >
          <img class="card-img-top" alt="Imagen" />
          <div class="card-body">
            <h5 class="card-title">{{ sitio.nombre }}</h5>
            <p class="card-text">{{ sitio.descripcion }}</p>
            <button
              class="btn btn-azul-peludets"
              type="button"
              @click="enviarMapa(sitio)"
            >
              {{ $t("explorador.buttonMostrarMapa") }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { utils } from "../utils";
import Swal from "sweetalert2";

export default {
  data() {
    return {
      sitiosInteres: [],
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
            latLng: L.latLng(element.sitioObject.lat, element.sitioObject.lon),
          };
          this.sitiosInteres.push(obj);
        });
        console.log(arrSitios);
      });
    },
    listarOfertas(geoloc) {
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
          arrSitios.push(obj);
        });
        arrOfertas.sort((a, b) => (a.distancia > b.distancia ? 1 : -1));

        arrOfertas.forEach((element) => {
          let obj = {
            idUser: element.ofertaObject.idUser,
            nombre: element.ofertaObject.nombre,
            descripcion: element.ofertaObject.descripcion,
            latLng: L.latLng(element.ofertaObject.lat, element.ofertaObject.lon),
          };
          this.ofertaObject.push(obj);
        });
        console.log(arrOfertas);
      });
    },
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
          this.listarSitiosInteres(this.geoLoc);
        })
        .fail(() => {
          this.cargarCoord = true;
          this.geoLoc = [41.50546, 2.11775];
          this.listarSitiosInteres(this.geoLoc);
        });
    }
  },
};
</script>