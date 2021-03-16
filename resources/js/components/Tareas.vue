<style>
@import "../../css/home.css";
</style>

<template>
  <div id="app" class="container mt-5">
    <div class="row">
      <div class="col-md-4 col-xs-12">
        <div class="card" style="width: 18rem" v-for="solicitud in Solicitudes" :key="solicitud.id">
          {{getContenidoSolicitud(solicitud.solicitud)}}
          <div class="card-body">
            <h5 class="card-title">Sol·licitut de {{solicitud.idRemitente}}</h5>
            <h6 class="card-subtitle mb-2 text-muted"></h6>
            <p class="card-text">
              {{contenidoSolicitud}}
            </p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
          </div>
        </div>
      </div>

      <div class="col-md-8 col-xs-12 mt-5">
        <vue-scheduler
          class="mt-5"
          :event-dialog-config="dialogConfig"
          :min-date="null"
          :max-date="null"
          :labels="{
            today: 'Hoy',
            back: 'Atrás',
            next: 'Siguiente',
            month: 'Mes',
            week: 'Semana',
            day: 'Día',
            all_day: 'Todo el día',
          }"
          :time-range="[10, 20]"
          :available-views="['month', 'week', 'day']"
          :initial-date="new Date()"
          initial-view="month"
          use12
          :show-today-button="false"
          eventDisplay="eventDisplay"
        />
      </div>
    </div>
    <!--<div class="row mt-5">      
      <div class="col-md-4 col-xs-12">
        <DragArea></DragArea>
      </div>
      <div class="col-md-8 col-xs-12">
        <DropArea></DropArea>
      </div>
    </div>-->
  </div>
</template>

<script>
import AgregarTareas from "./components-subparts/AgregarTareas";
import DragArea from "./components-subparts/DragArea";
import DropArea from "./components-subparts/DropArea";
import Api from "../Api";

export default {
  components: {
    AgregarTareas,
    DragArea,
    DropArea,
  },
  data() {
    return {
      Solicitudes: [],
      contenidoSolicitud: {},
      titulo2: "Recordatorios",
      dialogConfig: {
        title: "Tarea",
        createButtonLabel: "Save event thingy",
        enableTimeInputs: true,
        fields: [
          {
            name: "name",
            label: "Tarea",
          },
          {
            name: "Comentarios",
            type: "textarea",
            label: "Comentarios",
          },
        ],
      },
    };
  },
  methods: {
    getSolicitudes() {
      Api()
        .post("/solicitudes/getAll")
        .then((r) => {
          this.Solicitudes = r.data;
        });
    },
    getContenidoSolicitud(s){
      this.contenidoSolicitud = JSON.parse(s);
    }
  },
  mounted() {
    this.getSolicitudes();
  },
};
</script>

