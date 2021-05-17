<template>
  <full-calendar :options="calendarOptions" />
</template>

<script>
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import caLocale from "@fullcalendar/core/locales/ca";
export default {
  components: {
    FullCalendar
  },
  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        locale: caLocale,
        events: [],
        headerToolbar: {
          left: 'prev',
          center: 'title',
          right: 'next'
        },
        footerToolbar: {
          center: 'today'
        }
      },
    }
  }
};
</script>
