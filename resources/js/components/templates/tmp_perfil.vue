  <template>
  <div class="row mt-4">
    <div class="col-xs-12 col-md-2">
      <solicitud-trabajo :propUser="user"></solicitud-trabajo>
      <h3 class="crema-peludets mt-5"> {{ $t("MiPerfil.Titulo") }} </h3>
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
          <button class="btn btn-lila-peludets btn-lg" @click="iniciarChat()">
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
            <!--/////////////////////////////////////////////////////////////////////////////////////////-->
            <!--Valoraciones-->
            <div
              class="tab-pane fade"
              id="valoraciones"
              role="tabpanel"
              aria-labelledby="valoraciones-tab"
            >
              <div
                class="container-fluid mt-5"
                v-for="valoracion in valoraciones"
                :key="valoracion.id"
              >
                <div
                  class="card mb-3"
                  v-if="valoracion.id_usuario == $route.params.id"
                >
                  <div class="row no-gutters">
                    <div class="col-md-4">
                      <img
                        src="data:image/jpeg;base64,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"
                        class="img-circle"
                        alt=""
                        width="100%"
                      />
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        <h5 class="card-title">
                          {{ valoracion.nombre_usuario_remitente }}
                        </h5>
                        <p class="card-text">{{ valoracion.valoraciones }}</p>
                        <p class="card-text">
                          <small class="text-muted">
                            <div
                              class="ml-4"
                              style="float: left"
                              v-for="i in valoracion.puntuacion"
                              :key="i"
                            >
                              <i class="fas fa-star"></i></div
                          ></small>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--/////////////////////////////////////////////////////////////////////////////////////////-->
            <!--Valoraciones-->
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
import Api from "../../Api";

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
      socketIO: socket("https://peludets.ddns.net:1337"),
      room: {},
      valoraciones: [],
    };
  },
  created() {
    // Comprobar si alguien le intenta meter en una room
    this.socketIO.on("invite room", (roomNode) => {
      this.room = roomNode;
      this.socketIO.emit("room", roomNode);
    });
  },
  methods: {
    //Recoger Valoraciones
    valoraciones() {
      let objeto = {
        profesion: this.profesiones,
        disponibilidad: this.disponibilidad,
        titulacion: this.titulacion,
      };

      Api()
        .post("/valoraciones/userByProf", objeto)
        .then((response) => {
          this.usuarios = response.data;
          this.ensena = true;
          console.log(response.data);
        });
    },

    getUser() {
      Api()
        .post("/usuario/perfil", { id: this.$route.params.id })
        .then((res) => {
          if (jQuery.isEmptyObject(res.data)) {
            this.$router.push("/");
          }

          this.user = res.data[0];

          this.getContent();
        });
    },
    // Obtener contenido del perfil
    getContent() {
      Api()
        .post("/usuario/getProfText", this.user)
        .then((response) => {
          let textVal = response.data[0];
          $("#contenidoPerfil").html(textVal.textoPerfil);
        });
    },
    // Enviar solicitud
    peticionSolicitud() {
      Api()
        .post("/solicitudes/enviar", {
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
      Api()
        .post("/chat/hashRoom", {
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
      this.socketIO.emit("room", this.room);
    },
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

    //obtiene las valoraciones de los usuarios

    Api()
      .post("/valoraciones/recuperarValoraciones")
      .then((response) => {
        this.valoraciones = response.data;
        console.log(response.data);
      });
  },
};
</script>