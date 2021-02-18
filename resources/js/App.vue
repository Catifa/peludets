<style>
@import "../css/app.css";
@import "../css/footer.css";
</style>
 
<template>
  <div>
    <mainmenu></mainmenu>

    <router-view></router-view>
  </div>
</template>

<script>

import MainMenu from "./components/MainMenu";

export default {
  name: "local-changer",
  components: {
    mainmenu: MainMenu,
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