<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="modelId"
    tabindex="-1"
    role="dialog"
    aria-labelledby="modelTitleId"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Quina es la teva feina</h5>
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
          <select class="form-control" v-model="prof">
            <option v-for="profesion in profesiones" :key="profesion.id">
              {{ profesion.nombre_profesion }}
            </option>
          </select>

          <div class="form-group">
            <label for=""></label>
            <select class="form-control" name="titulacion" id="titulacion">
              <option value="S">Si</option>
              <option value="N">No</option>
            </select>
          </div>

          <div class="form-group">
            <label for=""></label>
            <select class="form-control" name="disponibilidad" id="disponibilidad">
              <option value="presencial">Presencial</option>
              <option value="online">Online</option>
              <option value="presencial y online">Presencial y Online</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Tanca
          </button>
          <button id="insertProf" @click="insertProf()" type="button" class="btn btn-primary">Guarda</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Swal from "sweetalert2";

export default {
  data() {
    return {
      profesiones: [],
      // Adri, perdón uwu Pero tengo que crearla para que no salga un error en consola
      prof: undefined,
    };
  },
  methods: {
      insertProf() {
      this.axios
        .post("api/profesiones/insertProf")
        .then((response) => {
          Swal.fire("Registro completado", "success");
        })
        .catch((error) => console.log(error))
        .finally(() => (this.loading = false));
    },

  created() {
    this.axios.get("api/profesiones/getAll").then((response) => {
      this.profesiones = response.data;
    });
  },
  }

};
</script>