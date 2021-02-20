<template>

  <div class="container">
    <!-- Carta Guía de precios -->
    <div class="card">
      <div class="card-header">
        <h2 class="crema-peludets">Guía de precios</h2>
      </div>
      <div class="card-body">
        <div>
          <h3 class="azul-peludets d-inline">Paseos</h3>
          <h4 class="d-inline">5€/h</h4>
        </div>
        <div class="mt-2">
          <h3 class="azul-peludets d-inline">Alojamiento</h3>
          <h4 class="d-inline">10€/día</h4>
        </div>
        <div class="mt-2">
          <h3 class="azul-peludets d-inline">Corte de pelo</h3>
          <h4 class="d-inline">12€</h4>
        </div>
      </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <button class="btn btn-lila-peludets" @click="mostrarModalTrabajos">
                Contratar a nombre
            </button>
        </div>
    </div>
    <!-- Modal para realizar la contratación -->
    <modal-trabajos id="modalTrabajos"></modal-trabajos>
  </div>

</template>

<script>

import ModalTrabajos from './Tmp_Perfil_ModalTrabajos.vue';

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
      return null;
    },
    mostrarModalTrabajos() {
        $('#modalTrabajos').modal('show');
    }
  },

  created() {
    // Al crearse el componente se le añaden las profesiones
    this.profesiones = this.obtenerProfesionesLista();
  }
  
};

</script>