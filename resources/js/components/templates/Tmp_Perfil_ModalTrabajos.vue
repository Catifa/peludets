<template>
  <div class="modal" tabindex="-1" role="dialog" ref="modalSolicitud">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <!-- Header Modal -->
        <div class="modal-header bg-azul-peludets">
          <h5 class="modal-title lila-peludets">{{ $t("tmpPerfil.solicitud.tituloModal") }}</h5>
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
              v-if="solicitud == 'Passejador'"
              :propHora="horas"
              :propEspecies="especies"
              :propTrabajo="solicitudTrabajo"
              :propErrores="errores"
              @solicitudRellena="solicitudTrabajo"
            ></solicitud-paseo>
            <solicitud-alojamiento
              v-if="solicitud == 'Allotjament'"
              :propHora="horas"
              :propEspecies="especies"
              :propTrabajo="solicitudTrabajo"
              :propErrores="errores"
              @solicitudRellena="solicitudTrabajo"
            ></solicitud-alojamiento>
            <solicitud-peluqueria
              v-if="solicitud == 'Perruquer'"
              :propHora="horas"
              :propEspecies="especies"
              :propTrabajo="solicitudTrabajo"
              :propErrores="errores"
              @solicitudRellena="solicitudTrabajo"
            ></solicitud-peluqueria>
            <solicitud-entrenador
              v-if="solicitud == 'Ensinistrador'"
              :propHora="horas"
              :propEspecies="especies"
              :propTrabajo="solicitudTrabajo"
              :propErrores="errores"
              @solicitudRellena="solicitudTrabajo"
            ></solicitud-entrenador>
            <solicitud-psicologo
              v-if="solicitud == 'Psicòleg'"
              :propHora="horas"
              :propEspecies="especies"
              :propTrabajo="solicitudTrabajo"
              :propErrores="errores"
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
            {{ $t("tmpPerfil.solicitud.solicitar") }}
          </button>
          <button
            type="button"
            class="btn btn-danger"
            data-dismiss="modal"
            @click="reiniciarModal()"
          >
            {{ $t("tmpPerfil.solicitud.cancelar") }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Swal2 from "sweetalert2";

import SolicitudPaseo from "./Tmp_Perfil_ModalTrabajos_Paseo.vue";
import SolicitudAlojamiento from "./Tmp_Perfil_ModalTrabajos_Alojamiento.vue";
import SolicitudPeluqueria from "./Tmp_Perfil_ModalTrabajos_Peluqueria.vue";
import SolicitudEntrenador from "./Tmp_Perfil_ModalTrabajos_Entrenador.vue";
import SolicitudPsicologo from "./Tmp_Perfil_ModalTrabajos_Psicologo.vue";
import Api from '../../Api';

export default {
  components: {
    "solicitud-paseo": SolicitudPaseo,
    "solicitud-alojamiento": SolicitudAlojamiento,
    "solicitud-peluqueria": SolicitudPeluqueria,
    "solicitud-entrenador": SolicitudEntrenador,
    "solicitud-psicologo": SolicitudPsicologo,
  },
  props: ["propTrabajos", "propUsuario"],
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
      // Objeto para controlar los errores
      errores: {}
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
      $(".modal-body .btn-outline-success").removeClass("active");
      $(event.target).addClass("active");
    },
    // Get de todas las especies en la base de datos
    getAllSpecies() {
      Api().get("/especie/getAll").then((response) => {
        this.especies = response.data;
      });
    },
    enviarSolicitud() {
      this.solicitudTrabajo.idDestinatario = this.propUsuario.id;
      this.solicitudTrabajo.idRemitente = this.$root.user.id;
      this.solicitudTrabajo.solicitud = this.solicitud;
      Api()
        .post("/solicitudes/enviar", this.solicitudTrabajo)
        .then(() => {
          Swal2.fire({
            text: "Solicitud enviada correctamente",
            icon: "succes",
          });

          //ENVIAR CORREO
          Api().get('/contactanos', this.propUsuario);
           Api().get('/solicitud');

          $('.modal').modal('hide');
        })
        .catch((error) => {
          this.errores = error.response.data.errors;
        });
    },
    reiniciarModal() {
      this.solicitud = null;
      this.solicitudTrabajo = {};
      $(".modal-body .btn-outline-success").removeClass("active");
    }
  },
  created() {
    this.rellenarHoras();
    this.getAllSpecies();
  },
};
</script>