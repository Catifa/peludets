<template>
  <div class="row">
    <!-- Modal -->
    <div id="form-inicioSesion" class="modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <div class="container-fluid">
              <div class="col-md-12">
                <h4 class="modal-title">Inicio de sesión</h4>
              </div>
            </div>
          </div>
          <div class="modal-body">
            <form @submit.prevent="login" method="post">
              <div class="form-group">
                <label>Email</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Introduce tu email"
                  v-model="user.email"
                />
              </div>
              <div class="form-group">
                <label>Contraseña</label>
                <input
                  type="password"
                  class="form-control"
                  v-model="user.password"
                />
              </div>
              <button type="submit" class="btn btn-azul-peludets">
                Iniciar sesión
              </button>
            </form>
          </div>
          <div class="modal-footer">
            <small><a href="">He olvidado mi contraseña</a></small>
          </div>
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
        email: "",
        password: "",
      },
    };
  },
  methods: {
    login() {
      this.axios
        .post("/api/auth/login", this.user)
        .then((response) => {
          $("#form-inicioSesion").modal("hide");
          Swal.fire(
            "Registro completado",
            "Bienvenido, " + response.data.nombre,
            "success"
          );
          this.$root.user = response.data;
          console.log(response.data);
          this.$router.push("/");
        })
        .catch((error) => console.log(error))
        .finally(() => (this.loading = false));
    },
  },
};
</script>