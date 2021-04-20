<template>
  <div class="container-fluid">
    <!-- Zona chat -->
    <transition name="slide-fade">
      <!-- Zona contactos -->
      <div
        class="chat-popup col-lg-2 fixed-bottom ml-auto mr-3 p-0 rounded"
        style="
          background-color: #f2e7c9;
          background-image: url('../img/logo/logo.png');
        "
        v-if="ventanaChat"
      >
        <div class="col-12 p-0" v-if="contactos">
          <ul class="list-group">
            <li
              class="list-group-item d-flex justify-content-between align-items-center"
              @click="
                contactosToChat();
                crearChat(c.id);
              "
              v-for="c in contactosArray"
              :key="c.id"
            >
              <div>
                <i class="fas fa-user"></i>
                <span class="ml-2">{{ c.name }} {{ c.lastname }}</span>
              </div>
              <span class="badge badge-primary badge-pill">14</span>
            </li>
          </ul>
        </div>
        <!-- Zona Mensajes -->
        <chat v-if="chat"></chat>
      </div>
    </transition>
    <!-- Barra chat nombre -->
    <div
      class="col-lg-2 fixed-bottom ml-auto mr-3"
      style="background-color: red"
    >
      <div class="row" @click="ventanaChat = !ventanaChat; ventanaChatFn()">
        <div class="col-lg-6">
          <span class="align-middle">
            {{ this.$root.user.name }} {{ this.$root.user.lastname }}</span
          >
        </div>
        <div class="col-lg-6 text-right">
          <span class="align-middle">
            <i class="m-1 fas fa-comments"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import socket from "./socket.io";
import Api from "./Api";
import Chat from "./components/Chat";

export default {
  components: {
    chat: Chat,
  },
  data() {
    return {
      socketIO: socket("http://peludets.ddns.net:1337"),
      room: {},
      contactos: false,
      chat: false,
      ventanaChat: false,
      contactosArray: [],
    };
  },
  methods: {
    ventanaChatFn() {
      if (this.ventanaChat) {
        this.contactos = true;
        this.chat = false;
      }
      this.getContactos;
      this.getContactos();
    },
    getContactos() {
      if (this.contactos) {
        Api()
          .post("/contactos/get")
          .then((r) => {
            this.contactosArray = r.data;
            //console.log(this.contactosArray);
          });
      }
    },
    contactosToChat() {
      this.chat = true;
      this.contactos = false;
    },
    crearChat(contactoID) {
      Api()
        .post("/chat/hashRoom", {
          idDestinatario: contactoID,
          idRemitente: this.$root.user.id,
        })
        .then((response) => {
          this.room = {
            roomName: response.data,
            idRemitente: String(this.$root.user.id),
            idDestinatario: String(contactoID),
          };
          this.socketIO.emit("room", this.room);
        });
    },
  },
  created() {
    // Comprobar si alguien le intenta meter en una room
    this.socketIO.on("invite room", (roomNode) => {
      this.room = roomNode;
      this.socketIO.emit("room", roomNode);
    });
  },
};
</script>