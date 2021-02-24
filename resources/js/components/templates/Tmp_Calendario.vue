<template>
  <div id="my-component">
        <vue-scheduler
          class="mt-5"
          :event-dialog-config="dialogConfig"
          :min-date="null"
          :max-date="null"
          :labels="{
            back: '<',
            next: '>',
          }"
          :time-range="[0, 23]"
          :available-views="[]"
          :initial-date="new Date()"
          initial-view="month"
          use12
          :show-today-button="false"
          eventDisplay="eventDisplay"
        />
  </div>
</template>
<script>
export default {
  name: 'Tmp_Calendario' 
}
</script>
