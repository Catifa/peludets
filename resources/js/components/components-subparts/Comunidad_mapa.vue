<template>
  <div class="mx-auto" id="mapa">
    <button @click="showMap = !showMap" class="btn btn-lila-peludets">
      Mostrar/Ocultar Mapa
    </button>
      <l-map class="mt-3"
      v-if="showMap"
      :zoom="zoom"
      :center="center"
      :options="mapOptions"
      style="height: 90%"
      @update:center="centerUpdate"
      @update:zoom="zoomUpdate"
    >
    <l-tile-layer :url="url"></l-tile-layer>
      <l-marker :lat-lng="parquePerros">
        <l-popup>Parque guapisimo para ir con el perro</l-popup>
      </l-marker>
    </l-map>
  </div>
</template>

<script>

import { latLng } from "leaflet";
import { LMap, LTileLayer, LMarker, LPopup, LTooltip } from "vue2-leaflet";

export default {
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
      url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      attribution:
        '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
      parquePerros: latLng(41.50670, 2.11393),
      currentZoom: 11.5,
      currentCenter: latLng(41.5105, 2.1158),
      showParagraph: false,
      mapOptions: {
        zoomSnap: 0.5
      },
      showMap: true
    };
  },
  methods: {
    zoomUpdate(zoom) {
      this.currentZoom = zoom;
    },
    centerUpdate(center) {
      this.currentCenter = center;
    },
    showLongText() {
      this.showParagraph = !this.showParagraph;
    },
    innerClick() {
      alert(this.showParagraph);
    },
  },
};
</script>