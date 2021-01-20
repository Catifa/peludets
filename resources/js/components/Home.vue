<style>
@import "../../css/home.css";
</style>

<template>
  <div>
    <div class="row">
      <!-- Carousel -->
      <div
        id="carouselCentral"
        class="carousel slide col-md-8 mt-3"
        data-ride="carousel"
      >
        <ol class="carousel-indicators">
          <li
            data-target="#carouselCentral"
            data-slide-to="0"
            class="active"
          ></li>
          <li data-target="#carouselCentral" data-slide-to="1"></li>
          <li data-target="#carouselCentral" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img
              src="../../img/carousel/slide1.jpg"
              class="d-block w-100"
              alt="..."
            />
            <div class="carousel-caption d-none d-md-block">
              <h5>{{ $t("home.sliderTitulo1") }}</h5>
              <p>{{ $t("home.sliderDesc1") }}</p>
            </div>
          </div>
          <div class="carousel-item">
            <img
              src="../../img/carousel/slide2.jpg"
              class="d-block w-100"
              alt="..."
            />
            <div class="carousel-caption d-none d-md-block">
              <h5>{{ $t("home.sliderTitulo2") }}</h5>
              <p>{{ $t("home.sliderDesc2") }}</p>
            </div>
          </div>
          <div class="carousel-item">
            <img
              src="../../img/carousel/slide3.jpg"
              class="d-block w-100"
              alt="..."
            />
            <div class="carousel-caption d-none d-md-block">
              <h5>{{ $t("home.sliderTitulo3") }}</h5>
              <p>{{ $t("home.sliderDesc3") }}</p>
            </div>
          </div>
        </div>
      </div>
      <!-- Formulario Trarbajos -->
      <div class="col-md-3 col-sd-10 mt-4 mx-auto align-self-center">
        <form id="formTrabajos" class="rounded">
          <div class="form-group">
            <label class="mt-2x" for="exampleFormControlSelect1">
              {{ $t("home.formTrabajos") }}
            </label>
            <select class="form-control" id="exampleFormControlSelect1">
              <option>{{ $t("home.formSelectTrabajos1") }}</option>
              <option>{{ $t("home.formSelectTrabajos2") }}</option>
              <option>{{ $t("home.formSelectTrabajos3") }}</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">
              {{ $t("home.formTipoMascotas") }}
            </label>
            <select class="form-control" id="exampleFormControlSelect2">
              <option> {{ $t("home.formSelectTipoMascotas1") }} </option>
              <option> {{ $t("home.formSelectTipoMascotas2") }} </option>
              <option> {{ $t("home.formSelectTipoMascotas3") }} </option>
            </select>
          </div>
          <button
            id="buscarTrabajos"
            type="submit"
            class="btn btn-lila-peludets"
          >
            {{ $t('home.formBotonBuscar') }}
          </button>
        </form>
      </div>
    </div>
    <!-- Tarjetas Info -->
    <div class="row mt-3">
      <div class="col-md-3 mt-3">
        <div class="card">
          <img
            class="card-img-top"
            src="../../img/tarjetas_home/gato-tranquilo.jpg"
            height="300px"
            width="100%"
          />
          <div class="card-body bg-crema-peludets">
            <p class="card-text">
              {{ $t('home.cardBox1') }}
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mt-3">
        <div class="card">
          <img
            class="card-img-top"
            src="../../img/tarjetas_home/gecko-feliz.jpg"
            height="300px"
            width="100%"
          />
          <div class="card-body bg-crema-peludets">
            <p class="card-text">
              {{ $t('home.cardBox2') }}
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mt-3">
        <div class="card">
          <img
            class="card-img-top"
            src="../../img/tarjetas_home/perro-paseando.jpg"
            height="300px"
            width="100%"
          />
          <div class="card-body bg-crema-peludets">
            <p class="card-text">
              {{ $t('home.cardBox3') }}
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mt-3">
        <div class="card">
          <img
            class="card-img-top"
            src="../../img/tarjetas_home/zorro-feliz.jpg"
            height="300px"
            width="100%"
          />
          <div class="card-body bg-crema-peludets">
            <p class="card-text">
              {{ $t('home.cardBox4') }}
            </p>
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
      
    };
  },
  methods: {
  
  }
};
</script>