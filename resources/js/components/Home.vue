<style>
@import "../../css/home.css";
</style>

<template>
  <div class="container-fluid">
    <!-- Carousel y Formulario -->
    <div class="row">
      <!-- Carousel -->
      <div
        id="carouselCentralPldts"
        class="carousel slide col-lg-8 col-md-12 col-12"
        data-ride="carousel"
      >
        <!-- Slider Indicators -->
        <ol class="carousel-indicators">
          <li
            data-target="#carouselCentralPldts"
            data-slide-to="0"
            class="active"
          ></li>
          <li data-target="#carouselCentralPldts" data-slide-to="1"></li>
          <li data-target="#carouselCentralPldts" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner rounded">
          <!-- Slider 1 -->
          <div class="carousel-item active">
            <!-- SliderImg 1 -->
            <img
              src="../../img/carousel/slide1.jpg"
              class="d-block w-100"
              alt=""
            />
            <!-- SliderCaption 1 -->
            <div class="carousel-caption d-none d-md-block rounded">
              <h5>{{ $t("home.sliderTitulo1") }}</h5>
              <p>{{ $t("home.sliderDesc1") }}</p>
            </div>
          </div>
          <!-- Slider 2 -->
          <div class="carousel-item">
            <!-- SliderImg 2 -->
            <img
              src="../../img/carousel/slide2.jpg"
              class="d-block w-100"
              alt=""
            />
            <!-- SliderCaption 2 -->
            <div class="carousel-caption d-none d-md-block rounded">
              <h5>{{ $t("home.sliderTitulo2") }}</h5>
              <p>{{ $t("home.sliderDesc2") }}</p>
            </div>
          </div>
          <!-- Slider 3 -->
          <div class="carousel-item">
            <!-- SliderImg 3 -->
            <img
              src="../../img/carousel/slide3.jpg"
              class="d-block w-100"
              alt=""
            />
            <!-- SliderCaption 2 -->
            <div class="carousel-caption d-none d-md-block rounded">
              <h5>{{ $t("home.sliderTitulo3") }}</h5>
              <p>{{ $t("home.sliderDesc3") }}</p>
            </div>
          </div>
        </div>
        <a
          class="carousel-control-prev"
          href="#carouselCentralPldts"
          role="button"
          data-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a
          class="carousel-control-next"
          href="#carouselCentralPldts"
          role="button"
          data-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <!-- Formulario -->
      <div
        id="formTrabajos"
        class="col-lg-3 col-md-6 col-10 mt-4 mx-auto align-self-center rounded"
      >
        <div class="form-group">
          <label>{{ $t("home.formTrabajos") }}</label>
          <select class="form-control" v-model="prof">
            <option v-for="profesion in profesiones" :key="profesion.id">
              {{ profesion.nombre_profesion }}
            </option>
          </select>
        </div>
        <button
          type="submit"
          class="btn btn-lila-peludets"
          @click="buscarTrabajos"
        >
          {{ $t("home.formBotonBuscar") }}
        </button>
      </div>
    </div>
    <!-- Tarjetas Info -->
    <div class="row mt-3">
      <!-- Tarjeta 1 -->
      <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt-3">
        <div class="card">
          <img
            class="card-img-top"
            src="../../img/tarjetas_home/adiestramiento.jpg"
            height="300px"
            width="100%"
            alt="Gato"
          />
          <div class="card-body bg-crema-peludets">
            <p class="card-text">{{ $t("home.cardBox1") }}</p>
          </div>
        </div>
      </div>
      <!-- Tarjeta 2 -->
      <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt-3">
        <div class="card">
          <img
            class="card-img-top"
            src="../../img/tarjetas_home/corgiJugando.jpg"
            height="300px"
            width="100%"
            alt="Gecko"
          />
          <div class="card-body bg-crema-peludets">
            <p class="card-text">{{ $t("home.cardBox2") }}</p>
          </div>
        </div>
      </div>
      <!-- Tarjeta 3 -->
      <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt-3">
        <div class="card">
          <img
            class="card-img-top"
            src="../../img/tarjetas_home/loro.jpg"
            height="300px"
            width="100%"
            alt="Perro"
          />
          <div class="card-body bg-crema-peludets">
            <p class="card-text">{{ $t("home.cardBox3") }}</p>
          </div>
        </div>
      </div>
      <!-- Tarjeta 4 -->
      <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt-3">
        <div class="card">
          <img
            class="card-img-top"
            src="../../img/tarjetas_home/gatoLamiendose.jpg"
            height="300px"
            width="100%"
            alt="Zorro"
          />
          <div class="card-body bg-crema-peludets">
            <p class="card-text">{{ $t("home.cardBox4") }}</p>
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
      profesiones: [],
      // Adri, perdón uwu Pero tengo que crearla para que no salga un error en consola
      prof: undefined
    };
  },

  methods: {
    buscarTrabajos() {
      let prof = this.prof;
      this.$router.push({ name: "comunidad", params: { prof } });
    }
  },
  created() {
    this.axios.get("api/profesiones/getAll").then((response) => {
      this.profesiones = response.data;
    });
  },
};
</script>