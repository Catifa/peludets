<style>
@import "../../css/explorador.css";
</style>
<template>
<div class="row">
  <Mapa />
  <div class="col-md-6 mt-3 mx-auto">
        <div class="row">
            <button class="btn btn-lila-peludets mr-2" id="exploradorInteres" type="button">Sitios de interés</button>
            <button class="btn btn-lila-peludets" id="exploradorTrabajos" type="button">Trabajos disponibles</button>
        </div>
        <div class="row mt-3">
            <div class="card-group">
                <div class="card bg-light">
                    <img class="card-img-top" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
                <div class="card bg-light">
                    <img class="card-img-top" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
                <div class="card bg-light">
                    <img class="card-img-top" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Mapa from './components-subparts/Explorador_mapa.vue';
export default {
  name: 'App',
  components: {
    Mapa
  }
};
</script>
