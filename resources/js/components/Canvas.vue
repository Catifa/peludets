<style>
@import "../../css/canvas.css";
</style>

<template>
  <div class="container-fluid mt-5">
    <!--  <button type="button" class="btn btn-primary" @click="pintarCanvas">
      Pintar
    </button>
   <mapa-exp></mapa-exp>
    <canvas id="canvas" style="background: white" width="800" height="600">
    </canvas>-->
    <div class="col-md-12">
      <form id="form">
        <input
          type="hidden"
          name="start"
          class="input"
          id="start"
          value="mallorca  badia del valles"
        />
        <input
          type="hidden"
          name="end"
          class="input"
          id="destination"
          value="ibiza  vadia del valles"
        />
        <button class="btn btn-lila-peludets mt-2" type="submit">
          Paseo 1
        </button>
      </form>

      <div id="map" class="col-md-12 mt-5"></div>
    </div>
  </div>
</template>


<script>
import MapaExplorador from "./components-subparts/Explorador_mapa.vue";

export default {
  components: {
    "mapa-exp": MapaExplorador,
  },
  data() {},

  methods: {
    pintarCanvas() {
      const ALTURA_CANVAS = 600,
        ANCHURA_CANVAS = 800;

      var min = 1;
      var max = 600;
      var num1 = Math.random() * (max - min) + min;
      var num2 = Math.random() * (max - min) + min;
      var num3 = Math.random() * (max - min) + min;
      var num4 = Math.random() * (max - min) + min;
      // Obtener el elemento del DOM
      const canvas = document.querySelector("#canvas");
      canvas.width = ANCHURA_CANVAS;
      canvas.height = ALTURA_CANVAS;
      // Del canvas, obtener el contexto para poder dibujar
      const contexto = canvas.getContext("2d");
      // Comenzar
      contexto.beginPath();
      // Grosor de línea
      contexto.lineWidth = 3;
      // Color de línea
      contexto.strokeStyle = "blue";
      // Comenzamos en
      contexto.moveTo(num1, num2);
      // Hacemos una línea hasta
      contexto.lineTo(num3, num4);
      contexto.stroke(); // "Guardar" cambios
    },
  },
  mounted() {
    // Recuperar Mascotas
  },
};
</script>


