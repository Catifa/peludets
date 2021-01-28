<style>
@import "../css/app.css";
@import "../css/main_menu.css";
@import "../css/footer.css";
</style>
 
<template>
  <div class="container-fluid">
    <div v-if="this.$root.user != null && this.$root.user != isEmpty">
      <div class="row">
        <nav
          id="navbar-peludets"
          class="container-fluid navbar navbar-expand-md sticky-top bg-azul-peludets"
        >
          <router-link to="/" class="navbar-brand"
            ><img src="../img/logo/logo.png" alt="Peludets!" />
          </router-link>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <router-link to="/explorador" class="nav-link">
                  {{ $t("app.menuExplorador") }}
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/profesionales" class="nav-link">
                  {{ $t("app.menuProfesionales") }}
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/download" class="nav-link">
                  Descarga la app <!-- FALTA TRADUCIR -->
                </router-link>
              </li>

              <li class="nav-item d-md-none">
                <router-link to="/myProfile" class="nav-link">
                  Perfil
                </router-link>
              </li>
              <li class="nav-item d-md-none mx-auto">
                <span class="dropdown-item-text"
                  ><button
                    class="btn btn-danger-peludets"
                    id="desconectar"
                    type="button"
                    @click="logout()"
                  >
                    Desconectar
                  </button></span
                >
              </li>
            </ul>
            <div id="navbar-peludets-derecha" class="navbar-nav navbar-right">
              <a
                class="dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <!-- Foto de usuaio -->
                <img
                  src="sources/img/avatar.jfif"
                  class="rounded-circle"
                  width="100%"
                />
              </a>
              <div class="dropdown-menu dropdown-menu-right text-center">
                <span class="dropdown-item-text">
                  <img
                    id="fotoDesplegable"
                    src="sources/img/avatar.jfif"
                    class="rounded"
                    alt="Foto perfil"
                  /><span class="ml-3 font-weight-bold">{{
                    this.$root.user.name
                  }}</span>
                </span>
                <span class="dropdown-item-text text-right">
                  <i class="far fa-envelope mr-2"></i>
                  <a
                    a
                    href="javascript:void(0)"
                    id="editaPerfil"
                    class="fas fa-cog"
                  ></a>
                </span>
                <div class="dropdown-divider"></div>
                <router-link to="/myProfile" class="nav-link">
                  Perfil
                </router-link>

                <div class="dropdown-divider"></div>
                <span class="dropdown-item-text"
                  ><button
                    class="btn btn-danger-peludets"
                    id="desconectar"
                    type="button"
                    @click="logout()"
                  >
                    Desconectar
                  </button></span
                >
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
    <div v-if="this.$root.user == null">
      <!--Formulario registro -->
      <form_registro></form_registro>
      <!--Formulario inicio sesion -->
      <form_inicio_sesion></form_inicio_sesion>
      <!-- Sin sesion -->
      <!-- Menu Nav -->
      <div class="row">
        <nav
          id="navbar-peludets"
          class="container-fluid navbar navbar-expand-md sticky-top bg-azul-peludets"
        >
          <router-link to="/" class="navbar-brand"
            ><img src="../img/logo/logo.png" alt="Peludets!" />
          </router-link>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <router-link to="/explorador" class="nav-link">
                  {{ $t("app.menuExplorador") }}
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/profesionales" class="nav-link">
                  {{ $t("app.menuProfesionales") }}
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/download" class="nav-link">
                  Descarga la app <!-- FALTA TRADUCIR -->
                </router-link>
              </li>
              <li class="nav-item d-md-none mx-auto">
                <button
                  id="inicio-sesion"
                  type="button"
                  class="btn btn-lila-peludets btn-sm mr-2"
                  data-toggle="modal"
                  data-target="#form-inicioSesion"
                >
                  {{ $t("app.menuLogin") }}
                </button>
                <button
                  id="registro"
                  type="button"
                  class="btn btn-lila-peludets btn-sm"
                  data-toggle="modal"
                  data-target="#form-registro"
                >
                  {{ $t("app.menuRegistro") }}
                </button>
              </li>
            </ul>
            <router-link to="/login" class="navbar-brand">
              <ul class="navbar-nav navbar-right">
                <li class="nav-item">
                  <button
                    id="inicio-sesion"
                    type="button"
                    class="btn btn-lila-peludets btn-sm mr-2"
                    data-toggle="modal"
                    data-target="#form-inicioSesion"
                  >
                    {{ $t("app.menuLogin") }}
                  </button>
                </li>
                <li class="nav-item">
                  <button
                    id="registro"
                    type="button"
                    class="btn btn-lila-peludets btn-sm"
                    data-toggle="modal"
                    data-target="#form-registro"
                  >
                    {{ $t("app.menuRegistro") }}
                  </button>
                </li>
              </ul>
            </router-link>
          </div>
        </nav>
      </div>
    </div>

    <router-view></router-view>

    <!-- Footer -->
    <div class="row">
      <footer class="container-fluid font-small bg-azul-peludets pt-4 mt-3">
        <div class="text-center text-md-left">
          <div class="row">
            <div class="col-md-6 mt-md-0 mt-3">
              <h5 class="text-uppercase">Footer Content</h5>
              <p>
                Here you can use rows and columns to organize your footer
                content.
              </p>
            </div>
            <hr class="clearfix w-100 d-md-none pb-3" />
            <div class="col-md-3 mb-md-0 mb-3">
              <h5 class="text-uppercase">{{ $t("app.footerContacto") }}</h5>
              <ul class="list-unstyled">
                <li>
                  <p>Badia del valles, 08214</p>
                </li>
                <li>
                  <p>Hoña uwu</p>
                </li>
                <li>
                  <p>Barcelona, {{ $t("app.footerPais") }}</p>
                </li>
              </ul>
            </div>
            <div class="col-md-3 mb-md-0 mb-3">
              <h5 class="text-uppercase">
                {{ $t("app.footerRedesSociales") }}
              </h5>
              <ul class="list-unstyled">
                <li class="redes-sociales">
                  <a class="mr-2" href="https://twitter.com/" target="blank"
                    ><i class="fab fa-twitter-square"></i
                  ></a>
                  <a class="mr-2" href="htttps://instagram.com/" target="blank"
                    ><i class="fab fa-instagram-square"></i
                  ></a>
                  <a href="htttps://facebook.com/" target="blank"
                    ><i class="fab fa-facebook-square"></i
                  ></a>
                </li>
              </ul>
              <ul class="list-unstyled">
                <li>
                  <button
                    class="mr-1 btn btn-lila-peludets"
                    href="javascrip:void(0)"
                    v-for="(lang, i) in langs"
                    :key="`Lang${i}`"
                    :value="lang"
                    @click="setLocale(lang)"
                  >
                    {{ lang }}
                  </button>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="container-fluid footer-copyright text-center py-3">
            © 2020 Peludets!
          </div>
        </div>
      </footer>
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
        console.log(res.data);
        if (res.data) {
          this.getUser();
        } else {
          this.$root.user = null;
        }
      });
    },
    setLocale(locale) {
      this.$i18n.locale = locale;
    },
    logout() {
      axios.post("/api/auth/logout").then((res) => {
        console.log(res.data);
        this.$root.user = null;
        this.$router.push("/");
      });
    },
    getUser() {
      axios.get("/api/user").then((res) => {
        console.log(res.data);
        this.$root.user = res.data;
      });
    },
  },
  mounted() {
    this.isAuthenticated();
  },
};
</script>