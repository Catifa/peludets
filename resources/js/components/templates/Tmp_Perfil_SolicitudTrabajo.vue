<template>

  <div class="container">
    <!-- Boton contratar -->
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-lila-peludets" @click="mostrarModalTrabajos">
                {{ $t("tmpPerfil.solicitud.contratar") }} {{ $attrs.propUser.name }}
            </button>
        </div>
    </div>
    <!-- Modal para realizar la contratación -->
    <modal-trabajos id="modalTrabajos" :propTrabajos="profesiones" :propUsuario="$attrs.propUser"></modal-trabajos>
  </div>

</template>

<script>

import ModalTrabajos from './Tmp_Perfil_ModalTrabajos.vue';
import Api from '../../Api';

export default {

  components: { 
    'modal-trabajos': ModalTrabajos 
    },

  data() {
    return {
      // Array de profesiones disponibles para el profesional
      profesiones: [],
    };
  },

  methods: {
    obtenerProfesionesLista() {
      Api().post('/profesiones/getUserProf', {id: this.$route.params.id}).then((response) => {
        this.profesiones = response.data;
      });
    },
    mostrarModalTrabajos() {
        $('#modalTrabajos').modal('show');
    }
  },

  created() {
    this.obtenerProfesionesLista();
  }
  
};

</script>