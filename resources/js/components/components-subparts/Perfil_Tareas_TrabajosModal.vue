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
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    propConsultaSol: { type: Array },
  },
  watch: {
    propConsultaSol: {
      handler(val) {
        this.solicitudes.push(val);
      },
    },
  },
  data() {
    return {
      solicitudes: [],
    };
  },
};
</script>
