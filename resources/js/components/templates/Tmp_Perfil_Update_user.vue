<template>
  <div class="row">
    <!-- Modal -->
    <div id="form-registro" class="modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <div class="container-fluid">
              <div class="col-md-12">
                <h4 class="modal-title">Formulario de registro</h4>
              </div>
            </div>
          </div>
          <div class="modal-body">
            <form @submit.prevent="register" method="post">
              <div class="form-group">
                <label for="email">Foto de Perfil (opcional)</label>
                <input type="file" id="file" @change="file($event)" />
              </div>
              <div class="form-group">
                <label for="email">Correo</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="user.email"
                  placeholder="Introduce tu correo electrónico"
                />
              </div>
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="user.name"
                  placeholder="Introduce tu nombre"
                />
              </div>
              <div class="form-group">
                <label for="apellido">Apellidos</label>
                <div class="row">
                  <div class="col-md-6">
                    <input
                      type="text"
                      class="form-control"
                      v-model="user.lastname"
                      placeholder="Primer apellido"
                    />
                  </div>
                  <div class="col-md-6">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Segundo apellido"
                    />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="dni">DNI</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="user.dni"
                  placeholder="Introduce tu DNI"
                />
              </div>
              <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <input
                  type="password"
                  class="form-control"
                  v-model="user.password"
                />
              </div>
              <button  
              class="btn btn-azul-peludets" 
              @click="updateUsuario(propUsuario.id)">
                Registrate!
              </button>
            </form>
          </div>
          <div class="modal-footer"></div>
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
      user: {},
      img: {},
    };
  },
  methods: {
    updateUsuario(id) {
      this.mascota.userId = this.$root.user.id;
      this.mascota.img = this.img;
      this.mascota.id = id;
      console.log(this.mascota);
      this.axios
        .post("api/mascota/updateMascota", this.mascota)
        .then((response) => {
          $("#form-updateMascota").modal("hide");
          Swal.fire("Mascota modificada", "success");
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
    store() {
      //console.log(this.img);
      axios
        .post("/api/files/setProfilePhoto", { img: this.img })
        .then((res) => {
          this.getPhoto();
        });
    },
    getPhoto() {
      axios.post("/api/files/getProfilePhoto").then((res) => {
        this.$root.photo = res.data[0].photo;
      });
    },
  },
};
</script>