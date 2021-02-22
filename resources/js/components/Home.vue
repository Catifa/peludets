<style>
.navbar {
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
.profesionales {
  display: none;
}
</style>

<template>
  <div class="cotainer-fluid">
    <div class="row">
      <div id="buscador" class="navbar col-md-2 container">
        <div class="row mx-auto">
          <div id="category" class="col-md-7 mr-auto row">
            <p class="mb-0">Categoria</p>
            <select v-model="category" class="form-select" @change="menu()">
              <option>Oferta</option>
              <option>Profesionales</option>
              <option>Sitios de interes</option>
            </select>
          </div>
          <div class="profesionales col-md-3 mr-auto row">
            <p class="mb-0">Tipo Prof</p>
            <select v-model="tipoProf" class="form-select">
              <option>Oferta</option>
              <option>Profesionales</option>
              <option>Sitios de interes</option>
            </select>
          </div>
          <div class="profesionales col-md-3 mr-1 row">
            <p class="mb-0">Disponibilidad</p>
            <select v-model="disponibilidadProf" class="form-select">
              <option>Oferta</option>
              <option>Profesionales</option>
              <option>Sitios de interes</option>
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
      if (this.category == "Oferta") {
        this.hideAll();
        document.getElementById("submit").className =
          "btn col-md-3";
        document.getElementById("buscador").className =
          "navbar col-md-3 container";
        $(".oferta").show();
      }
      if (this.category == "Profesionales") {
        this.hideAll();
        document.getElementById("submit").className =
          "btn col-md-3";
        document.getElementById("buscador").className =
          "navbar col-md-4 container";
        document.getElementById("category").className =
          "col-md-3 mr-auto row";
        $(".profesionales").show();
      }
    },
    hideAll() {
      $(".oferta").hide();
      $(".profesionales").hide();
    },
  },
};
</script>