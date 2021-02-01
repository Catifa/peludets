<template>
  <div class="col-md-11 mt-1">
    <form>
      <editor
        v-model="textoEditable.val"
        api-key="6pjhqn98u0f2a21lhh3fnygr2np8uwshnw0huk04p8dty974"
        :init="{
          height: 500,
          languaje: 'es',
          menubar: false,
          plugins: [
            'advlist lists textcolor colorpicker emoticons image preview save table wordcount',
          ],
          toolbar:
            'undo redo | formatselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | \
                bullist numlist table outdent indent | removeformat | emoticons image | preview save',
        }"
        v-bind:initial-value="'' + texto.texto + ''"
      ></editor>
    </form>
    <button @click="showEditor = !showEditor" class="btn btn-verde-peludets">
      Editar Perfil
    </button>
  </div>
</template>

<script>

import Editor from "@tinymce/tinymce-vue";

export default {
  components: {
    editor: Editor,
  },
  data() {
    return {
      textoEditable: {},
      texto: {},
      usuario: {},
      showEditor: false,
    };
  },
  methods: {
    saveContent() {
      let obj = {
        val: this.textoEditable.val,
        id: this.usuario.id,
      };

      this.axios.post("api/usuario/setProfText", obj);

      this.$router.go();
    },
  },
  mounted() {
    this.usuario.id = this.$root.user.id;
    this.axios
      .post("api/usuario/getProfText", this.usuario)
      .then((response) => {
        // Parseo de la respuesta de la base de datos a JSON
        let textoSinParsear = response.data[0].textoPerfil;
        let textoToJson = JSON.parse(
          textoSinParsear.replace(/(\w+)=/g, '"$1":')
        );
        this.texto = textoToJson;
        $('#perfEditable').html(this.texto.texto);
      });
  },
};
</script>