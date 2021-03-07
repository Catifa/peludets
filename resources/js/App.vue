<style>
@import "../css/app.css";
@import "../css/main_menu.css";
@import "../css/footer.css";
</style>
 
<template>

  <div class="container-fluid">

    <!--Formulario registro -->
    <form_registro v-if="this.$root.user == null"></form_registro>
    <!--Formulario inicio sesion -->
    <form_inicio_sesion v-if="this.$root.user == null"></form_inicio_sesion>

    <!-- Main Menu -->
    <main_menu></main_menu>
    
    <!-- Zona renderizado componentes -->
    <router-view></router-view>

    <!-- Footer -->
    <footer-pldts></footer-pldts>

  </div>

</template>

<script>

import MainMenu from './App_MainMenu.vue';
import Footer from './App_Footer.vue';

export default {
  name: "local-changer",
  components: {
    'footerPldts': Footer,
    'main_menu': MainMenu
  },
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