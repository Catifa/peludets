<template>
  <div class="modal" tabindex="-1" role="dialog" ref="modalSolicitud">
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
            @click="reiniciarModal()"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Cuerpo Modal -->
        <div class="modal-body">
          <!-- Botones donde se muestran las profesiones -->
          <div class="row">
            <div
              class="col-md-4"
              v-for="trabajo in propTrabajos"
              :key="trabajo.id"
            >
              <button
                type="button"
                class="btn btn-outline-success"
                @click="
                  solicitud = trabajo.nombre_profesion;
                  activeBtn($event);
                "
              >
                {{ trabajo.nombre_profesion }} <i class="fas fa-walking"></i>
              </button>
            </div>
          </div>
          <!-- Sección Solicitudes -->
          <div class="row mt-3">
            <solicitud-paseo
              v-if="solicitud == 'Paseador'"
              :propHora="horas"
              :propEspecies="especies"
              :propTrabajo="solicitudTrabajo"
              @solicitudRellena="solicitudTrabajo"
            ></solicitud-paseo>
            <solicitud-alojamiento
              v-if="solicitud == 'Alojamiento'"
              :propHora="horas"
              :propEspecies="especies"
              :propTrabajo="solicitudTrabajo"
              @solicitudRellena="solicitudTrabajo"
            ></solicitud-alojamiento>
            <solicitud-peluqueria
              v-if="solicitud == 'Peluquero'"
              :propHora="horas"
              :propEspecies="especies"
              :propTrabajo="solicitudTrabajo"
              @solicitudRellena="solicitudTrabajo"
            ></solicitud-peluqueria>
            <solicitud-entrenador
              v-if="solicitud == 'Entrenador'"
              :propHora="horas"
              :propEspecies="especies"
              :propTrabajo="solicitudTrabajo"
              @solicitudRellena="solicitudTrabajo"
            ></solicitud-entrenador>
            <solicitud-psicologo
              v-if="solicitud == 'Psicologo'"
              :propHora="horas"
              :propEspecies="especies"
              :propTrabajo="solicitudTrabajo"
              @solicitudRellena="solicitudTrabajo"
            ></solicitud-psicologo>
          </div>
        </div>
        <!-- Footer Modal -->
        <div class="modal-footer bg-azul-peludets">
          <button
            type="button"
            class="btn btn-lila-peludets"
            @click="enviarSolicitud()"
          >
            Solicitar
          </button>
          <button
            type="button"
            class="btn btn-danger"
            data-dismiss="modal"
            @click="reiniciarModal()"
          >
            Cerrar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import Swal2 from 'sweetalert2';

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
  props: ['propTrabajos', 'propUsuario'],
  data() {
    return {
      // Variable para tener las horas sin tener que escribirlas a mano
      horas: [],
      // Variable para pasarle a los modales las diferentes especies
      especies: [],
      // Variable para determinar el modal que se mostrara
      solicitud: null,
      // Objeto con los campos de la solicitud
      solicitudTrabajo: {},
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
    },
    activeBtn(event) {
      $('.modal-body .btn-outline-success').removeClass('active');
      $(event.target).addClass('active');
    },
    // Get de todas las especies en la base de datos
    getAllSpecies() {
      this.axios.get('/api/especie/getAll').then((response) => {
        this.especies = response.data;
      });
    },
    enviarSolicitud() {
      this.solicitudTrabajo.idDestinatario = this.propUsuario.id;
      this.solicitudTrabajo.idRemitente = this.$root.user.id;
      console.log(this.solicitudTrabajo);
      this.axios.post('api/solicitudes/enviar', this.solicitudTrabajo).then(() => {
        Swal2.fire(
          'Solicitud enviada correctamente',
          'succes'
        );
      }).catch(() =>{
        Swal2.fire({
          text:'Ha habido un error',
          icon:'error'
        });
      });
    },
    reiniciarModal() {
      this.solicitud = null
      this.solicitudTrabajo = {},
      $('.modal-body .btn-outline-success').removeClass('active');
    }
  },
  created() {
    this.rellenarHoras();
    this.getAllSpecies();
  }
};
</script>