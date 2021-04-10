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
            v-for="solicitud in solicitudes"
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
                :value="solicitud[0].extendedProps.nombre"
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
                :value="solicitud[0].extendedProps.especia"
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
                :value="solicitud[0].extendedProps.peso"
              />
            </div>
            <!-- CP -->
            <div class="mb-3">
              <label class="form-label"> CP </label>
              <input
                type="text"
                class="form-control"
                readonly
                :value="solicitud[0].extendedProps.cp"
              />
            </div>
            <button
              type="button"
              class="btn btn-verde-peludets"
              data-dismiss="modal"
              @click="finalizarTrabajo(solicitud[0])"
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
      Api().post("/solicitudes/eliminarSolicitud", sol);
      this.removeArray();
      this.propEliminarEvento(sol);
    },
    removeArray() {
      this.solicitudes = [];
    }
  },
  data() {
    return {
      solicitudes: [],
    };
  },
};
</script>
