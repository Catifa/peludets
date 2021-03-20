<template>
  <div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <!-- Titulo Modal -->
        <div class="modal-header bg-azul-peludets">
          <h5 class="modal-title lila-peludets">
            {{ $t("perfil.mascotas.modalAnadirMascotas.tituloModal") }}
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
        <!-- Modal Body -->
        <div class="modal-body">
          <!-- Nombre -->
          <div class="form-group">
            <label class="form-label">
              {{ $t("perfil.mascotas.modalAnadirMascotas.nombreModal") }}
            </label>
            <input type="text" v-model="mascota.nombre" class="form-control" />
          </div>
          <!-- Especie -->
          <div class="form-group">
            <label for class="form-label">
              {{ $t("perfil.mascotas.modalAnadirMascotas.especieModal") }}
            </label>
            <select class="form-control" v-model="mascota.especie">
              <option v-for="especie in propEspecies" :key="especie.id">
                {{ especie.nombre }}
              </option>
            </select>
          </div>
          <!-- Raza -->
          <div class="form-group">
            <label for class="form-label">
              {{ $t("perfil.mascotas.modalAnadirMascotas.razaModal") }}
            </label>
            <input type="text" class="form-control" v-model="mascota.raza" />
          </div>
          <!-- Edad -->
          <div class="form-group">
            <label for class="form-label">
              {{ $t("perfil.mascotas.modalAnadirMascotas.edadModal") }}
            </label>
            <input type="number" class="form-control" v-model="mascota.edad" />
          </div>
          <!-- Peso -->
          <div class="form-group">
            <label for class="form-label">
              {{ $t("perfil.mascotas.modalAnadirMascotas.pesoModal") }}
            </label>
            <input type="number" class="form-control" v-model="mascota.peso" />
          </div>
          <!-- Foto -->
          <div class="form-group">
            <label for class="form-label">
              {{ $t("perfil.mascotas.modalAnadirMascotas.fotoModal") }}
            </label>
            <input
              type="file"
              class="form-control-file"
              @change="imgUpload($event)"
            />
          </div>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer bg-azul-peludets">
          <button
            type="button"
            @click="registerMascota()"
            class="btn btn-azul-peludets"
          >
            {{ $t("perfil.mascotas.modalAnadirMascotas.guardarModal") }}
          </button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">
            {{ $t("perfil.mascotas.modalAnadirMascotas.cerrarModal") }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Api from "../../Api";
import Swal from "sweetalert2";

export default {
  props: {
    propHideModal: { type: Function },
    propMascotas: { type: Array },
    propEspecies: { type: Array },
    propRecuperarMascotas: { type: Function }
  },
  data() {
    return {
      mascota: {},
      img: {},
    };
  },
  methods: {
    imgUpload(e) {
      var formData = new FormData();
      var file = e.target.files[0];
      formData.append("Filedata", file);
      var t = file.type.split("/").pop().toLowerCase();
      if (t != "jpeg" && t != "jpg" && t != "png") {
        alert("Seleccione un formato de imágen válido: (jpeg, jpg, png)");
        document.getElementById("file").value = "";
        return false;
      }
      if (file.size > 1024000) {
        alert("Tamaño de imágen máximo (1MB)");
        document.getElementById("file").value = "";
        return false;
      }

      let f = e.target.files[0];
      let reader = new FileReader();

      reader.onloadend = () => {
        this.img = reader.result;
      };

      reader.readAsDataURL(f);
    },
    registerMascota() {
      this.mascota.userId = this.$root.user.id;
      this.mascota.photo = this.img;
      Api().post("/mascota/registerMascota", this.mascota).then(() => {
          this.propRecuperarMascotas();
          this.propHideModal();
          Swal.fire("Registro completado", "", "success");
        }).catch((error) => console.log(error));
    },
  }
};
</script>