<template>
  <div class="col-md-5 mt-3 mx-auto" id="mapa">
    <button v-on:click="mostrarMapa" class="btn btn-lila-peludets">
       Mapa
    </button>
  </div>
</template>

<script>
import { latLng } from "leaflet";
import { LMap, LTileLayer, LMarker, LPopup, LTooltip } from "vue2-leaflet";

export default {
  name: "MapaExplorador",
  components: {
    LMap,
    LTileLayer,
    LMarker,
    LPopup,
    LTooltip,
  },
  data() {
    return {
      zoom: 15,
      center: latLng(41.5105, 2.1158),
      url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      attribution:
        '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
      currentZoom: 11.5,
      currentCenter: latLng(41.5105, 2.1158),
      marker: [41.5568, 2.5558],
      showParagraph: false,
      mapOptions: {
        zoomSnap: 0.5,
      },
      showMap: true,
      propTexto: { val: true, texto: "Mostrar" }
    };
  },
  methods: {
    mostrarMapa: (this) => {
      this = !this;
      if (this) {
        let propTexto = { val: showMap, texto: "Mostrar" };
        console.log(propTexto);
        return propTexto;
      } else {
        let propTexto = { val: showMap, texto: "Ocultar" };
        console.log(propTexto);
        return propTexto;
      }
    },
  },
};
</script>