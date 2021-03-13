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
          <select v-model="servicioBusqueda.servicio" class="form-control">
            <option v-for="servicio in serviciosDisponibles" :key="servicio.id">
              {{ servicio.nombre_profesion }}
            </option>
          </select>
        </div>
      </div>
      <div class="col-lg-2 col-md-4 col-12">
        <div class="form-group m-2">
          <label>
            {{ $t("comunidad.FormControlSelectDispo") }}
          </label>
          <select
            v-model="servicioBusqueda.disponibilidad"
            class="form-control"
          >
            <option>
              {{ $t("comunidad.selectOptionPresencial") }}
            </option>
            <option>
              {{ $t("comunidad.selectOptionOnline") }}
            </option>
            <option>
              {{ $t("comunidad.selectOptionPreOn") }}
            </option>
          </select>
        </div>
      </div>
      <div class="col-lg-2 col-md-4 col-12 mr-auto">
        <div class="form-group m-2">
          <label>
            {{ $t("comunidad.FormControlSelectTitulacion") }}
          </label>
          <select v-model="servicioBusqueda.titulacion" class="form-control">
            <option>{{ $t("comunidad.valueSi") }}</option>
            <option>{{ $t("comunidad.valueNo") }}</option>
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
    <div class="row">
      <div v-if="showTarjetas" class="col-md-6 mt-4 col-xs-12">
        <div
          class="card mb-3"
          style="max-width: 540px"
          v-for="usuario in usuarios"
          :key="usuario.id"
        >
          <div class="row no-gutters">
            <!-- Imagen Tarjeta -->
            <div class="col-md-4">
              <img :src="usuario.photo" class="card-img" alt="Foto Usuario" />
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
</template>

<script>
export default {
  data() {
    return {
      showTarjetas: false,
      // Variable donde se guardara el objeto de la profesion que se quiere buscar
      servicioBusqueda: {},
      // Variable con los servicios de BDD
      serviciosDisponibles: undefined,
      currentGeoLoc: undefined,
      profesionHome: {},
      usuarios: {},
      showByProf: false,
    };
  },
  methods: {
    usuariosFiltrados() {
      this.axios.post("api/usuario/searchByProf", this.servicioBusqueda).then((response) => {
        this.usuarios = response.data;
        this.ensena = true;
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
      this.axios
        .post("api/usuario/userByProfOnly", this.profesionHome)
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
    this.axios.get("api/profesiones/getAll").then((response) => {
      this.serviciosDisponibles = response.data;
    });
  },
};
</script>
