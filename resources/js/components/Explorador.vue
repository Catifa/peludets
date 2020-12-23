<template>
  <div>
    <h1>Explorador (Prueba Mostrar mascotas)</h1>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Especie</th>
          <td>Raza</td>
          <td>Edad</td>
          <td>Peso</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="mascota in mascotas" :key="mascota.id">
          <td>{{ mascota.id }}</td>
          <td>{{ mascota.nombre }}</td>
          <td>{{ mascota.especie }}</td>
          <td>{{ mascota.raza }}</td>
          <td>{{ mascota.edad }}</td>
          <td>{{ mascota.peso }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return { mascotas: [] }
  },
  created() {
    this.axios.get('http://localhost:80/api/mascotas').then(response => {
      this.mascotas = response.data;
    });
  }
};
</script>