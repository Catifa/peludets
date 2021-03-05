<template>
  <div class="row mt-4">
    <div class="col-xs-12 col-md-2">
      <solicitud-trabajo :propUser="user"></solicitud-trabajo>
      <h3 class="crema-peludets mt-5">Disponibilidad</h3>
      <div class="mt-3">
        <vc-calendar></vc-calendar>
      </div>
    </div>
    <div class="col-xs-12 col-md-7">
      <div class="row">
        <div class="col-xs-6 col-md-4 mt-5 ml-auto">
          <img
            v-bind:src="user.photo"
            class="rounded-circle"
            alt="Peludets"
            width="200px"
            height="200px"
          />
        </div>
        <div class="col-xs-6 col-md-7 mt-2">
          <h1 class="mt-5">{{ user.name }} {{ user.lastname }}</h1>
          <button
            class="btn btn-lila-peludets btn-lg"
            @click="iniciarChat()"
          >
            Contacta con {{ user.name }}
          </button>
        </div>
        <div class="col-xs-12 col-md-12 mt-5">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a
                class="nav-link active"
                id="perfilUsuario-tab"
                data-toggle="tab"
                href="#perfilUsuario"
                role="tab"
                aria-controls="perfilUsuario"
                aria-selected="true"
                >Perfil</a
              >
            </li>

            <li class="nav-item">
              <a
                class="nav-link"
                id="valoraciones-tab"
                data-toggle="tab"
                href="#valoraciones"
                role="tab"
                aria-controls="valoraciones"
                aria-selected="false"
                >Valoraciones</a
              >
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div
              class="tab-pane fade show active"
              id="perfilUsuario"
              role="tabpanel"
              aria-labelledby="perfilUsuario-tab"
            >
              <div class="row">
                <div class="col-md-12 ml-2 mt-3" id="contenidoPerfil"></div>
              </div>
            </div>

            <div
              class="tab-pane fade"
              id="valoraciones"
              role="tabpanel"
              aria-labelledby="valoraciones-tab"
            >
              <div class="row">
                <div class="rounded-pill col-md-3 mt-1 mr-1 border">
                  <div class="row">
                    <div class="col-md-4 mt-1">
                      <img
                        src="sources/img/adiestrador.jpg"
                        class="rounded-circle"
                        width="75px"
                        height="75px"
                      />
                    </div>
                    <div class="col-md-8 mt-1">
                      <span>Muy buena gente de zooooona</span>
                      <div class="col-md-12 mb-2">
                        <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i> <i class="far fa-star"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="rounded-pill col-md-3 mt-1 mr-1 border">
                  <div class="row">
                    <div class="col-md-4 mt-1">
                      <img
                        src="sources/img/adiestrador.jpg"
                        class="rounded-circle"
                        width="75px"
                        height="75px"
                      />
                    </div>
                    <div class="col-md-8 mt-1">
                      <span>Muy buena gente de zooooona</span>
                      <div class="col-md-12 mb-2">
                        <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i> <i class="far fa-star"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="rounded-pill col-md-3 mt-1 border" id="valoraciones" v-if="valora" >
                  <div class="row" v-for="valoraciones
                   in valoraciones" :key="valoraciones">
                    <div class="col-md-4 mt-1">
                      <img
                        src="sources/img/adiestrador.jpg"
                        class="rounded-circle"
                        width="75px"
                        height="75px"
                      />
                    </div>
                    <div class="col-md-8 mt-1">
                      <span> {{ valoraciones.valoracion }}  </span>
                      <div class="col-md-12 mb-2">
                        <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i> <i class="far fa-star"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="rounded-pill col-md-3 mt-1 mr-1 border">
                  <div class="row">
                    <div class="col-md-4 mt-1">
                      <img
                        src="sources/img/adiestrador.jpg"
                        class="rounded-circle"
                        width="75px"
                        height="75px"
                      />
                    </div>
                    <div class="col-md-8 mt-1">
                      <span>Muy buena gente de zooooona</span>
                      <div class="col-md-12 mb-2">
                        <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i> <i class="far fa-star"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="rounded-pill col-md-3 mt-1 mr-1 border">
                  <div class="row">
                    <div class="col-md-4 mt-1">
                      <img
                        src="sources/img/adiestrador.jpg"
                        class="rounded-circle"
                        width="75px"
                        height="75px"
                      />
                    </div>
                    <div class="col-md-8 mt-1">
                      <span>Muy buena gente de zooooona</span>
                      <div class="col-md-12 mb-2">
                        <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i> <i class="far fa-star"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="rounded-pill col-md-3 mt-1 border">
                  <div class="row">
                    <div class="col-md-4 mt-1">
                      <img
                        src="sources/img/adiestrador.jpg"
                        class="rounded-circle"
                        width="75px"
                        height="75px"
                      />
                    </div>
                    <div class="col-md-8 mt-1">
                      <span>Muy buena gente de zooooona</span>
                      <div class="col-md-12 mb-2">
                        <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i> <i class="far fa-star"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-3">
      <div class="row" v-if="showChat">
        <chat :propRoom="room" :propSocket="socketIO"></chat>
      </div>
    </div>
  </div>
