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
        v-if="contactos"
      >
        <div class="col-12 p-0">
          <ul class="list-group">
            <li
              class="list-group-item d-flex justify-content-between align-items-center"
              @click="contactosToChat()"
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
      </div>
      <!-- Zona Mensajes -->
      <chat v-if="chat"></chat>
    </transition>
    <!-- Barra chat nombre -->
    <div
      class="col-lg-2 fixed-bottom ml-auto mr-3"
      style="background-color: red"
    >
      <div
        class="row"
        @click="
          hideShowContactos();
          getContactos();
        "
      >
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
      //socketIO: socket("https://peludets.ddns.net:1337"),
      room: {},
      contactos: false,
      chat: false,
      contactosArray: [],
    };
  },
  methods: {
    getContactos() {
      if (this.contactos) {
        Api()
          .post("/contactos/get")
          .then((r) => {
            this.contactosArray = r.data;
            console.log(this.contactosArray);
          });
      }
    },
    contactosToChat() {
      this.chat = true;
      this.contactos = false;
      this.socketIO.emit("room", this.room);
    },
    hideShowContactos() {
      if (this.chat === true || this.contactos === true) this.contactos = false;
      else if (this.contactos === false && this.chat === false)
        this.contactos = true;
      this.chat = false;
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
            idDestinatario: String(this.$route.params.id),
          };
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