<template>
  <div id="mapa">
    <l-map :zoom="zoom" :center="center" :options="mapOptions">
      <!-- Cartel abajo derecha -->
      <l-tile-layer :url="url" />
      <!-- Marcadores -->
      <l-marker
        v-for="(marker, index) in markers"
        :key="index"
        :lat-lng="marker"
        :icon="icon"
      >
        <l-icon
          :icon-size="dynamicSize"
          :icon-anchor="dynamicAnchor"
          icon-url="https://newtonvet.com/wp-content/uploads/2017/05/paw-icon.png"
        ></l-icon>
        <l-popup>
          <div class="card card-popup-map rounded" style="width: 18rem">
            <div class="card-body">
              <h5 class="card-title">{{ marker.nombre }}</h5>
            </div>
          </div>
        </l-popup>
      </l-marker>
    </l-map>
  </div>
</template>

<script>
import { latLng } from "leaflet";
import {
  LMap,
  LTileLayer,
  LMarker,
  LPopup,
  LTooltip,
  LIcon,
} from "vue2-leaflet";

export default {
  props: ["propCurrentGeoLoc", "propLocalizaciones"],
  watch: {
    propCurrentGeoLoc: {
      handler(val) {
        this.centerUpdate(val);
      },
    },
    propLocalizaciones: {
      handler(val) {
        this.mapMarkerUpdate(val);
      },
    },
  },
  computed: {
    dynamicSize() {
      return [this.iconSize, this.iconSize * 1.15];
    },
    dynamicAnchor() {
      return [this.iconSize / 2, this.iconSize * 1.15];
    },
  },
  components: {
    LMap,
    LTileLayer,
    LMarker,
    LPopup,
    LTooltip,
    LIcon,
  },
  data() {
    return {
      // Cosa del mapa
      zoom: 13,
      center: latLng(0, 0),
      url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      currentZoom: 11.5,
      mapOptions: {
        zoomSnap: 0.5,
      },
      markers: [],
      icon: L.icon({
        iconUrl:
          "https://newtonvet.com/wp-content/uploads/2017/05/paw-icon.png",
        iconSize: [32, 37],
        iconAnchor: [16, 37],
      }),
      markers: [],
      // Variables normales
    };
  },
  methods: {
    centerUpdate(center) {
      this.center = center;
    },
    mapMarkerUpdate(localizacion) {
      this.markers.push(localizacion);
    },
  },
};
</script>