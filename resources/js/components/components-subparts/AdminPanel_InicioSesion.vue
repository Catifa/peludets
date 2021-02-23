<template>
  <div>
    <form @submit.prevent="login" method="post">
      <div>
        <label>Email</label>
        <input
          type="text"
          class="form-control"
          placeholder="Introduce tu email"
          v-model="user.email"
        />
      </div>
      <div>
        <label>Contraseña</label>
        <input type="password" class="form-control" v-model="user.password" />
      </div>
      <button type="submit" class="btn btn-azul-peludets">
        Iniciar sesión
      </button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {},
    };
  },
  methods: {
    login() {
      this.axios
        .post("/api/auth/adminLogin", this.user)
        .then((response) => {
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