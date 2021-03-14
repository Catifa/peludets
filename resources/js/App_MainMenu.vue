<template>
  <div class="row">
    <nav class="container-fluid navbar navbar-expand-md bg-azul-peludets">
      <!-- Logo Peludets -->
      <router-link to="/" class="navbar-brand">
        <img id="logo" src="../img/logo/logo.png" alt="Peludets" />
      </router-link>
      <!-- Boton responsive -->
      <button
        @click="handleResize"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
        class="navbar-toggler"
      >
        <i class="fas fa-bars"></i>
      </button>
      <div id="navbarNav" class="collapse navbar-collapse">
        <!-- Seccion central elementos menu -->
        <ul class="navbar-nav mx-auto">
          <!-- Explorador -->
          <li class="nav-item navLiPldts">
            <router-link to="/explorador" class="nav-link navItemPldts">
              {{ $t("app.menuExplorador") }}
            </router-link>
          </li>
          <!-- Profesionales -->
          <li class="nav-item navLiPldts">
            <router-link to="/comunidad" class="nav-link navItemPldts">
              {{ $t("app.menuProfesionales") }}
            </router-link>
          </li>
          <!-- Descargas -->
          <li class="nav-item navLiPldts dropdown">
            <a
              class="nav-link dropdown-toggle navItemPldts"
              href="#"
              id="dropdownDescargas"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              {{ $t("app.menuDescarga") }}
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownDescargas">
              <a class="dropdown-item" href="/bin/mac.zip" download="">Mac&nbsp;&nbsp;<i class="fab fa-apple"></i></a>
              <a class="dropdown-item" href="/bin/win.7z" download=""
                >Windows&nbsp;&nbsp;<i class="fab fa-windows"></i></a
              >
              <a class="dropdown-item" href="/bin/linux.tar.gz" download=""
                >Linux&nbsp;&nbsp;<i class="fab fa-linux"></i></a
              >
              <a class="dropdown-item" href="" download=""
                >Android &nbsp;&nbsp; <i class="fab fa-android"></i></a
              >
            </div>
          </li>
        </ul>
        <!-- Seccion usuario/registro -->
        <!-- Sin registro -->
        <ul
          id="btnsRegistro"
          class="navbar-nav navbar-right list-inline"
          v-if="this.$root.user == null"
        >
          <!-- Iniciar Sesion -->
          <li class="nav-item list-inline-item">
            <button
              id="inicio-sesion"
              type="button"
              data-toggle="modal"
              data-target="#form-inicioSesion"
              class="btn btn-lila-peludets btn-sm mr-2"
              @click="showLog"
            >
             {{ $t("Menu.inicio") }}
            </button>
          </li>
          <!-- Registro -->
          <li class="nav-item list-inline-item">
            <button
              id="registro"
              type="button"
              data-toggle="modal"
              data-target="#form-registro"
              class="btn btn-lila-peludets btn-sm"
              @click="showReg"
            >
              {{ $t("Menu.registro") }}
            </button>
          </li>
        </ul>
        <!-- Usuario Registrado -->
        <ul class="navbar-nav navbar-right" v-if="this.$root.user != null">
          <li class="nav-item dropdown">
            <!-- Imagen Usuario -->
            <a
              class="nav-link dropdown-toggle"
              id="dropdownUsuario"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <img
                id="img-perfil"
                v-bind:src="this.$root.photo"
                class="rounded-circle"
                width="100%"
                alt="Usuario"
              />
            </a>
            <!-- Submenu Usuario -->
            <div
              class="dropdown-menu dropdown-menu-right text-center"
              aria-labelledby="dropdownUsuario"
            >
              <!-- Datos perfil -->
              <span class="dropdown-item-text">
                <img
                  v-bind:src="this.$root.photo"
                  class="rounded"
                  alt="Foto perfil"
                  id="fotoDesplegable"
                />
                <span class="ml-3 font-weight-bold">
                  {{ this.$root.user.name }}
                </span>
              </span>
              <!-- Divisor -->
              <div class="dropdown-divider" />
              <!-- Perfil -->
              <router-link class="dropdown-item" to="/myProfile">
                Perfil
              </router-link>
              <!-- Divisor -->
              <div class="dropdown-divider" />
              <!-- Boton Inbox -->
              <i
                class="far fa-envelope inbox-icon"
                @click="mostrarModalInBox"
              />
              <div class="dropdown-divider" />
              <!-- Desconectar -->
              <span class="dropdown-item-text">
                <button
                  class="btn btn-danger-peludets"
                  type="button"
                  @click="logout"
                >
                  {{ $t("app.menuDesconectar") }}
                </button>
              </span>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <modal-inbox id="modal-inbox"></modal-inbox>
  </div>
</template>

<script>

import ModalInbox from "./components/templates/Tmp_ModalInBox.vue";
import Api from './Api';

export default {
  components: {
    "modal-inbox": ModalInbox,
  },
  props: {
    showReg: { type: Function },
    showLog: { type: Function },
  },
  data() {
    return {};
  },
  mounted() {
    this.showReg();
    this.showLog();
  },
  methods: {
    logout() {
      Api().post("/auth/logout").then((res) => {
        this.$root.user = null;
        this.$root.photo = "sources/img/avatar.jfif";
        this.$router.push("/");
        localStorage.removeItem('token');
      });
    },

    // Funcion para controlar el tamaño de la pantalla
    handleResize() {
      if (document.getElementById("btnsRegistro") != null) {
        let wdw = window.innerWidth;

        if (wdw < 576) {
          document.getElementById("btnsRegistro").className =
            "navbar-right mt-3 text-center ulNoPaddingMenu";
        } else if (wdw > 576) {
          document.getElementById("btnsRegistro").className =
            "navbar-nav navbar-right list-inline";
        }
      }
    },

    mostrarModalInBox() {
      console.log("hola");
      $("#modal-inbox").modal("show");
    },
  },
};
</script>