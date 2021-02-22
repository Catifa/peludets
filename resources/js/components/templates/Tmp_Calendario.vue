<template>
  <div>
    <vue-scheduler 
      :event-dialog-config="dialogConfig"
      :min-date="null"
      :max-date="null"
      :labels="{
        back: '<',
        next: '>',
      }"
      :time-range="[10, 20]"
      :available-views="[]"
      :initial-date="new Date()"
      initial-view="month"
      use24
      :show-today-button="false"
      eventDisplay="eventDisplay"
    />
  </div>
</template>