<template>
  <div class="container-fluid">
    <!-- Banner Info -->
    <div id="banner-info" class="row" v-if="banner() == false">
      <div class="col-lg-4 col-md-8 col-12 rounded banner-info mt-3 mx-auto">
        <!-- Boton cerrar Banner -->
        <div class="text-right">
          <i class="fas fa-times" @click="hideBannerInfo"></i>
        </div>
        <!-- Texto Banner -->
        <div class="text-center">
          <h3>{{ $t("comunidad.bannerInfoBienvenida") }}</h3>
          <p>
            {{ $t("comunidad.bannerInfoTexto1") }}
          </p>
        </div>
      </div>
    </div>
    <!-- Titulo Pagina -->
    <div class="row">
      <div class="col-12 text-center mt-3">
        <h1 class="h1-peludets lila-peludets">
          {{ $t("comunidad.tituloComunidad") }}
        </h1>
      </div>
    </div>
    <!-- Selects  -->
    <div class="row">
      <!-- Servicios -->
      <div class="col-lg-2 col-md-4 col-12 ml-auto">
        <div class="form-group m-2">
          <label>
            {{ $t("comunidad.FormControlSelect1") }}
          </label>
          <select
            v-model="servicioBusqueda.servicio"
            class="form-control"
            @change="serviciosChange"
          >
            <option v-for="servicio in serviciosDisponibles" :key="servicio.id">
              {{ servicio.nombre_profesion }}
            </option>
          </select>
        </div>
      </div>
      <!-- Disponibilidad -->
      <div class="col-lg-2 col-md-4 col-12" v-if="disponibilidad == true">
        <div class="form-group m-2">
          <label>
            {{ $t("comunidad.FormControlSelectDispo") }}
          </label>
          <select
            v-model="servicioBusqueda.disponibilidad"
            class="form-control"
          >
            <option value="P">
                {{
                  $t(
                    "perfil.perfilEditable.modalNuevaProfesion.presencialModal"
                  )
                }}
              </option>
              <option value="O">
                {{
                  $t("perfil.perfilEditable.modalNuevaProfesion.onlineModal")
                }}
              </option>
              <option value="PO">
                {{
                  $t(
                    "perfil.perfilEditable.modalNuevaProfesion.presencialOnlineModal"
                  )
                }}
              </option>
          </select>
        </div>
      </div>
      <!-- Titulacion -->
      <div class="col-lg-2 col-md-4 col-12 mr-auto">
        <div class="form-group m-2">
          <label>
            {{ $t("comunidad.FormControlSelectTitulacion") }}
          </label>
          <select v-model="servicioBusqueda.titulacion" class="form-control">
            <option value="S">{{ $t("comunidad.valueSi") }}</option>
            <option value="N">{{ $t("comunidad.valueNo") }}</option>
          </select>
        </div>
      </div>
    </div>
    <!-- Botones -->
    <div class="row">
      <!-- Boton Buscar -->
      <div class="col-lg-2 col-md-2 col-4 mt-4 ml-auto text-right">
        <button class="btn btn-lila-peludets" @click="usuariosFiltrados">
          {{ $t("comunidad.buscarProfesionales") }}
        </button>
      </div>
      <!-- Boton Geolocalizacion -->
      <div class="col-lg-2 col-md-2 col-5 mt-4 mr-auto">
        <button class="btn btn-lila-peludets" @click="getGeoloc">
          {{ $t("comunidad.cercaTi") }}
        </button>
      </div>
    </div>
    <!-- Tarjetas comunidad -->
    <div class="row" v-if="showProf">
      <div class="col-lg-8 col-12 mx-auto">
        <div class="row">
          <div
            class="col-lg-6 col-md-6 col-12 mt-4"
            v-for="usuario in usuarios"
            :key="usuario.id"
          >
            <div class="card mb-3" style="max-width: 540px">
              <div class="row no-gutters">
                <!-- Imagen Tarjeta -->
                <div class="col-md-4">
                  <img
                    :src="usuario.photo"
                    class="card-img"
                    alt="Foto Usuario"
                  />
                </div>
                <!-- Texto Tarjeta -->
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">
                      {{ usuario.name }} {{ usuario.lastname }}
                    </h5>
                    <p class="card-text">
                      {{ usuario.textoPerfil }}
                    </p>
                    <p class="card-text">
                      <small class="text-muted">
                        <router-link
                          v-bind:to="'/profile/' + usuario.id"
                          class="btn btn-azul-peludets"
                        >
                          {{ $t("comunidad.contratar") }}
                        </router-link>
                      </small>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Mapa servicios -->
    <div class="row" v-if="showProf">
      <div class="col-lg-12">
        <mapa :propGeoloc="currentGeoLoc"></mapa>
      </div>
    </div>
  </div>
</template>

<script>
import Mapa from "./components-subparts/Comunidad_mapa.vue";
import Api from "../Api";

export default {
  components: {
    mapa: Mapa,
  },
  data() {
    return {
      showTarjetas: false,
      // Variable donde se guardara el objeto de la profesion que se quiere buscar
      servicioBusqueda: {},
      // Variable con los servicios de BDD
      serviciosDisponibles: undefined,
      // Usuarios recuperados de la consulta de busqueda
      usuarios: undefined,
      // Variable para mostrar las tarjetas
      showProf: false,
      currentGeoLoc: undefined,
      disponibilidad: true,
    };
  },
  methods: {
    usuariosFiltrados() {
      console.log(this.servicioBusqueda);
      Api()
        .post("/usuario/searchByProf", this.servicioBusqueda)
        .then((response) => {
          this.usuarios = response.data;
          this.showProf = true;
        });
    },

    getGeoloc() {
      if (!navigator.geolocation) {
        Swal.fire({
          icon: "error",
          title:
            "Tu navegador no soporta la geolocalizacion, pero intentaremos obtener una localizacion cercana.",
        });
      } else {
        navigator.geolocation.getCurrentPosition((position) => {
          this.currentGeoLoc = [
            position.coords.latitude,
            position.coords.longitude,
          ];
        });
      }
    },
    // Metodo que SOLO filtra por profesion, para la peticion que viene de HOME
    userProfOnly() {
      Api()
        .post("/usuario/userByProfOnly", this.servicioBusqueda)
        .then((response) => {
          this.usuarios = response.data;
          this.showProf = true;
        });
    },
    hideBannerInfo() {
      document.getElementById("banner-info").style.display = "none";
      localStorage.setItem("BannerComunidad", true);
    },
    banner() {
      if (localStorage.getItem("BannerComunidad") == "true") return true;
      return false;
    },
    serviciosChange() {
      Api()
        .post("/profesiones/getDisponibilidad", {
          profesion: this.servicioBusqueda.servicio,
        })
        .then((res) => {
          this.disponibilidad = res.data;
          if (res.data === false) this.servicioBusqueda.disponibilidad = "P";
        });
    },
  },
  mounted() {
    if (this.$route.params.prof != undefined) {
      this.servicioBusqueda.nombre = this.$route.params.prof;
      this.userProfOnly();
    }
  },
  created() {
    Api()
      .get("/profesiones/getAll")
      .then((response) => {
        this.serviciosDisponibles = response.data;
      });
  },
};
</script>
