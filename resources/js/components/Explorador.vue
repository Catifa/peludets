<style>
@import "../../css/explorador.css";
</style>
<template>
  <div class="row">
    <mapa-exp latitudes="sitiosInteres"></mapa-exp>
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
            <button class="btn btn-azul-peludets" type="button"> Mostrar en el mapa </button>
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
          nombre: "Pinar de Badia",
          descripcion: "Parque guapisimo para ir con el perro",
          primeraCoordenada: "41.50675",
          segundaCoordenada: "2.1136",
        },
        {
          nombre: "Plaça 2 de Maig",
          descripcion: "Parque verificado por Aitor",
          primeraCoordenada: "41.50971",
          segundaCoordenada: "2.11469",
        },
        {
          nombre: "Parc Joan Aguilar",
          descripcion: "Parque que tiene columpios",
          primeraCoordenada: "41.50768",
          segundaCoordenada: "2.11526",
        },
      ],
    };
  },
};
</script>
