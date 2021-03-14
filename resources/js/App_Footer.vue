  <template>
  <div class="row">
    <footer class="container-fluid font-small bg-azul-peludets pt-4 mt-3">
      <div class="text-center text-md-left">
        <div class="row">
          <div class="col-md-6 mt-md-0 mt-3">
            <h5 class="text-uppercase">{{ $t("home.colaboradores") }}</h5>
            <img id="logo" src="../img/DinaHosting.png" alt="a" />
            <img id="logo" src="../img/DonDominio.png" alt="a" />
            <img id="logo" src="../img/wapps_logo.png" alt="a" />
          </div>
          <hr class="clearfix w-100 d-md-none pb-3" />
          <div class="col-md-3 mb-md-0 mb-3">
            <h5 class="text-uppercase">{{ $t("app.footerContacto") }}</h5>
            <ul class="list-unstyled">
              <li>
                <p>info@peludets.cat</p>
              </li>
              <li>
                <p>677677266</p>
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
      <div class="row">
        <div class="container-fluid footer-copyright text-center py-3">
          © 2020 Peludets!
        </div>
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
