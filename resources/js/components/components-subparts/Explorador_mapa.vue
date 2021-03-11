<template>
  <div id="mapa">
    <l-map
      :zoom="zoom"
      :center="center"
      :options="mapOptions"
    >
      <!-- Cartel abajo derecha -->
      <l-tile-layer :url="url" />
    </l-map>
  </div>
</template>

<script>
import { latLng } from "leaflet";
import { LMap, LTileLayer, LMarker, LPopup, LTooltip } from "vue2-leaflet";

export default {
  props: ['propCurrentGeoLoc'],
  watch: {
    propCurrentGeoLoc: {
      handler(val) {
        this.centerUpdate(val);
      }
    }
  },
  components: {
    LMap,
    LTileLayer,
    LMarker,
    LPopup,
    LTooltip,
  },
  data() {
    return {
      // Cosa del mapa
      zoom: 13,
      center: latLng(0, 0),
      url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      currentZoom: 11.5,
      currentCenter: undefined,
      mapOptions: {
        zoomSnap: 0.5,
      },
    };
  },
  methods: {
    centerUpdate(center) {
      this.center = center;
    }
  },
};
</script>