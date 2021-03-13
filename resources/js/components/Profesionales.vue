<template>
  <div class="container-fluid">
    <!-- Banner Info -->
    <div id="banner-info" class="row">
      <div class="col-lg-4 col-md-8 col-12 rounded banner-info mt-3 mx-auto">
        <!-- Boton cerrar Banner -->
        <div class="text-right">
          <i class="fas fa-times" @click="hideBannerInfo"></i>
        </div>
        <!-- Texto Banner -->
        <div class="text-center">
          <h3>Benvingut a comunitat!</h3>
          <p>
            Aquí trobaràs persones amb tota mena de serveis per a tu i les teves
            mascotes!
          </p>
        </div>
      </div>
    </div>
    <!-- Titulo Pagina -->
    <div class="row">
      <div class="col-12 text-center mt-3">
        <h1 class="h1-peludets lila-peludets">
          {{ $t("profesionales.tituloProfesionales") }}
        </h1>
      </div>
    </div>
    <!-- Selects  -->
    <div class="row">
      <div class="col-lg-2 col-md-4 col-12 ml-auto">
        <div class="form-group m-2">
          <label for="exampleFormControlSelect1">
            {{ $t("profesionales.FormControlSelect1") }}
           </label>
          <select
            name="selectOption"
            v-model="servicio"
            class="form-control"
            id="selectOption"
          >
            <option selected="true" disabled="disabled">
              {{ $t("home.formSelectDefecto") }}
            </option>
            <option v-for="profesion in profesiones" :key="profesion.id">
              {{ profesion.nombre_profesion }}
            </option>
          </select>
        </div>
      </div>
      <div class="col-lg-2 col-md-4 col-12">
        <div class="form-group m-2">
          <label for="exampleFormControlSelect1">{{
            $t("profesionales.FormControlSelectDispo")
          }}</label>
          <select
            name="selectOption2"
            v-model="disponibilidad"
            class="form-control"
            id="exampleFormControlSelect2"
          >
            <option value="Presencial">
              {{ $t("profesionales.selectOptionPresencial") }}
            </option>
            <option value="Online">
              {{ $t("profesionales.selectOptionOnline") }}
            </option>
            <option value="Presencial y Online">
              {{ $t("profesionales.selectOptionPreOn") }}
            </option>
          </select>
        </div>
      </div>
      <div class="col-lg-2 col-md-4 col-12 mr-auto">
        <div class="form-group m-2">
          <label for="exampleFormControlSelect1">{{
            $t("profesionales.FormControlSelectTitulacion")
          }}</label>
          <select
            name="selectOption3"
            v-model="titulacion"
            class="form-control"
            id="exampleFormControlSelect1"
          >
            <option value="S">{{ $t("profesionales.valueSi") }}</option>
            <option value="N">{{ $t("profesionales.valueNo") }}</option>
          </select>
        </div>
      </div>
    </div>
    <!-- Botones -->
    <div class="row">
      <div class="col-lg-2 col-md-4 col-12 ml-auto mt-4">
        <button
          id="usuariosFiltrados"
          type="submit"
          class="btn btn-block btn-lg btn-lila-peludets"
          @click="usuariosFiltrados"
        >
          {{ $t("profesionales.buscarProfesionales") }}
        </button>
      </div>
      <div class="col-lg-2 col-md-4 col-12 mr-auto mt-4">
        <button
          type="button"
          class="btn btn-lila-peludets"
          @click="geoFindMe"
        >
          {{ $t("profesionales.cercaTi") }}
        </button>
        <div id="out" class="col-md-12 mt-3"></div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-6 col-xs-12" id="flotante">
        <mapa-prof></mapa-prof>
      </div>
      <!-- Tarjetas de profesionales -->
      <div id="cards" v-if="ensena" class="col-md-6 mt-4 col-xs-12">
        <div
          name="profesionales"
          class="col-md-4"
          v-for="usuario in usuarios"
          :key="usuario"
        >
          <div class="card" style="width: 18rem">
            <img class="card-img-top" v-bind:src="usuario.photo" />
            <div class="card-body">
              <p class="card_name card_attr">{{ usuario.name }}</p>
              <p class="card_surname card_attr">{{ usuario.lastname }}</p>
              <router-link
                v-bind:to="'/profile/' + usuario.id"
                class="btn btn-azul-peludets"
                >{{ $t("profesionales.contratar") }}</router-link
              >
            </div>
          </div>
        </div>
      </div>
      <!-- Tarjetas de profesionales home que vienen de Home -->
      <div id="cards" v-if="showByProf" class="col-md-6 mt-4 col-xs-12">
        <div
          name="profesionales"
          class="col-md-4"
          v-for="usuario in usuarios"
          :key="usuario"
        >
          <div class="card" style="width: 18rem">
            <img class="card-img-top" v-bind:src="usuario.photo" />
            <div class="card-body">
              <p class="card_name card_attr">{{ usuario.name }}</p>
              <p class="card_surname card_attr">{{ usuario.lastname }}</p>
              <router-link
                v-bind:to="'/profile/' + usuario.id"
                class="btn btn-azul-peludets"
                >{{ $t("profesionales.contratar") }}</router-link
              >
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Seccion de Lugares Favoritors (recuadros) -->
    <!-- Cartas trabajos -->

    <!---TEMPLATE DE LAS CARTAS DE PROFESIONALES-->
  </div>
</template>



<script>
import Api from '../Api';
export default {
  data() {
    return {
      ensena: false,
      profesiones: {},
      profesionHome: {},
      usuarios: {},
      showByProf: false,
    };
  },
  methods: {
    usuariosFiltrados() {
      let objeto = {
        profesion: this.servicio,
        disponibilidad: this.disponibilidad,
        titulacion: this.titulacion,
      };
      console.log(objeto);
      this.Api().post("/usuario/searchByProf", objeto).then((response) => {
        this.usuarios = response.data;
        this.ensena = true;
        console.log(response.data);
      });
    },

    geoFindMe() {
      var output = document.getElementById("out");

      if (!navigator.geolocation) {
        output.innerHTML =
          "<p>Geolocation is not supported by your browser</p>";
        return;
      }

      function success(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        output.innerHTML =
          "<p>Latitude is " +
          latitude +
          "° <br>Longitude is " +
          longitude +
          "°</p>";

        var img = new Image();
        img.src =
          "http://maps.googleapis.com/maps/api/staticmap?center=" +
          latitude +
          "," +
          longitude +
          "&zoom=13&size=300x300&sensor=false";

        output.appendChild(img);
      }

      function error() {
        output.innerHTML = "Unable to retrieve your location";
      }

      output.innerHTML = "<p>Locating…</p>";

      navigator.geolocation.getCurrentPosition((success, error));
    },
    // Metodo que SOLO filtra por profesion, para la peticion que viene de HOME
    userProfOnly() {
      this.Api()
        .post("/usuario/userByProfOnly", this.profesionHome)
        .then((response) => {
          this.usuarios = response.data;
          console.log(this.usuarios);
          this.showByProf = true;
        });
    },
    hideBannerInfo() {
      document.getElementById("banner-info").style.display = "none";
    },
  },
  mounted() {
    if (this.$route.params.prof != undefined) {
      this.profesionHome.nombre = this.$route.params.prof;
      this.userProfOnly();
    }
  },
  created() {
    this.Api().get("/profesiones/getAll").then((response) => {
      this.profesiones = response.data;
    });
  },
};
</script>
