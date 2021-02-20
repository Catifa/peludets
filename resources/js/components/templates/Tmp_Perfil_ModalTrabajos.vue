<template>
  <div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <!-- Header Modal -->
        <div class="modal-header bg-azul-peludets">
          <h5 class="modal-title lila-peludets">Solicitud de contrato</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Cuerpo Modal -->
        <div class="modal-body">
          <!-- Botones donde se muestran las profesiones -->
          <div class="row">
            <div class="col-md-4">
              <button type="button" class="btn btn-outline-success" @click="solicitud = 'Paseo'">
                Paseo <i class="fas fa-walking"></i>
              </button>
            </div>
            <div class="col-md-4">
              <button type="button" class="btn btn-outline-success" @click="solicitud = 'Alojamiento'">
                Alojamiento <i class="fas fa-home"></i>
              </button>
            </div>
            <div class="col-md-4">
              <button type="button" class="btn btn-outline-success" @click="solicitud = 'Peluqueria'">
                Peluqueria <i class="fas fa-cut"></i>
              </button>
            </div>
          </div>
          <!-- Sección Solicitudes -->
          <div class="row mt-3">
            <solicitud-paseo v-if="solicitud == 'Paseo'"></solicitud-paseo>
            <solicitud-alojamiento v-if="solicitud == 'Alojamiento'"></solicitud-alojamiento>
            <solicitud-peluqueria v-if="solicitud == 'Peluqueria'"></solicitud-peluqueria>
            <solicitud-entrenador v-if="solicitud == 'Entrenamiento'"></solicitud-entrenador>
            <solicitud-psicologo v-if="solicitud == 'Psicologo'"></solicitud-psicologo>
          </div>
        </div>
        <!-- Footer Modal -->
        <div class="modal-footer bg-azul-peludets">
          <button type="button" class="btn btn-lila-peludets">Solicitar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">
            Cerrar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SolicitudPaseo from "./Tmp_Perfil_ModalTrabajos_Paseo.vue";
import SolicitudAlojamiento from "./Tmp_Perfil_ModalTrabajos_Alojamiento.vue";
import SolicitudPeluqueria from "./Tmp_Perfil_ModalTrabajos_Peluqueria.vue";
import SolicitudEntrenador from "./Tmp_Perfil_ModalTrabajos_Entrenador.vue";
import SolicitudPsicologo from "./Tmp_Perfil_ModalTrabajos_Psicologo.vue";

export default {
  components: {
      'solicitud-paseo': SolicitudPaseo,
      'solicitud-alojamiento': SolicitudAlojamiento,
      'solicitud-peluqueria': SolicitudPeluqueria,
      'solicitud-entrenador': SolicitudEntrenador,
      'solicitud-psicologo': SolicitudPsicologo
  },

  data() {
    return {
      // Variable para tener las horas sin tener que escribirlas a mano
      horas: [],
      // Variable para determinar el modal que se mostrara
      solicitud: null
    };
  },

  methods: {
    // Bucle para rellenar todas las horas con franja de media hora
    rellenarHoras() {
      for (let i = 5; i < 24; i++) {
        if (i == 24) {
          this.horas.push(i + ":00");
        } else {
          this.horas.push(i + ":00");
          this.horas.push(i + ":30");
        }
      }
    }
  },

  created() {
    this.rellenarHoras();
  },
};
</script>