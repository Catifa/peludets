<template>
  <div class="container-fluid mt-2">
    <div class="row">
      <div
        class="card col-lg-5 col-12 mb-3 mr-1"
        v-for="valoracion in propValoraciones"
        :key="valoracion.id"
      >
        <div class="row no-gutters">
          <div class="col-md-3">
            <img
              :src="valoracion.photo"
              class="img-circle"
              alt="Imagen Usuario"
              width="100%"
            />
          </div>
          <div class="col-md-9">
            <div class="card-body">
              <h5 class="card-title">
                {{ valoracion.name }} {{ valoracion.lastname }}
              </h5>
              <p class="card-text">
                {{ valoracion.valoraciones }}
              </p>
              <p class="card-text">
                <small class="text-muted">
                  <div
                    class="ml-4"
                    style="float: left"
                    v-for="i in valoracion.puntuacion"
                    :key="i"
                  >
                    <i class="fas fa-star"></i></div
                ></small>
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
  props: {
    propValoraciones: { type: Array },
  },
  data() {
    return {};
  },
};
</script>