<template>
  <div class="col-12 mt-2">
    <div id="textoPerfil" v-if="!showEditor"></div>
    <!-- Editor texto -->
    <vue-editor
      v-model="text.val"
      v-if="showEditor"
      useCustomImageHandler
      @imageAdded="subirImagen($event)"
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
      {{ $t("perfil.perfilEditable.btnAltaSercicio") }}
    </button>

    <!-- Modales-->
    <modal-updateUser id="modalModificarUsuario" :propHideModal="hideModalModificarUsuario"></modal-updateUser>
    <modal-nuevaProfesion id="modalNuevaProfesion" :propHideModal="hideModalAnadirProfesion"></modal-nuevaProfesion>

  </div>
</template>


<script>
import { VueEditor } from "vue2-editor";
import Perfil_Modal_Update_User from "./Perfil_Modal_Update_User.vue";
import Perfil_Modal_Nueva_Profesion from "./Perfil_Modal_Nueva_Profesion.vue";
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

    hideModalModificarUsuario() {
      $("#modalModificarUsuario").modal("hide");
    },

    showModalAnadirProfesion() {
      $("#modalNuevaProfesion").modal("show");
    },

    hideModalAnadirProfesion() {
      $("#modalNuevaProfesion").modal("hide");
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

    updateImg(e) {
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