<style>
@import "../../../css/perfil_tareas.css";
</style>
<template>
  <div class="container-fluid">
    <div class="row mt-2">
      <!-- Solicitudes -->
      <div class="col-lg-4 mt-3">
        <div class="col-lg-12">
          <h3 class="text-center">
            {{ $t("perfil.tareas.solicitudes") }}
          </h3>
        </div>
        <div id="cartas-trabajos">
          <div
            class="card card-trabajos bg-verde-peludets mx-auto mb-2"
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
              <button
                class="btn btn-azul-peludets btn-sm mr-3"
                @click="anadirEvento(solicitud)"
              >
                {{ $t("perfil.tareas.btnAceptar") }}
              </button>
              <button
                class="btn btn-danger btn-sm"
                @click="rechazarSolicitud(solicitud)"
              >
                {{ $t("perfil.tareas.btnRechazar") }}
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Calendario -->
      <div class="col-lg-8 mt-3">
        <full-calendar :options="calendarOptions" />
      </div>
    </div>
    <!-- Modal consulta trabajo -->
    <trabajos-modal
      id="modalListaTrabajos"
      :propConsultaSol="arrayConsultaSolicitudes"
      :propEliminarEvento="eliminarEvento"
    ></trabajos-modal>
  </div>
</template>

<script>
import Api from "../../Api";
import Trabajos_Modal from "./Perfil_Tareas_TrabajosModal";
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import caLocale from "@fullcalendar/core/locales/ca";

export default {
  components: {
    FullCalendar,
    "trabajos-modal": Trabajos_Modal,
  },
  data() {
    return {
      arraySolicitud: [],
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        headerToolbar: {
          left: 'prev',
          center: 'title',
          right: 'next'
        },
        locale: caLocale,
        dateClick: this.handleDateClick,
        events: []
      },
      arrayConsultaSolicitudes: [],
    };
  },
  methods: {
    getSolicitudes() {
      Api()
        .post("/solicitudes/getAll")
        .then((response) => {
          response.data.forEach((element) => {
            let datos = JSON.parse(element.solicitud);
            datos.id = element.id;
            // Se comprueba que si la solicitud ha sido aceptada. En el caso de serlo, se añade a los eventos del calendario.
            if (element.aceptado == "S" && element.check_final_destinatario != "S") {
              this.calendarOptions.events.push({
                id: datos.id,
                remitente: datos.idRemitente,
                title: datos.solicitud,
                date: datos.fecha,
                extendedProps: {
                  hora: datos.hora,
                  nombre: datos.nombre,
                  especia: datos.especie,
                  peso: datos.peso,
                  cp: datos.cp,
                  entregaMascota: datos.entregaMascota,
                },
              });
              // Si no ha sido aceptada se añade al arraySolicitud.
            } else if (element.aceptado == "N" || element.aceptado == null) {
              this.arraySolicitud.push(datos);
            }
          });
        });
    },

    anadirEvento(solicitud) {
      this.calendarOptions.events.push({
        id: solicitud.id,
        remitente: solicitud.idRemitente,
        title: solicitud.solicitud,
        date: solicitud.fecha,
        extendedProps: {
          hora: solicitud.hora,
          nombre: solicitud.nombre,
          especia: solicitud.especie,
          peso: solicitud.peso,
          cp: solicitud.cp,
          entregaMascota: solicitud.entregaMascota,
        },
      });

      Api().post("/solicitudes/aceptarSolicitud", solicitud);

      this.arraySolicitud.forEach((element, index) => {
        if (element.id == solicitud.id && element.date == solicitud.date) {
          this.arraySolicitud.splice(index, 1);
        }
      });
    },

    rechazarSolicitud(solicitud) {
      Api().post("/solicitudes/rechazarSolicitud", solicitud);

      this.arraySolicitud.forEach((element, index) => {
        if (element.id == solicitud.id && element.date == solicitud.date) {
          this.arraySolicitud.splice(index, 1);
        }
      });
    },

    handleDateClick(args) {
      let fechaDia = args.dateStr;
      this.calendarOptions.events.forEach((element) => {
        if (fechaDia == element.date) {
          this.arrayConsultaSolicitudes.push(element);
          $("#modalListaTrabajos").modal("show");
        }
      });
    },

    eliminarEvento(solicitud) {
      this.calendarOptions.events.forEach((element, index) => {
        if (solicitud.date == element.date && solicitud.id == element.id) {
          this.calendarOptions.events.splice(index, 1);
        }
      });
    },
  },
  mounted() {
    this.getSolicitudes();
    // Controlar cierre modal para poder poner a 0 el array
    $('#modalListaTrabajos').on('hidden.bs.modal', () => {
      this.arrayConsultaSolicitudes = [];
    });
  },
};
</script>
