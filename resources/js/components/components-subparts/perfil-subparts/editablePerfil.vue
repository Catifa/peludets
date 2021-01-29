<template>
  <div class="col-md-11 mt-1">
    <form @submit.prevent="saveTextProf" method="post">
      <editor
        v-model="textoEditable"
        api-key="6pjhqn98u0f2a21lhh3fnygr2np8uwshnw0huk04p8dty974"
        :init="{
            height: 500,
            languaje: 'es',
            menubar: false,
            plugins: [
                'advlist lists textcolor colorpicker emoticons image preview save table wordcount'
            ],
            toolbar:
                'undo redo | formatselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | \
                bullist numlist table outdent indent | removeformat | emoticons image | preview save'
            }"
      ></editor>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      textoEditable: {}
    };
  },
  methods: {
    saveTextProf() {
      console.log(this.textoEditable);
    }
  }
};
</script>