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
            <button class="btn btn-azul-peludets btn-sm mr-3" @click="anadirEvento(solicitud)">
              {{ $t("perfil.tareas.btnAceptar") }}
            </button>
            <button class="btn btn-danger btn-sm">
              {{ $t("perfil.tareas.btnRechazar") }}
            </button>
          </div>
        </div>
      </div>
      <!-- Calendario -->
      <div class="col-lg-8">
        <full-calendar :options="calendarOptions" />
      </div>
    </div>
    <!-- Modal consulta trabajo -->
    <trabajos-modal id="modalListaTrabajos" :propConsultaSol="arrayConsultaSolicitudes" :propEliminarEvento="eliminarEvento"></trabajos-modal>
  </div>
</template>

<script>

import Api from "../../Api";
import Trabajos_Modal from './Perfil_Tareas_TrabajosModal';
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import caLocale from "@fullcalendar/core/locales/ca";

export default {
  components: {
    FullCalendar,
    'trabajos-modal': Trabajos_Modal
  },
  data() {
    return {
      arraySolicitud: [],
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        locale: caLocale,
        dateClick: this.handleDateClick,
        events: []
      },
      arrayConsultaSolicitudes: []
    };
  },
  methods: {
    getSolicitudes() {
      Api()
        .post("/solicitudes/getAll")
        .then((response) => {
          let data = response.data;
          data.forEach((element) => {
            let datos = JSON.parse(element.solicitud);
            datos.id = element.id;
            this.arraySolicitud.push(datos);
          });
        });
    },

    anadirEvento(solicitud) {
      this.calendarOptions.events.push(
        {
          id: solicitud.id,
          title: solicitud.solicitud,
          date: solicitud.fecha,
          extendedProps: {
            hora: solicitud.hora,
            nombre: solicitud.nombre,
            especia: solicitud.especie,
            peso: solicitud.peso,
            cp: solicitud.cp,
            entregaMascota: solicitud.entregaMascota
          }

        });
    },

    handleDateClick(args) {
      let fechaDia = args.dateStr;
      this.calendarOptions.events.forEach(element => {
        if(fechaDia == element.date) {
          this.arrayConsultaSolicitudes.push(element);
          $('#modalListaTrabajos').modal('show');
        }
      });
    },

    eliminarEvento(solicitud) {
      this.arrayConsultaSolicitudes.forEach((element, index) => {
        if(solicitud.date == element.date && solicitud.id == element.id) {
          this.arrayConsultaSolicitudes.splice(index, 1);
        }
      });

      let calendar = this.$parent.$parent.$refs.calsession.getApi();

      calendar.refetchEvents();
    }
  },
  mounted() {
    this.getSolicitudes();
  },
};
</script>
