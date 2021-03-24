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
        v-if="showChat"
      >
        <div class="col-12 p-0">
          <ul class="list-group">
            <li
              class="list-group-item d-flex justify-content-between align-items-center"
              @click="mensajear = !mensajear"
              v-for="c in contactos"
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
      <div
        class="chat-popup col-lg-2 fixed-bottom ml-auto mr-3 p-0 rounded"
        style="background-color: yellow"
        v-if="mensajear"
      ></div>
    </transition>
    <!-- Barra chat nombre -->
    <div
      class="col-lg-2 fixed-bottom ml-auto mr-3"
      style="background-color: red"
    >
      <div
        class="row"
        @click="
          showChat = !showChat;
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
import Api from "./Api";

export default {
  data() {
    return {
      showChat: false,
      mensajear: false,
      contactos: [],
    };
  },
  methods: {
    getContactos() {
      if (this.showChat) {
        Api()
          .post("/contactos/get")
          .then((r) => {
            this.contactos = r.data;
            console.log(this.contactos);
          });
      }
    },
  },
};
</script>