<template>
  <div class="row">
    <div class="col-lg-12">
      <!-- Imagen -->
      <img
        v-bind:src="this.$root.photo"
        class="rounded img-fluid mt-5"
        width="450px"
      />
      <!-- Nombre -->
      <h3 class="lila-peludets mt-2">
        {{ this.$root.user.name }} {{ this.$root.user.lastname }}
      </h3>
      <!-- Correo -->
      <h3 class="lila-peludets">{{ this.$root.user.email }}</h3>
    </div>
  </div>
</template>
<script>
export default {
  name: "ZonaPerfil",
};
</script>