<style>
@import "../css/app.css";
@import "../css/main_menu.css";
@import "../css/footer.css";
</style>
 
<template>

  <div class="container-fluid bg-azul-peludets">
    <!-- CABECERA -->
    <div class="row">
      <!-- LOGO -->
      <div class="mt-5 col-md-3 mx-auto d-flex justify-content-center">
        <img src="../img/logo/logo.png" alt="Peludets" style="width: 50%" />
      </div>
    </div>

    <div class="row">
      <!-- MENU PRINCIPAL -->
      <nav class="col-md-12 navbar navbar-peludets navbar-expand-lg">
        <!-- BOTON RESPONSIVE -->
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#menuPrincipal"
          aria-controls="menuPrincipal"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="col-md-12 collapse navbar-collapse" id="menuPrincipal">
          <ul class="mr-auto"></ul>
          <!-- ELEMENTOS DEL MENÚ -->
          <ul class="navbar-nav mx-auto">
            <!-- EXPLORADOR -->
            <li class="nav-item">
              <router-link
                to="/explorador"
                class="nav-link lila-peludets font-weight-bold menu-link"
              >
                {{ $t("app.menuExplorador") }}
              </router-link>
            </li>
            <!-- PROFESIONALES -->
            <li class="nav-item">
              <router-link
                to="/profesionales"
                class="nav-link lila-peludets font-weight-bold menu-link"
              >
                {{ $t("app.menuProfesionales") }}
              </router-link>
            </li>
            <!-- DESCARGAS -->
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle lila-peludets font-weight-bold menu-link"
                href="#"
                id="opcionesDescarga"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                {{ $t("app.menuDescarga") }}
              </a>
              <div class="dropdown-menu" aria-labelledby="opcionesDescarga">
                <a
                  href="/bin/mac.zip"
                  class="lila-peludets font-weight-bold"
                  download
                  >Mac</a
                >
                <a
                  href="/bin/win.7z"
                  class="lila-peludets font-weight-bold"
                  download
                  >Windows</a
                >
                <a
                  href="/bin/linux.tar.gz"
                  class="lila-peludets font-weight-bold"
                  download
                  >Linux</a
                >
              </div>
            </li>
          </ul>
          <!-- USUARIO -->
          <ul class="navbar-nav mr-auto">
            <div class="dropdown">
              <button
                class="btn btn-lila-peludets dropdown-toggle"
                type="button"
                id="menuUsuario"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="fas fa-user fa-lg"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="menuUsuario">
                <button class="dropdown-item" type="button">Action</button>
                <button class="dropdown-item" type="button">
                  Another action
                </button>
                <button class="dropdown-item" type="button">
                  Something else here
                </button>
              </div>
            </div>
          </ul>
        </div>
      </nav>
    </div>
  </div>

</template>

<script>
export default {
  name: "local-changer",
  data() {
    return {
      langs: ["es", "ca", "en"],
    };
  },
  methods: {
    isAuthenticated() {
      axios.post("/api/auth/check").then((res) => {
        //console.log(res.data);
        if (res.data) {
          this.getUser();
        } else {
          this.$root.user = null;
        }

        //console.log(res.data);
      });
    },
    setLocale(locale) {
      this.$i18n.locale = locale;
    },
    logout() {
      axios.post("/api/auth/logout").then((res) => {
        //console.log(res.data);
        this.$root.user = null;
        this.$root.photo = "sources/img/avatar.jfif";
        this.$router.push("/");
      });
    },
    getUser() {
      axios.get("/api/user").then((res) => {
        //console.log(res.data);
        this.$root.user = res.data;
        axios.post("/api/files/getProfilePhoto").then((res) => {
          this.$root.photo = res.data[0].photo;
        });
      });
    },
  },
  mounted() {
    this.isAuthenticated();
  },
};
</script>