</template>
<script>
import socket from "../../socket.io";
import Swal from "sweetalert2";
import Chat from "../Chat.vue";
import SolicitudTrabajo from "./Tmp_Perfil_SolicitudTrabajo.vue";
import Tmp_Calendario from "./Tmp_Calendario.vue";

export default {
  components: {
    chat: Chat,
    "solicitud-trabajo": SolicitudTrabajo,
    tmpCalendario: Tmp_Calendario,
  },
  data() {
    return {
      user: {},
      solicitud: {},
      showChat: false,
      socketIO: socket("http://peludets.ddns.net:1337"),
      room: {},
    };
  },
  created() {
    // Comprobar si alguien le intenta meter en una room
    this.socketIO.on('invite room', (roomNode) => {
      this.room = roomNode;
      this.socketIO.emit('room', roomNode);
    });
  },
  methods: {

  //Recoger Valoraciones
  valoraciones() {

let objeto = {
  profesion : this.profesiones,
  disponibilidad : this.disponibilidad,
  titulacion : this.titulacion

}
     
this.axios
        .post("api/valoraciones/userByProf", objeto)
        .then(response => {
          this.usuarios = response.data
         this.ensena =true;
         console.log(response.data);
        });
    },

    getUser() {
      axios
        .post("/api/usuario/perfil", { id: this.$route.params.id })
        .then((res) => {
          if (jQuery.isEmptyObject(res.data)) {
            this.$router.push("/");
          }

          this.user = res.data[0];

          this.getContent();
        });
    },
    // Obtenerr contenido del perfil
    getContent() {
      this.axios
        .post("/api/usuario/getProfText", this.user)
        .then((response) => {
          let textVal = response.data[0];
          $("#contenidoPerfil").html(textVal.textoPerfil);
        });
    },
    // Enviar solicitud
    peticionSolicitud() {
      this.axios
        .post("/api/solicitudes/enviar", {
          nombre_trabajo: this.solicitud.nombre_trabajo,
          descripcion_trabajo: this.solicitud.descripcion_trabajo,
          id_remitente: this.$root.user.id,
          id_destinatario: this.user.id,
        })
        .then(() => {
          $("#peticionTrabajo").modal("hide");
          Swal.fire("Solicitud enviada", "success");
        })
        .catch((error) => console.log(error))
        .finally(() => (this.loading = false));
    },
    crearChat() {
      this.axios
        .post("/api/chat/hashRoom", {
          idDestinatario: this.$route.params.id,
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
    iniciarChat() {
      this.showChat = !this.showChat;
      this.socketIO.emit('room', this.room);
    }
  },
  mounted() {
    // Obtener usuario al cual pertenece el perfil
    this.getUser();
    // Asignar socket al usuario que entra a ver el perfil. Le pongo el setTimeout para que le de tiempo a vue de coger $root
    setTimeout(() => {
      this.socketIO.emit("add user", {
        id: String(this.$root.user.id),
        name: this.$root.user.name,
        lastName: this.$root.user.lastname,
      });
      this.crearChat();
    }, 1000);
  },
};
</script>
<style>
</style>