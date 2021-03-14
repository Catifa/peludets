<template>
  <div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
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
          <form action method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="email">nombre</label>
              <input
                type="text"
                class="form-control"
                v-model="user.name"
                :placeholder="$root.user.name"
              />
            </div>
            <div class="mb-3">
              <label for="apellido">Apellido</label>
              <input
                type="text"
                class="form-control"
                v-model="user.lastname"
                :placeholder="$root.user.lastname"
              />
            </div>
            <div class="mb-3">
              <label for="apellido">Apellido</label>
              <input
                type="text"
                class="form-control"
                v-model="user.secondlastname"
                :placeholder="$root.user.secondlastname"
              />
            </div>
            <div class="mb-3">
              <label for="apellido">Correo</label>
              <input
                type="text"
                class="form-control"
                v-model="user.email"
                :placeholder="$root.user.email"
              />
            </div>
            <div class="mb-3">
              <label for="dni">DNI</label>
              <input
                type="text"
                class="form-control"
                v-model="user.dni"
                :placeholder="$root.user.dni"
              />
            </div>
            <div id="divFileMascota" class="mb-3 btn btn-azul-peludets">
              <label for="foto">Foto de Perfil (opcional)</label>
              <input
                type="file"
                class="form-control-file"
                id="file"
                @change="file($event)"
              />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button
            id="updateUser"
            @click="updateUsuario($root.user.id)"
            type="button"
            class="btn btn-primary"
          >
            Save changes
          </button>
          <button
            id="recuperarUser"
            @click="recuperarUser($root.user.id)"
            type="button"
            class="btn btn-secondary"
            data-dismiss="modal"
          >
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Swal from "sweetalert2";
import Api from '../../Api';

export default {
  props: ["updateUser"],
  data() {
    return {
      user: {},
      img: {},
    };
  },
  methods: {
    recuperarUser() {
      Api().post("/usuario/recuperarUser").then((response) => {
        this.user = response.data;
        console.log(response.data);
      });
    },

    updateUsuario(id) {
      this.user.userId = this.$root.user.id;
      this.user.img = this.img;
      this.user.id = id;
      console.log(this.user);
      Api()
        .post("/usuario/updateUsuario", this.user)
        .then((response) => {
          Swal.fire("Usuario modificada", "success");
          this.recuperarMascota();
        })
        .catch((error) => console.log(error))
        .finally(() => (this.loading = false));
    },
    file(e) {
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