<style>
@import "../../css/chat.css";
</style>
    
<template>
  <div class="col-md-12">
    <div class="row">
      <div id="chat-box" class="col-md-12 mx-auto mt-2 p-0">
        <ul id="mensajes" class="pt-1"></ul>
      </div>
    </div>
    <div class="row">
      <form
        @submit.prevent="emitMessage"
        class="form-chat form-chat col-md-12 mx-auto"
      >
        <input v-model="mensaje" autocomplete="off" class="input-chat" />
        <button>Enviar</button>
      </form>
    </div>
  </div>
</template>

<script>

export default {
  props: ['propRoom', 'propSocket'],
  data() {
    return {
      mensaje: "",
      user: {
        id: "",
      },
      typing: false,
      socketIO: this.propSocket,
    };
  },
  created() {
    this.iniciarChat();

    // Recibir mensajes del servidor
    this.socketIO.on("chat message", (msg) => {
      console.log(msg);
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

      document.getElementById("chat-box").scrollTop = document.getElementById(
        "chat-box"
      ).scrollHeight;
    });

    this.socketIO.on("disconected", (data) => {});

    this.socketIO.on("recuperarChat", (data) => {
      console.log(data);
    });
  },
  methods: {
    // Arreglo para el horario del chat
    addZero(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    },

    // Enviar mensajes
    emitMessage() {
      if (this.mensaje.trim().length == 0) {
        this.mensaje = "";
      } else {
        this.socketIO.emit("chat message", this.mensaje);
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

        document.getElementById("chat-box").scrollTop = document.getElementById(
          "chat-box"
        ).scrollHeight;
        this.mensaje = "";
      }
    },
  }
};
</script>