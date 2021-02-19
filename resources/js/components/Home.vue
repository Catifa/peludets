<style>
@import "../../css/home.css";
</style>

<template>
  <div class="cotainer-fluid">
    <div class="row">
      <div id="buscador" class="navbar col-md-3 container">
        <div class="row mx-auto">
            <select class="form-select col-md-7" onchange="hola()">
                <option disabled selected>Categoria</option>
                <option>Oferta</option>
                <option>Profesionales</option>
                <option>Sitios de interes</option>
            </select>
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
        console.log("hola");
        $('#buscador').toggleClass('col-md-6 col-md-4');
    },
  }
};
</script>