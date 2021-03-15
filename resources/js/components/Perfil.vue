
<style>
@import "../../css/perfil.css";
</style>

<template>
  <div class="row mt-4">
    <!-- Submenu -->
    <div class="col-lg-9 col-md-7 col-12">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <!-- Submenu Perfil Editable -->
        <li class="nav-item">
          <a
            class="nav-link active"
            id="perfilUsuario-tab"
            data-toggle="tab"
            href="#perfilUsuario"
            role="tab"
            aria-controls="perfilUsuario"
            aria-selected="true"
          >
            {{ $t("perfil.submenuPerfil") }}
          </a>
        </li>
        <!-- Submenu Mascotas -->
        <li class="nav-item">
          <a
            class="nav-link"
            id="mascota-tab"
            data-toggle="tab"
            href="#mascota"
            role="tab"
            aria-controls="mascota"
            aria-selected="false"
          >
            {{ $t("perfil.submenuMascotas") }}
          </a>
        </li>
        <!-- Submenu Valoraciones -->
        <li class="nav-item">
          <a
            class="nav-link"
            id="valoraciones-tab"
            data-toggle="tab"
            href="#valoraciones"
            role="tab"
            aria-controls="valoraciones"
            aria-selected="false"
          >
            {{ $t("perfil.submenuValoraciones") }}
          </a>
        </li>
        <!-- Submenu Tareas -->
        <li class="nav-item">
          <a
            class="nav-link"
            id="edita-tab"
            data-toggle="tab"
            href="#tareas"
            role="tab"
            aria-controls="tareas"
            aria-selected="false"
          >
            {{ $t("perfil.submenuTareas") }}
          </a>
        </li>
      </ul>
      <!-- Zona renderizado submenu -->
      <div class="tab-content" id="myTabContent">
        <!-- Zona renderizado Perfil -->
        <div
          class="tab-pane fade show active"
          id="perfilUsuario"
          role="tabpanel"
          aria-labelledby="perfilUsuario-tab"
        >
          <div class="row">
            <perfil-editable></perfil-editable>
          </div>
        </div>
        <!-- Zona renderizado Mascota -->
        <div
          class="tab-pane fade"
          id="mascota"
          role="tabpanel"
          aria-labelledby="mascota-tab"
        >
          <perfil-mascotas :propMascotas="mascotas"></perfil-mascotas>
        </div>
        <!-- Zona renderizado Valoraciones -->
        <div
          class="tab-pane fade"
          id="valoraciones"
          role="tabpanel"
          aria-labelledby="valoraciones-tab"
        >
          <perfil-valoraciones
            :propValoraciones="valoraciones"
          ></perfil-valoraciones>
        </div>
        <!-- Zona renderizado Tareas -->
        <div
          class="tab-pane fade"
          id="tareas"
          role="tabpanel"
          aria-labelledby="edita-tab"
        >
          <Tareas></Tareas>
        </div>
      </div>
    </div>
    <!-- Zona datos perfil -->
    <div class="col-lg-3 col-md-5 col-12">
      <datos-usuario></datos-usuario>
    </div>
  </div>
</template>

<script>
import Swal from "sweetalert2";
import Perfil_PerfilEditable from "./components-subparts/Perfil_PerfilEditable.vue";
import Perfil_Mascotas from "./components-subparts/Perfil_Mascotas.vue";
import Perfil_Valoraciones from "./components-subparts/Perfil_Valoraciones.vue";
import Tareas from "./Tareas";
import DatosUsuario from "./components-subparts/Perfil_DatosUsuario.vue";
import Api from "../Api";

export default {
  components: {
    "perfil-editable": Perfil_PerfilEditable,
    "perfil-mascotas": Perfil_Mascotas,
    "perfil-valoraciones": Perfil_Valoraciones,
    Tareas,
    "datos-usuario": DatosUsuario,
  },
  data() {
    return {
      mascotas: [],
      valoraciones: [],
    };
  },
  methods: {
    showByValo() {
      Api()
        .post("/usuario/userByProfOnly", this.profesionHome)
        .then((response) => {
          this.usuarios = response.data;
          console.log(this.usuarios);
          this.showByProf = true;
        });
    },

    recuperarMascota() {
      Api()
        .post("/mascota/recuperarMascota")
        .then((response) => {
          this.mascotas = response.data;
        });
    },
  },

  mounted() {
    // Recuperar Mascotas
    Api()
      .post("/mascota/recuperarMascota")
      .then((response) => {
        this.mascotas = response.data;
      });
    // Recuperar Valoraciones
    setTimeout(() => {
      Api().post("/valoraciones/recuperarValoraciones", { id: this.$root.user.id }).then((response) => {
          this.valoraciones = response.data;
        });
    }, 1000);
  },
};
</script>
