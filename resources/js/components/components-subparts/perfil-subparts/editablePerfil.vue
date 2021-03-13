<template>
  <div class="col-md-11 mt-2 ml-3">
    <div id="textoPerfil" v-if="!showEditor"></div>
    <vue-editor v-model="text.val" v-if="showEditor" useCustomImageHandler @imageAdded="handleImageAdded"></vue-editor>
    <button v-if="showEditor" @click="saveContent" class="btn btn-verde-peludets mt-1">Guardar Perfil</button>
    <button
      v-if="!showEditor"
      @click="showEditor = !showEditor"
      class="btn btn-verde-peludets mt-1"
    >Editar Perfil</button>
 
 
  <button
      @click="modalUsuario"
      class="btn btn-verde-peludets mt-1"
    >Modificar Cuenta</button>

    <modalUpdateUser id="modalUsuario"></modalUpdateUser>
  </div>
    
</template>


<script>
import { VueEditor } from "vue2-editor";
import Perfil_Modal_Update_User from "../Perfil_Modal_Update_User.vue"; 
import Api from '../../../Api';


export default {

  components: { 
    VueEditor,
    'modalUpdateUser' : Perfil_Modal_Update_User
   
  },
  data() {
    return {
      text: {},
      showEditor: false,
      user: {}
    };
  },
  methods: {
    modalUsuario() {
       $('#modalUsuario').modal('show');
    },

    saveContent() {
      let obj = {
        val: this.text.val,
        id: this.user.id
      };

      this.Api()
        .post("/usuario/setProfText", obj)
        .then(() => {
          this.showEditor = false;
        })
        .finally(() => {
          $("#textoPerfil").html(obj.val);
        });
    },
    getContent() {
      this.Api().post("/usuario/getProfText", this.user).then(response => {
        let textVal = response.data[0];
        this.text.val = textVal.textoPerfil;
        $("#textoPerfil").html(textVal.textoPerfil);
      });
    },
    getUserId() {
      this.Api().get("/user").then((response) => {
        this.user = response.data;
        this.getContent();
      })
    }
  },
  mounted() {
    this.getUserId();
  }
};
</script>