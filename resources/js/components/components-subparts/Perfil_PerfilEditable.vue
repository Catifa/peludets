<template>
  <div class="col-12 mt-2">
    <div id="textoPerfil" v-if="!showEditor"></div>
    <!-- Editor texto -->
    <vue-editor
      v-model="text.val"
      v-if="showEditor"
      useCustomImageHandler
      @imageAdded="subirImagen"
    ></vue-editor>
    <!-- Boton guardar perfil -->
    <button
      v-if="showEditor"
      @click="saveContent"
      type="button"
      class="btn btn-verde-peludets mt-1"
    >
      {{ $t("perfil.perfilEditable.btnGuardarPerfil") }}
    </button>
    <!-- Boton editar perfil -->
    <button
      v-if="!showEditor"
      @click="showEditor = !showEditor"
      type="button"
      class="btn btn-azul-peludets mt-1"
    >
      {{ $t("perfil.perfilEditable.btnEditarPerfil") }}
    </button>
    <!-- Boton editar perfil -->
    <button
      @click="showModalModificarUsuario"
      type="button"
      class="btn btn-azul-peludets mt-1"
    >
      {{ $t("perfil.perfilEditable.btnModificarPerfil") }}
    </button>
    <!-- Boton añadir profesion -->
    <button
      @click="showModalAnadirProfesion"
      type="button"
      class="btn btn-azul-peludets mt-1"
    >
      <i class="fas fa-paw"></i>
    </button>

    <!-- Modales-->
    <modal-updateUser id="modalModificarUsuario"></modal-updateUser>
    <modal-nuevaProfesion id="modalNuevaProfesion"></modal-nuevaProfesion>

  </div>
</template>


<script>
import { VueEditor } from "vue2-editor";
import Perfil_Modal_Update_User from "./Perfil_Modal_Update_User.vue";
import Perfil_Modal_Nueva_Profesion from "./Perfil_Modal_Nueva_Profesion.vue";
import { u } from "../../utils";
import Api from "../../Api";

export default {
  components: {
    VueEditor,
    "modal-updateUser": Perfil_Modal_Update_User,
    "modal-nuevaProfesion": Perfil_Modal_Nueva_Profesion,
  },
  data() {
    return {
      text: {},
      showEditor: false,
      user: {},
    };
  },
  methods: {
    showModalModificarUsuario() {
      $("#modalModificarUsuario").modal("show");
    },

    showModalAnadirProfesion() {
      $("#modalNuevaProfesion").modal("show");
    },

    saveContent() {
      let obj = {
        val: this.text.val,
        id: this.user.id,
      };

      Api()
        .post("/usuario/setProfText", obj)
        .then(() => {
          this.showEditor = false;
        })
        .finally(() => {
          $("#textoPerfil").html(obj.val);
        });
    },

    subirImagen() {},

    getContent() {
      Api()
        .post("/usuario/getProfText", this.user)
        .then((response) => {
          let textVal = response.data[0];
          this.text.val = textVal.textoPerfil;
          $("#textoPerfil").html(textVal.textoPerfil);
        });
    },

    getUserId() {
      Api()
        .get("/user")
        .then((response) => {
          this.user = response.data;
          this.getContent();
        });
    },
  },
  mounted() {
    this.getUserId();
  },
};
</script>