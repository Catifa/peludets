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
              <button type="submit" class="btn btn-azul-peludets">
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
      user: {
        email:"",
        name:"",
        lastname:"",
        dni:"",
        password:"",
      },
    };
  },
  methods: {
    register() {

      this.axios
        .post("api/auth/register", this.user).then((response) => {
          $("#form-registro").modal("hide");
          Swal.fire(
            "Registro completado",
            "Bienvenido, " + response.data.nombre,
            "success"
          );
          this.$router.push("/");
        })
        .catch((error) => console.log(error))
        .finally(() => (this.loading = false));
    },
  },
};
</script>