<style>
@import "../../css/home.css";
</style>

<template>
  <div style="height: 8000px"></div>
</template>
<script>
export default {
  data() {
    return {
      profesiones: [],
      profesion: {}
    };
  },
  methods: {
    buscarTrabajos() {
      let prof = this.profesion; 
      this.$router.push({name: 'profesionales', params: {prof}});
    }
  },
  created() {
    this.axios.get("api/profesiones").then(response => {
      this.profesiones = response.data;
    });
  }
};
</script>