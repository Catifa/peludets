<style>
@import "../../css/canvas.css";
</style>

<template>
  <div class="container-fluid mt-5">
    <div class="col-md-12 col-xs-12 mt-5">
      <canvas id="canvas"></canvas>
    </div>
    <div class="col-md-12 col-xs-12 mt-5">
      <div class="row justify-content-center">
        <h4>Afegeix fotos dels passejos amb les mascotes dels teus clients</h4>
        <a
          name=""
          id=""
          class="btn btn-lila-peludets ml-5"
          href="#"
          role="button"
          @click="mostrarModal()"
          >+</a
        >
      </div>
    </div>
    <div class="col-md-12 col-xs-12 mt-5">
      <div class="row mt-2">
        <a
          name=""
          id=""
          class="btn btn-lila-peludets"
          href="#"
          role="button"
          @click="mostrarMapa()"
          >Mostar Mapa</a
        >
        <button class="btn btn-lila-peludets ml-5" @click="clickBtn()">
          Rectangle
        </button>
        <button class="btn btn-lila-peludets ml-5" @click="clickBtn2()">
          Cercle
        </button>
        <button class="btn btn-lila-peludets ml-5" @click="clickBtn3()">
          Linea
        </button>
      </div>
      <l-map
        id="mapa"
        :zoom="zoom"
        :center="center"
        style="height: 500px; width: 100%"
        class="mt-2"
      >
        <l-tile-layer :url="url" :attribution="attribution" />
        <l-circle
          :lat-lng="circle.center"
          :radius="circle.radius"
          :l-style="circle.style"
        />
        <l-rectangle :bounds="rectangle.bounds" :l-style="rectangle.style" />
        <l-polygon :lat-lngs="polygon.latlngs" :color="polygon.color" />
        <l-polyline :lat-lngs="polyline.latlngs" :l-style="polyline.style" />
      </l-map>
    </div>
    <div class="col-md-12 col-xs-12 mt-5">
      <div class="row">
        <h5>Aquí pots veure el passeig de les teves mascotes</h5>
      </div>
      <div class="row">
        <div
          class="col-md-4 col-xs-12 mt-5"
          v-for="mascota in arrayMascotas"
          :key="mascota.id"
        >
          <img
            style="max-width: 286px; max-height: 180px"
            v-bind:src="mascota.photo_paseo"
          />
        </div>
      </div>
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
            <button
              type="button"
              class="btn btn-lila-peludets"
              @click="updateFotoPaseo()"
            >
              Enviar
            </button>
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
import Api from "../Api";
import Swal from "sweetalert2";

import {
  LMap,
  LTileLayer,
  LCircle,
  LRectangle,
  LPolygon,
  LPolyline,
  LPopup,
  LTooltip,
} from "vue2-leaflet";

import { latLng } from "leaflet";

