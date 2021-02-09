<style>

form {
  background: rgba(0, 0, 0, 0.15);
  padding: 0.25rem;
  bottom: 0;
  left: 0;
  right: 0;
  display: flex;
  height: 3rem;
  box-sizing: border-box;
  backdrop-filter: blur(10px);
}

input {
  border: none;
  padding: 0 1rem;
  flex-grow: 1;
  border-radius: 2rem;
  margin: 0.25rem;
}

input:focus {
  outline: none;
}

form > button {
  background: #333;
  border: none;
  padding: 0 1rem;
  margin: 0.25rem;
  border-radius: 3px;
  outline: none;
  color: #fff;
}

#mensajes {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

#mensajes > li {
  padding: 0.5rem 1rem;
}

.colorChat {
  color: #F3FFD4;
  background-color: #4e456de3;
}
</style>
    
<template>
  <div class="col-md-3 mx-auto mt-2">
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

socketIO.on("chat message", (msg) => {
  console.log(msg);
  const item = document.createElement("li");
  item.textContent = msg.username + ": " + msg.message;
  document.getElementById("mensajes").appendChild(item).classList.add('colorChat');
  window.scrollTo(0, document.body.scrollHeight);
});

export default {
  data() {
    return {
      mensaje: "",
      user: {
        name: '',
      },
    };
  },
  watch: {
    mensaje: (newVal, oldVal) => {
      socketIO.emit("typing");
    },
  },
  methods: {
    emitMessage() {
      socketIO.emit("chat message", this.mensaje);
      this.mensaje = "";
    },
  },
  mounted() {
    axios.get("/api/user").then((res) => {
        this.user = res.data;
        socketIO.emit("add user", this.user.name);
      });
  },
};
</script>