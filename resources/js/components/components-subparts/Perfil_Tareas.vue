<template>
  <div class="container-fluid">
    <div class="row mt-2">
      <!-- Solicitudes -->
      <div class="col-lg-4">
        <div
          class="card bg-verde-peludets"
          style="width: 18rem"
          v-for="solicitud in arraySolicitud"
          :key="solicitud.id"
        >
          <div class="card-header text-center">
            <h3 class="lila-peludets">
              {{ solicitud.fecha }}
            </h3>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              {{ $t("perfil.tareas.hora") }} {{ solicitud.hora }}
            </li>
            <li class="list-group-item">
              {{ $t("perfil.tareas.nombre") }} {{ solicitud.nombre }}
            </li>
            <li class="list-group-item">
              {{ $t("perfil.tareas.especie") }} {{ solicitud.especie }}
            </li>
            <li class="list-group-item">
              {{ $t("perfil.tareas.cp") }} {{ solicitud.cp }}
            </li>
            <li class="list-group-item">
              {{ $t("perfil.tareas.solicitud") }} {{ solicitud.solicitud }}
            </li>
          </ul>
          <div class="card-body text-center">
            <button class="btn btn-azul-peludets btn-sm mr-3">
              {{ $t("perfil.tareas.btnAceptar") }}
            </button>
            <button class="btn btn-danger btn-sm">
              {{ $t("perfil.tareas.btnRechazar") }}
            </button>
          </div>
        </div>
      </div>
      <div class="col-lg-8"></div>
    </div>
  </div>
</template>

<script>
import Api from "../../Api";

export default {
  data() {
    return {
      arraySolicitud: [],
    };
  },
  methods: {
    getSolicitudes() {
      Api()
        .post("/solicitudes/getAll")
        .then((response) => {
          let data = response.data;
          data.forEach((element) => {
            this.arraySolicitud.push(JSON.parse(element.solicitud));
          });
        });
    },
  },
  mounted() {
    this.getSolicitudes();
  },
};
</script>
