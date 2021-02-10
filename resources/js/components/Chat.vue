<style>
@import "../../css/chat.css";
</style>
    
<template>
  <div id="chat-box" class="col-md-3 mx-auto mt-2 p-0">
    <ul id="mensajes" class="pt-1"></ul>
    <form @submit.prevent="emitMessage" class="form-chat">
      <input v-model="mensaje" autocomplete="off" class="input-chat" />
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
      mensaje: "",
      user: {
        name: ""
      },
      typing: false
    };
  },
  created() {
    // Recibir mensajes del servidor
    socketIO.on("chat message", msg => {
      const item = document.createElement("li");
      item.textContent = msg.message;

      let date = new Date();
      let hora =
        this.addZero(date.getHours()) + ":" + this.addZero(date.getMinutes());
      const spanHora = document.createElement("span");
      spanHora.textContent = hora;

      item.appendChild(spanHora).classList.add("horaChat", "mt-2");

      document
        .getElementById("mensajes")
        .appendChild(item)
        .classList.add("colorChatServ", "rounded-pill", "m-1", "mr-auto");

      window.scrollTo(0, document.body.scrollHeight);
      this.mensaje = "";
    });

    // Mostrar si alguien está escribiendo
    socketIO.on("typing", data => {
      this.typing = data;
    });

    // Mostrar si ha acabado de escribir
    socketIO.on("stopTyping", () => {
      this.typing = false;
    });

    socketIO.on("disconected", data => {});
  },
  methods: {
    addZero(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    },
    emitMessage() {
      socketIO.emit("chat message", this.mensaje);
      const item = document.createElement("li");
      item.textContent = this.mensaje;

      let date = new Date();
      let hora =
        this.addZero(date.getHours()) + ":" + this.addZero(date.getMinutes());
      const spanHora = document.createElement("span");
      spanHora.textContent = hora;

      item.appendChild(spanHora).classList.add("horaChat", "mt-2");

      document
        .getElementById("mensajes")
        .appendChild(item)
        .classList.add("colorChatClie", "rounded-pill", "m-1", "ml-auto");

      window.scrollTo(0, document.body.scrollHeight);
      this.mensaje = "";
    }
  },
  mounted() {
    axios.get("/api/user").then(res => {
      this.user = res.data;
      socketIO.emit("add user", this.user.name);
    });
  }
};
</script>