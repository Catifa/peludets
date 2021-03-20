<style>
@import "../../css/explorador.css";
</style>
<template>
  <div class="container-fluid">
    <!-- Banner Info -->
    <div id="banner-info" class="row" v-if="banner() == false">
      <div class="col-lg-6 col-9 rounded banner-info mt-3 mx-auto">
        <!-- Boton cerrar Banner -->
        <div class="text-right">
          <i class="fas fa-times" @click="hideBannerInfo"></i>
        </div>
        <!-- Texto Banner -->
        <div class="text-center">
          <h3>{{ $t("explorador.bannerInfoBienvenida") }}</h3>
          <p>
            {{ $t("explorador.bannerInfoTexto1") }}
          </p>
          <p>
            {{ $t("explorador.bannerInfoTexto2") }}
          </p>
        </div>
      </div>
    </div>
    <!-- Geoloc y Mapa -->
    <div class="row">
      <div class="col-lg-6 col-10 mx-auto mt-3">
        <!-- Gif Geoloc -->
        <div
          id="gifCargar"
          class="text-center p-5 rounded"
          v-if="!localizacionObtenida"
        >
          <img
            class="rounded-circle"
            src="https://media.tenor.com/images/bf12191c6d2e5416d13860b5a137dbb8/tenor.gif"
            alt="Espera carga posicion"
          />
          <h3>{{ $t("explorador.tituloExplorador") }}</h3>
        </div>
        <!-- Mapa -->
        <mapa-exp
          :propLocalizaciones="sitioMapa"
          :propCurrentGeoLoc="currentGeoLoc"
        ></mapa-exp>
      </div>
      <!-- Sitios Interes / Trabajos Disponibles -->
      <div class="col-lg-6 col-11 mx-auto mt-5">
        <!-- Botones Sitios Interes / Trabajos Disponibles -->
        <div class="row">
          <!-- Sitios Interes -->
          <div class="col-lg-6 col-6 text-right">
            <button class="btn btn-azul-peludets mr-2" @click="mostrarSitios">
              {{ $t("explorador.buttonSitios") }}
            </button>
          </div>
          <!-- Trabajos Disponibles -->
          <div class="col-lg-6 col-6">
            <button class="btn btn-azul-peludets" @click="mostrarTrabajos">
              {{ $t("explorador.buttonTrabajos") }}
            </button>
          </div>
        </div>
        <!-- Tarjetas Sitios Interes / Trabajos Disponibles -->
        <div id="cards-explorer" class="row mt-1" v-if="mostrarSitiosInteres">
          <div
            class="col-lg-4 col-sm-6 col-12 card-explorador mb-2"
            v-for="localizacion in sitiosInteres"
            :key="localizacion.id"
          >
            <div class="card">
              <img
                class="card-img-top"
                src="../../img/tarjetas_home/adiestramiento.jpg"
                width="100%"
                alt="Gato"
              />
              <div class="card-body bg-crema-peludets-suave">
                <h5 class="card-title">{{ localizacion.nombre }}</h5>
                <p class="card-text">{{ localizacion.descripcion }}</p>
                <button
                  class="btn btn-azul-peludets"
                  type="button"
                  @click="
                    enviarMapa(
                      localizacion.lat,
                      localizacion.lon,
                      localizacion.nombre
                    )
                  "
                >
                  {{ $t("explorador.buttonMostrarMapa") }}
                </button>
              </div>
            </div>
          </div>
        </div>
        <div
          id="cards-explorer"
          class="row mt-1"
          v-if="mostrarTrabajosDisponibles"
        >
          <div
            class="col-lg-4 col-sm-6 col-12 card-explorador mb-2"
            v-for="localizacion in trabajosDisponibles"
            :key="localizacion.id"
          >
            <div class="card">
              <img
                class="card-img-top"
                src="../../img/tarjetas_home/adiestramiento.jpg"
                width="100%"
                alt="Gato"
              />
              <div class="card-body bg-crema-peludets-suave">
                <h5 class="card-title">{{ localizacion.nombre }}</h5>
                <p class="card-text">{{ localizacion.descripcion }}</p>
                <button
                  class="btn btn-azul-peludets"
                  type="button"
                  @click="
                    enviarMapa(
                      localizacion.lat,
                      localizacion.lon,
                      localizacion.nombre
                    )
                  "
                >
                  {{ $t("explorador.buttonMostrarMapa") }}
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
import MapaExplorador from "./components-subparts/Explorador_mapa.vue";
import { latLng } from "leaflet";
import { utils } from "../utils";
import Swal from "sweetalert2";
import Api from "../Api";

export default {
  components: {
    "mapa-exp": MapaExplorador,
  },
  data() {
    return {
      // Array donde se guardaran todos los sitios de interes
      sitiosInteres: undefined,
      // Array donde se guardaran todos los trabajos de interes
      trabajosDisponibles: undefined,
      // Geolocalizacion obtenida por el navegador
      currentGeoLoc: undefined,
      // Variable para controlar si se ha obtenido la localizacion (Gif gato esperando)
      localizacionObtenida: false,
      mostrarSitiosInteres: true,
      mostrarTrabajosDisponibles: false,
      // Variable que se envia a el prop de mapa
      sitioMapa: undefined,
    };
  },
  methods: {
    // Enviar objeto de la tarjeta al mapa
    enviarMapa(lat, lon, nombre) {
      this.sitioMapa = latLng(lat, lon);
      this.sitioMapa.nombre = nombre;
    },

    // Obtener un Array de todos los datos de la BDD
    obtenerDatosMapa() {
      Api()
        .post("/explorador/getSitiosInteres")
        .then((response) => {
          this.sitiosInteres = response.data;
        });
      Api()
        .post("/explorador/getOfertas")
        .then((response) => {
          this.trabajosDisponibles = response.data;
        });
    },

    // Obtener geolocalizacion
    getGeoloc() {
      if (!navigator.geolocation) {
        Swal.fire({
          icon: "error",
          title:
            "Tu navegador no soporta la geolocalizacion, pero intentaremos obtener una localizacion cercana.",
        });
        this.localizacionObtenida = false;
        this.currentGeoLoc = {
          latLng: [41.50546, 2.11775],
        };
      } else {
        this.localizacionObtenida = false;
        navigator.geolocation.getCurrentPosition((position) => {
          this.localizacionObtenida = true;
          this.currentGeoLoc = [
            position.coords.latitude,
            position.coords.longitude,
          ];
        });
      }
    },

    listarSitiosInteres(geoloc) {
      $("#cards").html("");
      //geoloc es la posicion del usuario en el mapa
      var arrSitios = [];
      Api()
        .post("/explorador/getSitiosInteres")
        .then((res) => {
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
              latLng: L.latLng(
                element.sitioObject.lat,
                element.sitioObject.lon
              ),
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
      Api()
        .post("/explorador/getOfertas")
        .then((res) => {
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

    hideBannerInfo() {
      document.getElementById("banner-info").style.display = "none";
      localStorage.setItem("BannerExplorer", true);
    },

    mostrarSitios() {
      this.mostrarTrabajosDisponibles = false;
      this.mostrarSitiosInteres = true;
    },

    mostrarTrabajos() {
      this.mostrarSitiosInteres = false;
      this.mostrarTrabajosDisponibles = true;
    },
    banner() {
      if (localStorage.getItem("BannerExplorer") == "true") return true;
      return false;
    },
  },
  mounted() {
    this.obtenerDatosMapa();
    this.getGeoloc();
  },
};
</script>