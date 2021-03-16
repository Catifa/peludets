<style>
#buscador {
  border-bottom: solid 1px #ccc;
}

.form-select {
  border: 0px;
  outline: 0px;
  background-color: #f8fafc;
}

.col-md-2 {
  width: 0;
  flex-shrink: 1;
  transition: all 400ms ease;
}

.col-md-3,
.col-md-4,
.col-md-5,
.col-md-6 {
  flex-grow: 1;
  transition: all 400ms ease;
}
.profesionales,
.sitios,
.ofertas {
  display: none;
}
</style>

<template>
  <div class="cotainer-fluid">
    <div class="row">
      <div id="buscador" class="navbar col-md-2 container">
        <div class="row col-md-12">
          <div id="category" class="col-md-7 mx-auto row">
            <p class="mb-0">Categoria</p>
            <select
              v-model="category"
              class="form-select px-0 col-md-12"
              @change="menu()"
            >
              <option>Oferta</option>
              <option>Profesionales</option>
              <option>Sitios de interes</option>
            </select>
          </div>
          <div class="profesionales col-md-3 mx-auto row">
            <p class="mb-0">Tipo Prof</p>
            <select v-model="tipoProf" class="form-select px-0 col-md-12">
              <option>Oferta</option>
              <option>Profesionales</option>
              <option>Sitios de interes</option>
            </select>
          </div>
          <div class="profesionales col-md-3 mx-auto row">
            <p class="mb-0">Disponibilidad</p>
            <select
              v-model="disponibilidadProf"
              class="form-select px-0 col-md-12"
            >
              <option>Telematico</option>
              <option>Presencial</option>
            </select>
          </div>
          <div class="sitios col-md-3 mx-auto row">
            <p class="mb-0">Tipo</p>
            <select v-model="tipoInteres" class="form-select px-0 col-md-12">
              <option>Tienda</option>
              <option>Parque</option>
            </select>
          </div>
          <div class="sitios col-md-3 mx-auto row">
            <p class="mb-0">Localización</p>
            <select
              v-model="localizacionInteres"
              class="form-select px-0 col-md-12"
            >
              <option>España</option>
              <option>Mi España</option>
              <option>La España</option>
            </select>
          </div>
          <div id="submit" class="btn col-md-3 disabled">Search</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    menu() {
      switch (this.category) {
        case "Sitios de interes":
          this.sitios();
          break;
        case "Profesionales":
          this.profesionales();
          break;
      }
    },
    sitios() {
      this.hideAll();
      document.getElementById("submit").className = "btn col-md-2";
      document.getElementById("buscador").className =
        "navbar col-md-4 container";
      document.getElementById("category").className = "col-md-3 mx-auto row";
      $(".sitios").show();
    },
    profesionales() {
      this.hideAll();
      document.getElementById("submit").className = "btn col-md-2";
      document.getElementById("buscador").className =
        "navbar col-md-4 container";
      document.getElementById("category").className = "col-md-3 mx-auto row";
      $(".profesionales").show();
    },
    hideAll() {
      $(".oferta").hide();
      $(".sitios").hide();
      $(".profesionales").hide();
    },
  },
};
</script>
