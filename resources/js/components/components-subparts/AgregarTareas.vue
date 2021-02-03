

<template>
  <div id="app" class="container mt-5">
    <h3>{{ titulo }}</h3>
    <table
      name="solicitudes"
      class="col-xs-12 col-md-12"
      v-for="solicitud in solicitudes"
      :key="solicitud"
    >
      <tr>
        <td>{{ solicitud.nombre_trabajo }}</td>
        <td>{{ solicitud.descripcion_trabajo }}</td>
      </tr>
    </table>
  </div>
</template>

<script>
import { Drag } from "vue-drag-drop";

export default {
  components: {
    drag: Drag,
  },
  name: "AgregarTareas",
  data() {
    return {
      titulo: "Solicitudes",
      solicitudes: [],
    };
  },
  methods: {},
  created() {
    this.axios.get("api/solicitudes/recuperar").then((response) => {
      this.solicitudes = response.data;
    });
  },
};
</script>

