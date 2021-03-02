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
        <button
          type="button"
          class="btn btn-primary"
          data-toggle="modal"
          data-target="#videoCall"
        >
          <i class="fas fa-video"></i>
        </button>
        <button>Enviar</button>
      </form>
    </div>

    <div class="row">
      <!-- Modal -->
      <div id="videoCall" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <div class="container-fluid">
                <div class="col-md-12">
                  <h4 class="modal-title">Video LLamada</h4>
                </div>
              </div>
            </div>
            <div class="modal-body">
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success"><i class="fas fa-phone"></i></button>
              <button type="button" class="btn btn-danger"><i class="fas fa-phone-slash"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["propRoom", "propSocket"],
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
    // Recibir mensajes del servidor
    this.socketIO.on("chat message", (msg) => {
      console.log(msg);
      const item = document.createElement("li");
      item.textContent = msg;

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

    this.socketIO.on("disconected");

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
  },
};
</script>