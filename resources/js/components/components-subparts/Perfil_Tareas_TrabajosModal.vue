<template>
  <!-- Modal -->
  <div class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Titulo Modal -->
        <div class="modal-header bg-azul-peludets">
          <h5 class="modal-title lila-peludets">
            {{ $t("perfil.tareas.modalSolicitudes.tituloModal") }}
          </h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
            @click="removeArray()"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
          <!-- Recorrido solicitudes -->
          <div
            class="form-group"
            v-for="solicitud in propConsultaSol"
            :key="solicitud.id"
          >
            <!-- Nombre -->
            <div class="mb-3">
              <label class="form-label">
                {{ $t("perfil.tareas.modalSolicitudes.nombreModal") }}
              </label>
              <input
                type="text"
                class="form-control"
                readonly
                :value="solicitud.extendedProps.nombre"
              />
            </div>
            <!-- Especie -->
            <div class="mb-3">
              <label class="form-label">
                {{ $t("perfil.tareas.modalSolicitudes.especieModal") }}
              </label>
              <input
                type="text"
                class="form-control"
                readonly
                :value="solicitud.extendedProps.especia"
              />
            </div>
            <!-- Peso -->
            <div class="mb-3">
              <label class="form-label">
                {{ $t("perfil.tareas.modalSolicitudes.pesoModal") }}
              </label>
              <input
                type="text"
                class="form-control"
                readonly
                :value="solicitud.extendedProps.peso"
              />
            </div>
            <!-- CP -->
            <div class="mb-3">
              <label class="form-label"> CP </label>
              <input
                type="text"
                class="form-control"
                readonly
                :value="solicitud.extendedProps.cp"
              />
            </div>
            <button
              type="button"
              class="btn btn-verde-peludets"
              data-dismiss="modal"
              @click="finalizarTrabajo(solicitud)"
            >
              {{ $t("perfil.tareas.modalSolicitudes.btnFinalizarTrabajo") }}
            </button>
          </div>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer bg-azul-peludets">
          <!-- Cerrar -->
          <button type="button" class="btn btn-danger" data-dismiss="modal" @click="removeArray()">
            {{ $t("perfil.tareas.modalSolicitudes.cerrarModal") }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import Api from '../../Api';

export default {
  props: {
    propConsultaSol: { type: Array },
    propEliminarEvento: { type: Function }
  },
  watch: {
    propConsultaSol: {
      handler(val) {
        this.solicitudes.push(val);
      },
    },
  },
  methods: {
    finalizarTrabajo(sol) {
      sol.categoria = 'Solicitud';
      sol.extendedProps.id = sol.id;
      sol.extendedProps.title = sol.title;
      Api().post("/solicitudes/finalizarTrabajoProf", sol).then(() => {
        Api().post("/notificaciones/add", sol);
      });
      this.propEliminarEvento(sol);
    }
  }
};
</script>
