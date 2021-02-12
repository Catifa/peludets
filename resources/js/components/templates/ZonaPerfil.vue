<template>
  <div class="mb-2">
    <img
     v-bind:src="this.$root.photo"
      class="rounded-circle mt-5"
      width="300px"
      height="300px"
    />
    <h3 class="mt-5">{{ this.$root.user.name }}</h3>
    <h3 class="mt-5">{{ this.$root.user.email }}</h3>
  </div>
</template>
<script>
export default {
  name: "ZonaPerfil",
};
</script>