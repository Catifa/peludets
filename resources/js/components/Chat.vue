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
            <div id="videoContainer" class="modal-body">

            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-success"
                @click="iniciarVideollamada"
              >
                <i class="fas fa-phone"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fas fa-phone-slash"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import swal from "sweetalert2";
import getusermedia from 'getusermedia';

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
      selectedDevice: undefined, // Dispositivos encontrados
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

    // Peticion de desconexion
    this.socketIO.on("disconected");

    // Peticion para recuperar el registro de chat
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
        this.socketIO.emit("chat message", (this.propRoom, this.mensaje));
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

    // Iniciar videollamada
    iniciarVideollamada() {
      // Variable donde se guardará la lista de todos los dispositivos conectados. (No los aceptados)
      let availableDevices = {};

      // Comprobar que el navegador es compatible con la API mediaDevices
      if (!this.checkMediaDevicesAPI) {
        Swal.fire({
          icon: "error",
          title: "Navegador no compatible",
          text:
            "Parece ser que tu navegador no es compatible con nuestras videollamadas...",
          footer:
            '<a href="https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices#browser_compatibility">Ver navegadores compatibles</a>',
        });
        return;
      }

      // Obtener una lista de los dispositivos disponibles
      navigator.mediaDevices.enumerateDevices().then((_devices) => {
          _devices.forEach((device) => {
            if (device.kind === "audioinput") {
              availableDevices.audio = true;
            } else if (device.kind === "videoinput") {
              availableDevices.video = true;
            }
          });

          // Si el dispositivo no existe, darle el valor para que no pete
          if (availableDevices.video === undefined) {
            availableDevices.video = false;
          } else if (availableDevices.audio === undefined) {
            availableDevices.audio = false;
          }
        }).then(() => {
          // Preguntar por los permisos de los dispositivos
          navigator.mediaDevices.getUserMedia({
              audio: availableDevices.audio,
              video: availableDevices.video,
            }).then((stream) => {
              // Guardar los dispositivos seleccionados
              this.selectedDevice = stream.getTracks();

              // Variable para sacar los dispositivos mas claramente
              let mediaObj = {};

              this.selectedDevice.forEach((device) => {
                if(device.kind === 'audio') {
                  mediaObj.enabledAudio = device.enabled
                } else if (device.kind === 'video') {
                  mediaObj.enabledVideo = device.enabled
                }
              });

              console.log(mediaObj);

              // Pasar a false los Undefined
              if(mediaObj.enabledAudio === undefined) {
                mediaObj.enabledAudio = false
              } else if(mediaObj.enabledVideo === undefined) {
                mediaObj.enabledVideo = false
              }

              // Obtener elemento del DOM
              let video = document.getElementById('videoContainer');

              getusermedia(
                {
                  audio: mediaObj.enabledAudio,
                  video: mediaObj.enabledVideo
                },
                function (err, stream) {
                  if(err) {
                    console.log(err);
                  } else {
                    video.srcObject = stream;
                    video.play();
                  }
                }
              );

            });
        });
    },

    checkMediaDevicesAPI() {
      return (check =
        "mediaDevices" in navigator && "getUserMedia" in navigator.mediaDevices
          ? true
          : false);
    },
  },
};
</script>