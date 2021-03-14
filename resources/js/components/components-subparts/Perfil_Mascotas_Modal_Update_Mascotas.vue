<template>
  <div class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <!-- Modal content-->
      <div class="modal-content">
        <!-- Titulo modal -->
        <div class="modal-header bg-azul-peludets">
          <h4 class="modal-title lila-peludets">
            {{ $t("perfil.mascotas.modalModificarMascotas.tituloModal") }}
          </h4>
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
          <!-- Nombre -->
          <div class="form-group">
            <label class="form-label">
              {{ $t("perfil.mascotas.modalModificarMascotas.nombreModal") }}
            </label>
            <input
              type="text"
              v-model="mascota.nombre"
              class="form-control"
              :placeholder="propMascota.nombre"
            />
          </div>
          <!-- Especie -->
          <div class="form-group">
            <label class="form-label">
              {{ $t("perfil.mascotas.modalModificarMascotas.especieModal") }}
            </label>
            <select class="form-control" v-model="mascota.especie">
              <option v-for="especie in propEspecies" :key="especie.id">
                {{ especie.nombre }}
              </option>
            </select>
          </div>
          <!-- Raza -->
          <div class="form-group">
            <label class="form-label">
              {{ $t("perfil.mascotas.modalModificarMascotas.razaModal") }}
            </label>
            <input
              type="text"
              class="form-control"
              v-model="mascota.raza"
              :placeholder="propMascota.raza"
            />
          </div>
          <!-- Edad -->
          <div class="form-group">
            <label class="form-label">
              {{ $t("perfil.mascotas.modalModificarMascotas.edadModal") }}
            </label>
            <input
              type="text"
              class="form-control"
              v-model="mascota.edad"
              aria-describedby="emailHelp"
              :placeholder="propMascota.edad"
            />
          </div>
          <!-- Peso -->
          <div class="form-group">
            <label class="form-label">
              {{ $t("perfil.mascotas.modalModificarMascotas.pesoModal") }}
            </label>
            <input
              type="text"
              class="form-control"
              v-model="mascota.peso"
              aria-describedby="emailHelp"
              :placeholder="propMascota.peso"
            />
          </div>
          <!-- Foto -->
          <div class="form-group">
            <label class="form-label">
              {{ $t("perfil.mascotas.modalModificarMascotas.fotoModal") }}
            </label>
            <input
              type="file"
              class="form-control-file"
              @change="imgUpload($event)"
            />
          </div>
        </div>
        <!-- Footer Modal -->
        <div class="modal-footer bg-azul-peludets">
          <!-- Boton guardar -->
          <button
            type="button"
            @click="updateMascota(mascota.id)"
            class="btn btn-azul-peludets"
          >
            {{ $t("perfil.mascotas.modalModificarMascotas.guardarModal") }}
          </button>
          <!-- Boton cerrar -->
          <button type="button" class="btn btn-danger" data-dismiss="modal">
            {{ $t("perfil.mascotas.modalModificarMascotas.cerrarModal") }}
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
    propHideModal: { type: Function },
    propMascota: { type: Object },
    propEspecies: { type: Array }
  },
  data() {
    return {
      mascota: {},
      img: {},
      mascotas: [],
    };
  },
  methods: {
    updateMascota(id) {
      this.mascota.userId = this.$root.user.id;
      this.mascota.photo = this.img;
      this.mascota.id = id;
      Api()
        .post("/mascota/updateMascota", this.mascota)
        .then(() => {
          this.propHideModal();
          Swal.fire("Mascota modificada", "", "success");
        })
        .catch((error) => console.log(error))
        .finally(() => (this.loading = false));
    },
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
  },
};
</script>