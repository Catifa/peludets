<template>
  <!-- Banner Privacidad -->
  <div class="row">
    <footer id="banner" class="container-fluid font-small pt-4 mt-3 banner">
      <div class="text-center text-md-left">
        <div class="col-md-12 mt-md-0 mt-3">
          <div class="row">
            <div class="col text-center">
              <button
                @click="ocultarBanner"
                class="btn btn-default bannerTexto"
                data-toggle="modal"
              
              >
               <u> {{ $t("app.tituloBannerPrivacidad") }} </u>
              </button>
            </div>
          </div>

          <h5 class="text-uppercase bannerTexto">Privacidad y Cookies</h5>
          <p class="bannerTexto">
            Esta app utiliza coockies, al utilizarla aceptas los terminos de
            privacidad de ©Peludets. Entra en el siguiente enlace si quieres
            saber mas <a href="#" @click="showModal"> entra en este enlace</a>
          </p>
        </div>
      </div>
    </footer>

    <banner_privacidad id="banner_privacidad" :ocultarModal="ocultarModal">  </banner_privacidad>
  </div>
</template>
<script>
import ModalPrivacidad from './App_ModalBanner';

export default {
  components:{
     'banner_privacidad' : ModalPrivacidad
  },
  methods: {

     ocultarModal() {
      $("#banner_privacidad").modal('hide');
    },

    showModal(){
       $("#banner_privacidad").modal('show');
    },

    ocultarBanner() {
      $("#banner").hide();
    },
  },
};
</script>

