<template>
  <!-- Modal -->
  <div class="modal fade" role="dialog" v-on:keyup.enter="login">
    <div class="modal-dialog modal-dialog-centered">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header bg-azul-peludets">
          <h5 class="modal-title lila-peludets">Inicio de sesión</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
            @click="hideLog"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <!-- Email -->
          <div class="form-group">
            <label>Email</label>
            <input
              type="text"
              class="form-control"
              placeholder="Introduce tu email"
              v-model="user.email"
            />
          </div>
          <!-- Contraseña -->
          <div class="form-group">
            <label>Contraseña</label>
            <input
              type="password"
              class="form-control"
              v-model="user.password"
            />
          </div>
        </div>

        <div class="modal-footer bg-azul-peludets">
          <button type="submit" class="btn btn-azul-peludets" @click="login">
            Iniciar sesión
          </button>

          <button
            type="button"
            class="btn btn-danger"
            data-dismiss="modal"
            @click="hideLog"
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

export default {
  props: {
    hideLog: { type: Function },
  },
  data() {
    return {
      user: {},
    };
  },
  mounted() {
    this.hideLog();
  },
  methods: {
    login() {
      this.axios
        .post("/api/auth/login", this.user)
        .then((response) => {
          this.hideLog();
          Swal.fire(
            "Usuario correcto!",
            "Bienvenido, " + response.data.name,
            "success"
          );
          this.$root.user = response.data;
          axios.post("/api/files/getProfilePhoto").then((res) => {
            this.$root.photo = res.data[0].photo;
          });
          this.$router.push("/");
        })
        .catch((error) => console.log(error))
        .finally(() => (this.loading = false));
    },
  },
};
</script>