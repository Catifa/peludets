<template>
  <div class="col-md-5 mt-3 mx-auto" id="mapa">
    <button @click="mostrarMapa" class="btn btn-lila-peludets">{{ texto }}</button>
    <l-map
      v-if="showMap"
      class="mt-3"
      style="height: 80%"
      width="100%"
      :zoom="zoom"
      :center="center"
      @update:zoom="updateZoom"
      @update:center="updateCenter"
    >
      <l-title-layer :url="url"></l-title-layer>
      <l-marker v-for="(marker, index) in markers" :key="marker" :lat-lng="marker" :icon="icon">
        <l-icon
          :icon-size="dynamicSize"
          :icon-anchor="dynamicAnchor"
          icon-url="https://newtonvet.com/wp-content/uploads/2017/05/paw-icon.png"
        ></l-icon>
        <l-popup>{{ popups[index] }}</l-popup>
      </l-marker>
      <l-marker :lat-lng="marker" :icon="icon">
        <l-icon
          :icon-size="dynamicSize"
          :icon-anchor="dynamicAnchor"
          icon-url="https://newtonvet.com/wp-content/uploads/2017/05/paw-icon.png"
        ></l-icon>
        <l-popup>{{ popups[index] }}</l-popup>
      </l-marker>
    </l-map>
  </div>
</template>

<script>
import L from "leaflet";
import {
  LMap,
  LTileLayer,
  LMarker,
  LPopup,
  LTooltip,
  LIcon
} from "vue2-leaflet";

export default {
  name: "MapaExplorador",
  components: {
    LMap,
    LTileLayer,
    LMarker,
    LPopup,
    LTooltip,
    LIcon
  },
  props: ["props"],
  data() {
    return {
      // Ajustes Mapa
      zoom: 16,
      center: [41.50546, 2.11775],
      url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      markers: [
        L.latLng(41.50677, 2.11371),
        L.latLng(41.50601, 2.12021),
        L.latLng(41.50755, 2.11537),
        L.latLng(41.5095, 2.11505)
      ],
      popups: [
        "Parque para perros 1",
        "Parque para perros 2",
        "Parque para perros 3",
        "Parque para perros 4"
      ],
      icon: L.icon({
        iconUrl:
          "https://newtonvet.com/wp-content/uploads/2017/05/paw-icon.png",
        iconSize: [32, 37],
        iconAnchor: [16, 37]
      }),
      showMap: true,
      // Variables Vista
      texto: "Ocultar Mapa",
      markerExplorador: this.props
    };
  },
  computed: {
    dynamicSize() {
      return [this.iconSize, this.iconSize * 1.15];
    },
    dynamicAnchor() {
      return [this.iconSize / 2, this.iconSize * 1.15];
    }
  },
  methods: {
    updateZoom(zoom) {
      this.zoom = zoom;
    },
    updateCenter(center) {
      this.center = center;
    },
    mostrarMapa() {
      this.showMap = !this.showMap;
      if (this.showMap) {
        this.texto = "Ocultar Mapa";
      } else {
        this.texto = " Mostrar Mapa";
      }
    }
  }
};
</script>