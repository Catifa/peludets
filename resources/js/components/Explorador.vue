<style>
@import "../../css/explorador.css";
</style>
<template>
  <div class="row">
    <mapa-exp :props="sitioMapa"></mapa-exp>
    <div class="col-md-6 mt-3 mx-auto">
      <div class="row">
        <button class="btn btn-azul-peludets mr-2" type="button">
          Sitios de interés
        </button>
        <button class="btn btn-azul-peludets" type="button">
          Trabajos disponibles
        </button>
      </div>
      <div class="row mt-3">
        <div
          class="card bg-crema-peludets"
          v-for="sitio in sitiosInteres"
          :key="sitio.nombre"
        >
          <img class="card-img-top" alt="Imagen" />
          <div class="card-body">
            <h5 class="card-title">{{ sitio.nombre }}</h5>
            <p class="card-text">
              {{ sitio.descripcion }}
            </p>
            <button class="btn btn-azul-peludets" type="button" @click="enviarMapa(sitio)"> Mostrar en el mapa </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  data() {
    return {
      sitiosInteres: [
        {
          nombre: "Parc de Can grocs",
          descripcion: "Parque guapisimo para ir con el perro",
          latLng: L.latLng(41.51076, 2.11969),
          center: [41.51076, 2.11969]
        },
        {
          nombre: "Parc Valles Central",
          descripcion: "Parque verificado por Aitor",
          latLng: L.latLng(41.52103, 2.1121),
          center: [41.52103, 2.1121]
        },
        {
          nombre: "Aiguestortes",
          descripcion: "Esta lejos, pero mola",
          latLng: L.latLng(42.5719, 0.9425),
          center: [42.5719, 0.9425]
        },
      ],
      sitioMapa: {}
    };
  },
  methods: {
    enviarMapa(obj) {
      this.sitioMapa = obj.latLng;
    }
  }
};
</script>
