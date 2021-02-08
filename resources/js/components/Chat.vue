<template>
  <div class="col-md-10 mx-auto">
    <ul id="mensajes"></ul>
    <form @submit.prevent="emitMessage">
      <input v-model="mensaje" autocomplete="off" />
      <button>Enviar</button>
    </form>
  </div>
</template>

<script>
import socket from "../socket.io";

const socketIO = socket("http://peludets.ddns.net:1337");

export default {
  data() {
    return {
      mensaje: ""
    };
  },
  methods: {
    emitMessage() {
      socketIO.emit("chat message", this.mensaje);
      this.mensaje = "";
    }
  },
  mounted() {
    socketIO.emit("add user", this.$root.user.name);
  }
};
</script>