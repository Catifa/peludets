<style>
@import "../../css/canvas.css";
</style>

<template>
  <div class="container-fluid mt-5">
    <div class="col-md-12 col-xs-12 mt-5">
      <div class="row justify-content-center">
        <h4>Afegeix fotos dels passejos amb les mascotes dels teus clients</h4>
        <a
          name=""
          id=""
          class="btn btn-lila-peludets ml-5"
          href="#"
          role="button"
          @click="mostrarModal"
          >+</a
        >
      </div>
    </div>
    <div class="col-md-12 col-xs-12 mt-5">
      <mapa
        :propLocalizaciones="sitioMapa"
        :propCurrentGeoLoc="currentGeoLoc"
      ></mapa>
    </div>

    <div
      class="col-md-12 col-xs-12 mt-5 fondo"
      v-for="mascota in arrayMascotas"
      :key="mascota.id"
      
    >
      <h5 class="card-title lila-peludets">
        Els passejos de {{ mascota.nombre }}
      </h5>

      <img
        style="max-width: 286px; max-height: 180px"
        v-bind:src="mascota.photo_paseo"
        class="card-img-top"
      />
    </div>

    <div
      id="modal"
      class="modal"
      tabindex="-1"
      role="dialog"
      ref="modalSolicitud"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!-- Header Modal -->
          <div class="modal-header bg-azul-peludets">
            <h5 class="modal-title lila-peludets">Afegeix fotos</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!-- Cuerpo Modal -->
          <div class="modal-body">
            <div class="mb-3">
              <label for="formFile" class="form-label"
                >Usuari que vols enviar la foto</label
              >
              <input
                type="text"
                class="form-control"
                name=""
                id=""
                aria-describedby="helpId"
                placeholder=""
              />
            </div>
            <!-- Foto -->
            <div class="form-group">
              <label for class="form-label"> Selecciona la foto </label>
              <input
                type="file"
                class="form-control-file"
                @change="imgUpload($event)"
              />
            </div>
          </div>
          <!-- Footer Modal -->
          <div class="modal-footer bg-azul-peludets">
            <button type="button" class="btn btn-lila-peludets">Enviar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              Tancar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import MapaExplorador from "./components-subparts/Explorador_mapa.vue";
import Api from "../Api";

import { latLng } from "leaflet";

export default {
  components: {
    mapa: MapaExplorador,
  },
  data() {
    return {
      // Geolocalizacion obtenida por el navegador
      currentGeoLoc: undefined,
      // Variable para controlar si se ha obtenido la localizacion (Gif gato esperando)
      localizacionObtenida: false,
      mostrarSitiosInteres: true,
      mostrarTrabajosDisponibles: false,
      // Variable que se envia a el prop de mapa
      sitioMapa: undefined,
      // Variable que guarda las mascotas recuperada de la base de datos
      arrayMascotas: [],
    };
  },
  methods: {
    recuperarMascota() {
      Api()
        .post("/mascota/recuperarMascota")
        .then((response) => {
          this.arrayMascotas = response.data;
        });
    },
    imgUpload(e) {
      var formData = new FormData();
      var file = e.target.files[0];
      formData.append("Filedata", file);
      var t = file.type.split("/").pop().toLowerCase();
      if (t != "jpeg" && t != "jpg" && t != "png") {
        alert("Seleccione un formato de imágen válido: (jpeg, jpg, png)");
        document.getElementById("file").value = "";
        return false;
      }
      if (file.size > 1024000) {
        alert("Tamaño de imágen máximo (1MB)");
        document.getElementById("file").value = "";
        return false;
      }

      let f = e.target.files[0];
      let reader = new FileReader();

      reader.onloadend = () => {
        this.img = reader.result;
      };

      reader.readAsDataURL(f);
    },
    mostrarModal() {
      $("#modal").modal("show");
    },

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
    enviarMapa(lat, lon, nombre) {
      this.sitioMapa = latLng(lat, lon);
      this.sitioMapa.nombre = nombre;
    },
  },
  mounted() {
    this.getGeoloc();
    this.recuperarMascota();
  },
};
</script>