export default {
  name: "PopupGeometryTest",
  components: {
    LMap,
    LTileLayer,
    LCircle,
    LRectangle,
    LPolygon,
    LPolyline,
    LPopup,
    LTooltip,
  },
  props: {
    propHideModal: { type: Function },
    propMascotas: { type: Array },
    propEspecies: { type: Array },
    propRecuperarMascotas: { type: Function },
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
      img: {},
      zoom: 11,
      center: [41.50546, 2.11775],

      circle: {
        center: latLng(41.50546, 2.11775),
        radius: 4500,
        style: { color: "red", weight: 5 },
      },
      rectangle: {
        bounds: [
          [41.50546, 2.11775],
          [41.60546, 2.31775],
        ],
        style: { color: "red", weight: 5 },
      },
      polygon: {
        latlngs: [
          [41.5263299, 2.1222],
          [41.51024000000001, 2.1270065],
          [41.5969447, 2.1136169],
          [41.58527929999999, 2.1143036],
          [41.5794457, 2.1098404],
          [41.5775788, 2.1985107],
          [41.5676598, 2.1753365],
          [41.5593731, 2.1521622],
          [41.5593731, 2.1319061],
          [41.5722111, 2.1143967],
          [41.5960115, 2.1841843],
          [41.5095404, 2.1848709],
          [41.5291277, 2.1683914],
          [41.5533687, 2.1116501],
          [41.5577961, 2.1531921],
          [41.56828069, 2.1621185],
          [41.5657179, 2.189241],
          [41.5589612, 2.1204834],
          [41.537287, 2.1266632],
          [41.5263299, 2.1222],
        ],
        color: "#ff00ff",
      },
      polyline: {
        latlngs: [
          [41.534852, 2.509485],
          [41.542596, 2.328731],
          [41.541487, 2.190568],
          [41.534787, 2.358337],
        ],
        style: { color: "rgb(0,0,0,0)" },
      },
      url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      attribution:
        '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
    };
  },
  methods: {
    clickBtn() {
      this.rectangle.style.weight++;
      this.rectangle.style.color =
        this.rectangle.style.weight % 2 === 0 ? "blue" : "green";
    },
    clickBtn2() {
      this.circle.style.weight++;
      this.circle.style.color =
        this.circle.style.weight % 2 === 0 ? "rgb(0,0,0,0)" : "green";
    },
    clickBtn3() {
      this.polyline.style.color = "green";
    },
    recuperarMascota() {
      Api()
        .post("/mascota/recuperarMascota")
        .then((response) => {
          this.arrayMascotas = response.data;
        });
    },
    mostrarMapa() {
      var x = document.getElementById("mapa");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    },

    updateFotoPaseo() {
      this.arrayMascotas.userId = this.$root.user.id;
      this.arrayMascotas.photo_paseo = this.img;
      Api()
        .post("/mascota/updateFotoPaseo", { img: this.img })
        .then(() => {
          Swal.fire("Foto afegida", "", "success");
          $("#modal").modal("hide");
          this.recuperarMascota();
        })
        .catch((error) => console.log(error));
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
    registerMascota() {
      this.mascota.userId = this.$root.user.id;
      this.mascota.photo = this.img;
      Api()
        .post("/mascota/registerMascota", this.mascota)
        .then(() => {
          this.propRecuperarMascotas();
          this.propHideModal();
          Swal.fire("Registro completado", "", "success");
        })
        .catch((error) => console.log(error));
    },
  },

  store() {
    //console.log(this.img);
    Api()
      .post("/files/setProfilePhoto", { img: this.img })
      .then((res) => {
        this.getPhoto();
      });
  },
  getPhoto() {
    Api()
      .post("/files/getProfilePhoto")
      .then((res) => {
        this.$root.photo = res.data[0].photo;
      });
  },
  mounted() {
    this.getGeoloc();
    this.recuperarMascota();

    const ALTURA_CANVAS = 200,
      ANCHURA_CANVAS = 400;

    // Obtener el elemento del DOM
    const canvas = document.querySelector("#canvas");
    canvas.width = ANCHURA_CANVAS;
    canvas.height = ALTURA_CANVAS;
    // Del canvas, obtener el contexto para poder dibujar
    const contexto = canvas.getContext("2d");
    // Comenzar
    contexto.beginPath();
    // Grosor de línea
    contexto.lineWidth = 3;
    // Color de línea
    contexto.strokeStyle = "blue";
    // Comenzamos en 0, 0
    contexto.moveTo(0, 0);
    // Hacemos una línea hasta 48, 48
    contexto.lineTo(48, 48);
    contexto.stroke(); // "Guardar" cambios

    setTimeout(() => {
      // Otra línea
      contexto.beginPath();
      contexto.strokeStyle = "yellow";
      contexto.moveTo(0, 100);
      contexto.lineTo(48, 52);
      contexto.stroke();
    }, 10000);

    setTimeout(() => {
          // Otra línea
    contexto.beginPath();
    contexto.strokeStyle = "green";
    contexto.moveTo(100, 100);
    contexto.lineTo(52, 52);
    contexto.stroke();
    }, 20000);


  },
};
</script>


