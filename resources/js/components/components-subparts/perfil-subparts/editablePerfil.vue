<template>
  <div class="col-md-11 mt-2 ml-3">
    <div id="textoPerfil" v-if="!showEditor"></div>
    <vue-editor
      v-model="text.val"
      v-if="showEditor"
      useCustomImageHandler
      @imageAdded="handleImageAdded"
    ></vue-editor>
    <button
      v-if="showEditor"
      @click="saveContent"
      class="btn btn-verde-peludets mt-1"
    >
      Guardar Perfil
    </button>
    <button
      v-if="!showEditor"
      @click="showEditor = !showEditor"
      class="btn btn-azul-peludets mt-1"
    >
      Editar Perfil
    </button>

    <button @click="modalUsuario" class="btn btn-azul-peludets mt-1">
      Modificar Cuenta
    </button>

    <modalUpdateUser id="modalUsuario"></modalUpdateUser>

    <button
      data-toggle="modal"
      data-target="#PerfilModalNuevaProfesion"
      @click="PerfilModalNuevaProfesion"
      type="button"
      class="btn btn-azul-peludets mt-1"
    >
      <i class="fas fa-paw"></i>
    </button>

    <PerfilModalNuevaProfesion
      id="PerfilModalNuevaProfesion"
    ></PerfilModalNuevaProfesion>
  </div>
</template>


<script>
import { VueEditor } from "vue2-editor";
import Perfil_Modal_Update_User from "../Perfil_Modal_Update_User.vue";
import Perfil_Modal_Nueva_Profesion from "../Perfil_Modal_Nueva_Profesion.vue";

export default {
  components: {
    VueEditor,
    modalUpdateUser: Perfil_Modal_Update_User,
    PerfilModalNuevaProfesion: Perfil_Modal_Nueva_Profesion,
  },
  data() {
    return {
      text: {},
      showEditor: false,
      user: {},
    };
  },
  methods: {
    modalUsuario() {
      $("#modalUsuario").modal("show");
    },

    PerfilModalNuevaProfesion() {
      $("#PerfilModalNuevaProfesion").modal("show");
    },

    saveContent() {
      let obj = {
        val: this.text.val,
        id: this.user.id,
      };

      this.axios
        .post("api/usuario/setProfText", obj)
        .then(() => {
          this.showEditor = false;
        })
        .finally(() => {
          $("#textoPerfil").html(obj.val);
        });
    },
    getContent() {
      this.axios.post("api/usuario/getProfText", this.user).then((response) => {
        let textVal = response.data[0];
        this.text.val = textVal.textoPerfil;
        $("#textoPerfil").html(textVal.textoPerfil);
      });
    },
    getUserId() {
      this.axios.get("api/user").then((response) => {
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