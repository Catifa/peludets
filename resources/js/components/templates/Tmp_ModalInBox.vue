<template>
  <!-- Modal -->
  <div id="notificaciones" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-azul-peludets">
          <h5 class="modal-title">Notificacions</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="contenedor-notificaciones" class="modal-body">
          <div
            role="alert"
            aria-live="assertive"
            aria-atomic="true"
            class="tostada"
            v-for="notificacion in notificaciones"
            :key="notificacion.id"
          >
            <!-- Header notificacion -->
            <div class="tostada-header bg-azul-peludets">
              <!-- Icono y tipo notificacion -->
              <i :class="logo(notificacion.categoria)"></i>
              <strong class="mr-auto">{{ notificacion.categoria }}</strong>
              <!-- Hora creacion -->
              <small>{{ time(notificacion.created_at) }}</small>
              <!-- Boton borrar -->
              <i
                class="fas fa-trash ml-2"
                title="Eliminar notificació"
                @click="deleteNot(notificacion.id)"
              ></i>
            </div>
            <!-- Body notificacion -->
            <div class="tostada-body">
              <div class="row">
                <div class="col-lg-6">
                  {{ notificacion.contenido.title }} - per a
                  {{ notificacion.contenido.nombre }}
                </div>
                <div class="col-lg-6 text-right">
                  <button
                    v-if="notificacion.categoria == 'Solicitud'"
                    class="btn btn-sm btn-verde-peludets"
                    @click="finalizarTrabajoCli(notificacion)"
                  >
                    Finalizar Trabajo
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-azul-peludets">
          <i class="fas fa-comments fa-1x" title="Filtrar per xat"></i>
          <i
            class="fas fa-user-friends fa-1x"
            title="Filtrar per solicituts d'amistat"
          ></i>
          <i
            class="fas fas fa-paper-plane fa-1x mr-auto"
            title="Filtrar per solicituts de serveis"
          ></i>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Api from "../../Api";
import "bootstrap";
import Swal from "sweetalert2";

export default {
  data() {
    return {
      notificaciones: [],
    };
  },
  methods: {
    getNotificaciones() {
      Api()
        .post("/notificaciones/getAll")
        .then((res) => {
          this.notificaciones = res.data;
          this.notificaciones.forEach((element) => {
            element.contenido = JSON.parse(element.contenido);
          });
        });
    },
    deleteNot(id) {
      Api()
        .post("/notificaciones/delete", { id })
        .then(() => {
          this.getNotificaciones();
        });
    },
    time(t) {
      let fecha = t.split("T")[0]; //Divide la fecha del timestamp
      let hora = t.split("T")[1].split(".")[0]; //Divide la hora en el timestamp
      return fecha + " | " + hora;
    },
    logo(l) {
      let logo = "fa-envelope";

      switch (l) {
        case "Chat":
          logo = "fa-comments";
          break;
        case "Solicitud":
          logo = "fa-paper-plane";
          break;
      }

      return "fas " + logo + " mr-2";
    },
    async finalizarTrabajoCli(sol) {
      Api()
        .post("/solicitudes/finalizarTrabajoCli", sol.contenido)
        .then(() => {
          this.deleteNot(sol.id);
        });

      $("#modal-inbox").modal("hide");

      const { value: text } = await Swal.fire({
        inputLabel: "Vols valorar a aquest usuari?",
        confirmButtonText: "Enviar valoració",
        showCancelButton: true,
        cancelButtonText: "Cancel·là",
        input: "textarea",
      });

      if (text) {
        Api().post('/valoraciones/insert', {texto: text, solicitud: sol.idDestinatario}).then(() => {
          Swal.fire({
            icon: 'success',
            confirmButtonText: 'De res',
            text: 'Gràcies per la teva valoració!'
          });
        });
      }
    },
  },
};
</script>