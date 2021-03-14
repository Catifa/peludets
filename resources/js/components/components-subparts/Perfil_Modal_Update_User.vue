<template>
  <div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <!-- Titulo Modal -->
        <div class="modal-header bg-azul-peludets">
          <h5 class="modal-title lila-peludets">
            {{ $t("perfil.perfilEditable.modalUpdateUser.tituloModal") }}
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
          <!-- Nombre -->
          <div class="mb-3">
            <label>
              {{ $t("perfil.perfilEditable.modalUpdateUser.nombreModal") }}
            </label>
            <input type="text" class="form-control" v-model="userModal.name" />
          </div>
          <!-- Apellido -->
          <div class="mb-3">
            <label>
              {{ $t("perfil.perfilEditable.modalUpdateUser.apellidoModal") }}
            </label>
            <input
              type="text"
              class="form-control"
              v-model="userModal.lastname"
            />
          </div>
          <!-- Correo -->
          <div class="mb-3">
            <label>
              {{ $t("perfil.perfilEditable.modalUpdateUser.correoModal") }}
            </label>
            <input type="text" class="form-control" v-model="userModal.email" />
          </div>
          <!-- DNI -->
          <div class="mb-3">
            <label> DNI </label>
            <input type="text" class="form-control" v-model="userModal.dni" />
          </div>
          <!-- Foto -->
          <div id="divFileMascota" class="mb-3">
            <label>
              {{ $t("perfil.perfilEditable.modalUpdateUser.fotoModal") }}
            </label>
            <input
              type="file"
              class="form-control-file"
              id="file"
              @change="updateImg($event)"
            />
          </div>
        </div>
        <!-- Footer Modal -->
        <div class="modal-footer bg-azul-peludets">
          <!-- Guardar cambios -->
          <button
            @click="updateUsuario($root.user.id)"
            type="button"
            class="btn btn-azul-peludets"
          >
            {{ $t("perfil.perfilEditable.modalUpdateUser.guardarModal") }}
          </button>
          <!-- Cerrar -->
          <button type="button" class="btn btn-danger" data-dismiss="modal">
            {{ $t("perfil.perfilEditable.modalUpdateUser.cerrarModal") }}
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
  },
  data() {
    return {
      user: {},
      userModal: {},
      img: undefined,
    };
  },
  methods: {
    recuperarUser() {
      Api()
        .get("/user")
        .then((response) => {
          this.user = response.data;
          this.userModal = this.user;
          this.$root.user = response.data;
          this.$root.photo = response.data.photo;
        });
    },

    updateUsuario(id) {
      this.userModal.userId = this.$root.user.id;
      this.userModal.img = this.img;
      this.userModal.id = id;

      Api()
        .post("/usuario/updateUsuario", this.userModal)
        .then(() => {
          Swal.fire("Usuario modificado correctamente", "", "success");
          this.recuperarUser();
          this.propHideModal();
        });
    },

    updateImg(e) {
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
  mounted() {
    this.recuperarUser();
  },
};
</script>