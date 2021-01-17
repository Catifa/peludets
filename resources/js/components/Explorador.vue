<style>
@import "../../css/explorador.css";
</style>
<template>
  <div class="row">
    <mapa-exp latitudes="sitiosInteres"></mapa-exp>
    <div class="col-md-6 mt-3 mx-auto">
      <div class="row">
        <button
          class="btn btn-lila-peludets mr-2"
          id="exploradorInteres"
          type="button"
        >Sitios de interés</button>
        <button
          class="btn btn-lila-peludets"
          id="exploradorTrabajos"
          type="button"
        >Trabajos disponibles</button>
      </div>
      <div class="row mt-3">
        <div class="card-group" v-for="sitio in sitiosInteres" :key="sitio.nombre">
          <div class="card bg-light">
            <img class="card-img-top" alt="Imagen" />
            <div class="card-body">
              <p class="card-text">
                {{ sitio.nombre }}
              </p>
              <p class="card-text">
                  {{ sitio.descripcion }}
              </p>
              <p class="cart-text">
                  {{ sitio.primeraCoordenada }} - {{ sitio.segundaCoordenada }} 
              </p>
            </div>
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
                {nombre: 'Pinar de Badia', descripcion: 'Parque guapisimo para ir con el perro', primeraCoordenada: '41.50675', segundaCoordenada: '2.1136'},
                {nombre: 'Plaça 2 de Maig', descripcion: 'Parque verificado por Aitor', primeraCoordenada: '41.50971', segundaCoordenada: '2.11469'},
                {nombre: 'Parc Joan Aguilar', descripcion: 'Parque que tiene columpios', primeraCoordenada: '41.50768', segundaCoordenada: '2.11526'}
            ]
        }
    }
};
</script>
