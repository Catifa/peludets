<template>
  <!-- Modal -->
  <div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <!-- Titulo Modal -->
        <div class="modal-header bg-azul-peludets">
          <h5 class="modal-title lila-peludets">
            {{ $t("perfil.perfilEditable.modalNuevaProfesion.tituloModal") }}
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
        <!-- Body Modal -->
        <div class="modal-body">
          <!-- Select profesiones -->
          <div class="form-group">
            <label>
              {{
                $t(
                  "perfil.perfilEditable.modalNuevaProfesion.selectProfesionModal"
                )
              }}
            </label>
            <select
              class="form-control"
              v-model="profesion.profesion"
              name="profesion"
              id="profesion"
            >
              <option v-for="profesion in profesiones" :key="profesion.id">
                {{ profesion.nombre_profesion }}
              </option>
            </select>
          </div>
          <!-- Select titulacion -->
          <div class="form-group">
            <label>
              {{
                $t("perfil.perfilEditable.modalNuevaProfesion.selecnSnModal")
              }}
            </label>
            <select
              v-model="profesion.titulacion"
              class="form-control"
              name="titulacion"
              id="titulacion"
            >
              <option value="S">
                {{ $t("perfil.perfilEditable.modalNuevaProfesion.siModal") }}
              </option>
              <option value="N">
                {{ $t("perfil.perfilEditable.modalNuevaProfesion.noModal") }}
              </option>
            </select>
          </div>
          <!-- Select disponibilidad -->
          <div class="form-group">
            <label>
              {{
                $t(
                  "perfil.perfilEditable.modalNuevaProfesion.disponibilidadModal"
                )
              }}
            </label>
            <select
              v-model="profesion.disponibilidad"
              class="form-control"
              name="disponibilidad"
              id="disponibilidad"
            >
              <option value="P">
                {{
                  $t(
                    "perfil.perfilEditable.modalNuevaProfesion.presencialModal"
                  )
                }}
              </option>
              <option value="O">
                {{
                  $t("perfil.perfilEditable.modalNuevaProfesion.onlineModal")
                }}
              </option>
              <option value="PO">
                {{
                  $t(
                    "perfil.perfilEditable.modalNuevaProfesion.presencialOnlineModal"
                  )
                }}
              </option>
            </select>
          </div>
        </div>
        <!-- Footer Modal -->
        <div class="modal-footer bg-azul-peludets">
          <!-- Boton guardar -->
          <button
            @click="insertProf()"
            type="button"
            class="btn btn-azul-peludets"
          >
            {{ $t("perfil.perfilEditable.modalNuevaProfesion.guardarModal") }}
          </button>
          <!-- Boton cerrar -->
          <button type="button" class="btn btn-danger" data-dismiss="modal">
            {{ $t("perfil.perfilEditable.modalNuevaProfesion.cerrarModal") }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Swal from "sweetalert2";
import Api from "../../Api";

export default {
  props: {
    propHideModal: { type: Function }
  },
  data() {
    return {
      profesiones: [],
      profesion: {},
      prof: undefined,
    };
  },
  methods: {
    insertProf() {
      this.profesion.userId = this.$root.user.id;

      Api().post("/profesiones/insertProf", this.profesion).then(() => {
          Swal.fire("Registro completado", "", "success");
          this.propHideModal();
        }).catch((error) => console.log(error));
    },
  },

  created() {
    Api()
      .get("/profesiones/getAll")
      .then((response) => {
        this.profesiones = response.data;
      });
  },
};
</script>