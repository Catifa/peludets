<template>
  <div class="container-fluid">
    <!-- Zona chat -->
    <transition name="slide-fade">
      <!-- Zona contactos -->
      <div
        class="chat-popup col-lg-2 fixed-bottom ml-auto mr-3 p-0 rounded"
        style="background-color: green"
        v-if="showChat"
      >
        <div class="col-12 p-0">
          <ul class="list-group">
            <li
              class="list-group-item d-flex justify-content-between align-items-center"
              @click="mensajear = !mensajear"
            >
              Cras justo odio
              <span class="badge badge-primary badge-pill">14</span>
            </li>
            <li
              class="list-group-item d-flex justify-content-between align-items-center"
            >
              Dapibus ac facilisis in
              <span class="badge badge-primary badge-pill">2</span>
            </li>
            <li
              class="list-group-item d-flex justify-content-between align-items-center"
            >
              Morbi leo risus
              <span class="badge badge-primary badge-pill">1</span>
            </li>
          </ul>
        </div>
      </div>
      <!-- Zona Mensajes -->
      <div
        class="chat-popup col-lg-2 fixed-bottom ml-auto mr-3 p-0 rounded"
        style="background-color: yellow"
        v-if="mensajear"
      >
      <h1>AAAAAAAAAAAAAAAAAAAA</h1>
      </div>
    </transition>
    <!-- Barra chat nombre -->
    <div
      class="col-lg-2 fixed-bottom ml-auto mr-3"
      style="background-color: red"
    >
      <div class="row" @click="showChat = !showChat">
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
export default {
  data() {
    return {
      showChat: false,
      mensajear: false,
    };
  },
};
</script>