

<template>
  <div id="app" class="container mt-5">
    <h3>{{ titulo }}</h3>
    <div
      name="solicitudes"
      class="col-xs-12 col-md-12"
      v-for="solicitud in solicitudes"
      :key="solicitud"
    >
      <div class="d-flex justify-content-between align-items-center mt-4">
        <div>
          {{ solicitud.nombre_trabajo }}
        </div>
        <div>{{ solicitud.descripcion_trabajo }}</div>
             <div>
              <button class="btn btn-success btn-sm" >Agregar</button>
              <button class="btn btn-danger btn-sm" >Eliminar</button>
            </div>
      </div>
    </div>
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

