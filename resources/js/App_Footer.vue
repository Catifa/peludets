<template>
  <div class="row mt-auto">
    <footer class="container-fluid font-small bg-azul-peludets pt-4 mt-3">
      <div class="text-center text-md-left">
        <div class="row">
          <div class="col-md-6 mt-md-0 mt-3">
            <h5 class="text-uppercase">{{ $t("home.colaboradores") }}</h5>
            <a href="https://es.dinahosting.com/"
              ><img id="logo" src="../img/DinaHosting.png" alt="a"
            /></a>
            <a href="https://www.dondominio.com/"
              ><img id="logo" src="../img/DonDominio.png" alt="a"
            /></a>
            <a href="https://wapps.cat/"
              ><img id="logo" src="../img/wapps_logo.png" alt="a"
            /></a>
          </div>
          <hr class="clearfix w-100 d-md-none pb-3" />
          <div class="col-md-3 mb-md-0 mb-3">
            <h5 class="text-uppercase">{{ $t("app.footerContacto") }}</h5>
            <ul class="list-unstyled">
              <li>
                <p>info@peludets.cat</p>
              </li>
              <li>
                <p>Badia del Valles, Barcelona, {{ $t("app.footerPais") }}</p>
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
      <div class="row justify-content-center footer-copyright">
          <table class="justify-content-center">
            <tr>
              <td>© 2020 Peludets!</td>
              <td>
                <!--Privacidad-->
                <router-link to="/privacitat" class="nav-link navItemPldts">
                  <i class="fas fa-info-circle"></i>
                </router-link>
              </td>
            </tr>
          </table>
        </div>
    </footer>
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
    setLocale(locale) {
      this.$i18n.locale = locale;
    },
  },
};
</script>
