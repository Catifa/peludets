<template>
  <div class="container-fluid mt-2">
    <div class="row">
      <div
        class="card col-lg-5 col-12 mb-3 mr-1"
        v-for="valoracion in arrayValoraciones"
        :key="valoracion.valoraciones"
      >
        <div class="row no-gutters">
          <!-- Imagen -->
          <div class="col-md-3">
            <img
              :src="valoracion.photo"
              class="img-circle"
              alt="Imagen Usuario"
              width="100%"
            />
          </div>
          <!-- Datos valoracion -->
          <div class="col-md-9">
            <div class="card-body">
              <!-- Nombre -->
              <h5 class="card-title">
                {{ valoracion.name }} {{ valoracion.lastname }}
              </h5>
              <!-- Texto Valoracion -->
              <p class="card-text">
                {{ valoracion.valoraciones }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import Api from '../../Api';

export default {
  data() {
    return {
      arrayValoraciones: []
    };
  },
  mounted() {
    // Recuperar Valoraciones
    setTimeout(() => {
      Api().post("/valoraciones/recuperarValoraciones", { id: this.$root.user.id }).then((response) => {
          this.arrayValoraciones = response.data;
        });
    }, 1000);
  },
};
</script>