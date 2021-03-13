<template>
  
    <!-- Modal -->
    <div class="modal fade" role="dialog" v-on:keyup.enter="register">
      <div class="modal-dialog modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header bg-azul-peludets">
            <h5 class="modal-title lila-peludets">Formulario de registro</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              @click="hideReg"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <!-- Foto Perfil -->
            <div class="form-group">
              <label for="email">Foto de Perfil (opcional)</label>
              <input
                type="file"
                class="form-control-file"
                id="file"
                @change="file($event)"
              />
            </div>
            <!-- Email -->
            <div class="form-group">
              <label for="email">Correo</label>
              <input
                type="text"
                class="form-control"
                v-model="user.email"
                placeholder="Introduce tu correo electrónico"
              />
            </div>
            <!-- Nombre -->
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input
                type="text"
                class="form-control"
                v-model="user.name"
                placeholder="Introduce tu nombre"
              />
              <label for="apellido"></label>
              <input
                type="text"
                class="form-control"
                v-model="user.lastname"
                placeholder="Primer apellido"
              />
              <label for="apellido"></label>
              <input
                type="text"
                class="form-control"
                v-model="user.secondlastname"
                placeholder="Segundo apellido"
              />
            </div>
            <!-- DNI -->
            <div class="form-group">
              <label for="dni">DNI</label>
              <input
                type="text"
                class="form-control"
                v-model="user.dni"
                placeholder="Introduce tu DNI"
              />
            </div>
            <!-- Contraseña -->
            <div class="form-group">
              <label for="contraseña">Contraseña</label>
              <input
                type="password"
                class="form-control"
                v-model="user.password"
              />
            </div>
          </div>

          <div class="modal-footer bg-azul-peludets">
            <button
              type="submit"
              class="btn btn-azul-peludets"
              @click="register()"
            >
              Registrate!
            </button>
            <button
              type="button"
              class="btn btn-danger"
              data-dismiss="modal"
              @click="hideReg"
            >
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>
  
</template>

<script>
import Swal from "sweetalert2";
import Api from './Api';

export default {
  props: {
    hideReg: { type: Function }
  },
  data() {
    return {
      user: {},
      img: {},
    };
  },
  mounted() {
    this.hideReg();
  },
  methods: {
    register() {
      this.Api()
        .post("/auth/register", this.user)
        .then((response) => {

          this.hideReg();
          Swal.fire(
            "Registro completado",
            "Bienvenido, " + response.data.user.name,
            "success"
          );

          this.store();

          this.$root.user = response.data.user;

          this.$router.push("/");
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
    store() {
      //console.log(this.img);
      Api()
        .post("/files/setProfilePhoto", { img: this.img })
        .then((res) => {
          this.getPhoto();
        });
    },
    getPhoto() {
      Api().post("/files/getProfilePhoto").then((res) => {
        this.$root.photo = res.data[0].photo;
      });
    }
  },
};
</script>