<style>
@import "../css/app.css";
@import "../css/main_menu.css";
@import "../css/footer.css";
</style>
 
<template>
  <div class="container-fluid d-flex flex-column h-100">
    <!--Formulario registro -->
    <form_registro
      v-if="this.$root.user == null"
      id="formRegistro"
      :hideReg="closeRegModal"
    ></form_registro>
    <!--Formulario inicio sesion -->
    <form_inicio_sesion
      v-if="this.$root.user == null"
      id="formInicioSesion"
      :hideLog="closeLogModal"
    ></form_inicio_sesion>

    <!-- Main Menu -->
    <main_menu :showReg="showRegModal" :showLog="showLogModal"></main_menu>

    <!-- Zona renderizado componentes -->
    <router-view></router-view>

    <!-- Footer -->
    <footer-pldts></footer-pldts>

    <!-- Banner Publi -->
    <banner_publi v-if="banner() == false"></banner_publi>

    <!-- Chat -->
    <chat v-if="this.$root.user != null"></chat>
  </div>
</template>

<script>
import FormInicioSesion from "./App_Form_Inicio_Sesion.vue";
import FormRegistro from "./App_Form_Registro.vue";
import MainMenu from "./App_MainMenu.vue";
import Footer from "./App_Footer.vue";
import BannerPubli from "./App_Banner_Privacidad.vue";
import Chat from "./App_Chat.vue";
import Api from "./Api";
import Swal from "sweetalert2";

export default {
  components: {
    form_inicio_sesion: FormInicioSesion,
    form_registro: FormRegistro,
    footerPldts: Footer,
    main_menu: MainMenu,
    banner_publi: BannerPubli,
    chat: Chat,
  },
  methods: {
    isAuthenticated() {
      Api()
        .get("/authentication")
        .then((res) => {
          this.getUser();
          return true;
        })
        .catch((error) => {
          this.$root.user = null;
          return false;
        });
    },
    getUser() {
      Api()
        .get("/user")
        .then((res) => {
          this.$root.user = res.data;
          Api()
            .post("/files/getProfilePhoto")
            .then((res) => {
              this.$root.photo = res.data[0].photo;
            });
        });
    },
    // Modal Registro
    showRegModal() {
      $("#formRegistro").modal("show");
    },
    closeRegModal() {
      $("#formRegistro").modal("hide");
    },
    // Modal Inicio Sesion
    showLogModal() {
      $("#formInicioSesion").modal("show");
    },
    closeLogModal() {
      $("#formInicioSesion").modal("hide");
    },
    banner() {
      if (localStorage.getItem("BannerPrivacidad") == "true") return true;
      return false;
    },
  },
  mounted() {
    this.isAuthenticated();
    if (
      this.$route.path == "/device" ||
      /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
        navigator.userAgent
      )
    ) {
      this.$root.device = true;
      localStorage.setItem("BannerPrivacidad", true);
    }
    
    Swal.fire({
      title:
        "<strong>Descarrega't l'app de Peludets des de la play store</strong>",
      icon: "info",
      html:
        '<a class="btn btn-lila-peludets" href="https://play.google.com/store/apps/details?id=com.peludets.com&gl=ES"><img src="https://www.gstatic.com/android/market_images/web/play_prism_hlock_2x.png" alt="Peludets" width="50%"></a><br> ',
      showCloseButton: true,
      showConfirmButton: false,
    });
  },
};
</script>