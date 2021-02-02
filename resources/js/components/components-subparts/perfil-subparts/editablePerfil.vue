<template>
  <div class="col-md-11 mt-1">
    <div id="textoPerfil" v-if="!showEditor"></div>
    <vue-editor v-model="text" v-if="showEditor"></vue-editor>
    <button @click="saveContent" class="btn btn-verde-peludets">
      Guardar Perfil
    </button>
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";

export default {
  components: {
    VueEditor,
  },
  data() {
    return {
      text: {},
      showEditor: true,
      user: {}
    };
  },
  methods: {
    saveContent() {
      let obj = {
        val: this.text,
        id: this.user.id,
      };

      this.axios.post("api/usuario/setProfText", obj).then(() => {
        this.showEditor = false;
        $("#textoPerfil").html(this.text);
      });
    },
    getContent() {
      this.axios
        .post("api/usuario/getProfText", this.user)
        .then((response) => {
          console.log(response.data);
        });
    },
  },
  mounted() {
    this.getContent();
  },
  beforeCreate() {
    this.user = this.$root.user;
  }
};
</script>