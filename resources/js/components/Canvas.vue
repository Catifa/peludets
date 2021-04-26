<style>
@import "../../css/canvas.css";
</style>

<template>
  <div class="container-fluid mt-5">
    <div class="col-md-12 col-xs-12">
      <mapa></mapa>
    </div>
    <div class="col-md-12 col-xs-12 mt-5">
      <div class="row  justify-content-center">
        <h4>Afegeix fotos dels passejos amb les mascotes dels teus clients</h4>
        <a name="" id="" class="btn btn-lila-peludets ml-5" href="#" role="button"
          >+</a
        >
      </div>
    </div>
  </div>
</template>


<script>
import MapaExplorador from "./components-subparts/Explorador_mapa.vue";

export default {
  components: {
    mapa: MapaExplorador,
  },
  data() {},
};
</script>


