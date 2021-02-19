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

.col-md-3, .col-md-4, .col-md-5, .col-md-6 {
  flex-grow: 1;
  transition: all 400ms ease;
}

select.oferta{
  display: none;
}
</style>

<template>
  <div class="cotainer-fluid">
    <div class="row">
      <div id="buscador" class="navbar col-md-2 container">
        <div class="row mx-auto">
          <select  class="oferta form-select col-md-7">
            <option disabled selected>Categoria</option>
            <option>Oferta</option>
            <option>Profesionales</option>
            <option>Sitios de interes</option>
          </select>
          <div class="form-select col-md-7 mr-auto row">
            <p class="mb-0">Categoria</p>
          <select v-model="category" class="form-select" @change="hola()">
            <option>Oferta</option>
            <option>Profesionales</option>
            <option>Sitios de interes</option>
          </select>
          </div>
          <button class="btn col-md-4 ml-auto">Search</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  methods: {
    hola() {
      if (this.category == "Oferta") {
      console.log("hola");
      }
      $("#buscador").toggleClass("col-md-3 col-md-2");
      $(".oferta").show();
    },
  },
};
</script>