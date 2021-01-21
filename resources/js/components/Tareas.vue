<style>
@import "../../css/home.css";

</style>

<template>

<div id = "app" class="container mt-5">
  <div class="row">
    <div class="col-md-4 col-xs-12">

      <AgregarTareas></AgregarTareas>

    </div>
  
    <div class="col-md-8 col-xs-12">
        <vue-scheduler :event-dialog-config="dialogConfig"
          :min-date="null"
          :max-date="null"
          :labels="{
          today: 'Hoy',
          back: 'Atrás',
          next: 'Siguiente',
          month: 'Mes',
          week: 'Semana',
          day: 'Día',
          all_day: 'Todo el día'
          }"
          :time-range="[10,20]"
          :available-views="['month', 'week', 'day']"
          :initial-date="new Date()"
          initial-view="month"
          use12          
          :show-today-button="false"
          eventDisplay="eventDisplay"
          />
    </div>
  </div>
</div> 
</template>

<script>
import AgregarTareas from './components-subparts/AgregarTareas';

  export default {
    components:{
      AgregarTareas
    },
    data() {
      return {
        dialogConfig: {
          title: 'Tarea',
          createButtonLabel: 'Save event thingy',
          enableTimeInputs: true,
          fields: [
              {
                  name: 'name',
                  label: 'Tarea'
              },
             
              
              {
                  name: 'Comentarios',
                  type: 'textarea',
                  label: 'Comentarios'
              }
          ]
        }
      }
    }
  }
</script>