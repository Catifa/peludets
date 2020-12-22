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
              <h5>Paseos como a él le gustan</h5>
              <p>
                Nuestra comunidad conoce las mejores zonas para que tu mascota
                disfrute de un paseo agradable.
              </p>
            </div>
          </div>
          <div class="carousel-item">
            <img
              src="../../img/carousel/slide2.jpg"
              class="d-block w-100"
              alt="..."
            />
            <div class="carousel-caption d-none d-md-block">
              <h5>¿Más de una mascota?</h5>
              <p>No hay problema! Podemos ocuparnos de todas ellas.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img
              src="../../img/carousel/slide3.jpg"
              class="d-block w-100"
              alt="..."
            />
            <div class="carousel-caption d-none d-md-block">
              <h5>También hay sitio para ti, chiquitín!</h5>
              <p>
                Peludets! no es solo para perros o gatos. Tenemos sitio para
                todo tipo de mascotas.
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- Formulario Trarbajos -->
      <div class="col-md-3 col-sd-10 mt-4 mx-auto align-self-center">
        <form id="formTrabajos" class="rounded">
          <div class="form-group">
            <label class="mt-2x" for="exampleFormControlSelect1"
              >Trabajos</label
            >
            <select class="form-control" id="exampleFormControlSelect1">
              <option>Alojamiento</option>
              <option>Paseo</option>
              <option>Asesinato</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Tipo de mascora</label>
            <select class="form-control" id="exampleFormControlSelect2">
              <option>Perro</option>
              <option>Gato</option>
              <option>Hurón</option>
              <option>Loro</option>
              <option>Aitor</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Cantidad de animales</label>
            <select class="form-control" id="exampleFormControlSelect1">
              <option>1</option>
              <option>2</option>
              <option>3</option>
            </select>
          </div>
          <button
            id="buscarTrabajos"
            type="submit"
            class="btn btn-lila-peludets"
          >
            Buscar trabajos
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
              Busca un sitio donde tu mascota este agusto mientras disfrutas de
              tus vacaciones!
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
              No solo es solo para perros y gatos. Nuestra comunidad puede
              cuidar a cualquier tipo de mascota.
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
              Puedes pedir cuantos paseos y de cuanto tiempo són necesarios.
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
              Disponemos de sección de profesionales para mascotas exóticas y
              con cuidados especiales
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>