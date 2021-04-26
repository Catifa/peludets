  <template>
  <div class="row mt-4">
    <!-- Seccion contratacion / calendario -->
    <div class="col-xs-12 col-md-2">
      <!-- Boton contratacion -->
      <solicitud-trabajo :propUser="user"></solicitud-trabajo>
      <!-- Titulo calendario -->
      <h3 class="crema-peludets mt-5">
        {{ $t("tmpPerfil.tituloCalendario") }}
      </h3>
      <!-- Calendario -->
      <div class="mt-3">
        <tmpCalendario></tmpCalendario>
      </div>
    </div>
    <!-- Seccion Datos usuario -->
    <div class="col-xs-12 col-md-7">
      <div class="row">
        <!-- Imagen -->
        <div class="col-xs-6 col-md-4 mt-5 ml-auto">
          <img
            v-bind:src="user.photo"
            class="rounded-circle"
            alt="Peludets"
            width="200px"
            height="200px"
          />
        </div>
        <!-- Nombre -->
        <div class="col-xs-6 col-md-7 mt-2">
          <h1 class="mt-5">{{ user.name }} {{ user.lastname }}</h1>
        </div>
        <!-- Seccion SubMenu usuario -->
        <div class="col-xs-12 col-md-12 mt-5">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <!-- Perfil -->
            <li class="nav-item">
              <a
                class="nav-link active"
                id="perfilUsuario-tab"
                data-toggle="tab"
                href="#perfilUsuario"
                role="tab"
                aria-controls="perfilUsuario"
                aria-selected="true"
              >
                {{ $t("tmpPerfil.perfil") }}
              </a>
            </li>
            <!-- Valoraciones -->
            <li class="nav-item">
              <a
                class="nav-link"
                id="valoraciones-tab"
                data-toggle="tab"
                href="#valoraciones"
                role="tab"
                aria-controls="valoraciones"
                aria-selected="false"
              >
                {{ $t("tmpPerfil.valoraciones") }}
              </a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <!-- Perfil Usuario -->
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
            <!--Valoraciones-->
            <div
              class="tab-pane fade"
              id="valoraciones"
              role="tabpanel"
              aria-labelledby="valoraciones-tab"
            >
              <div
                class="container-fluid mt-5"
                v-for="valoracion in valoracionesArray"
                :key="valoracion.id"
              >
                <div
                  class="card mb-3"
                >
                  <div class="row no-gutters">
                    <div class="col-md-4">
                      <img
                        :src="valoracion.photo"
                        class="img-circle"
                        alt=""
                        width="100%"
                      />
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        <h5 class="card-title">
                          {{ valoracion.name }} {{ valoracion.lastname }}
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
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
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
      valoracionesArray: [],
    };
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
  },
  mounted() {
    // Obtener usuario al cual pertenece el perfil
    this.getUser();

    //obtiene las valoraciones de los usuarios
    setTimeout(() => {
      Api().post("/valoraciones/recuperarValoraciones", { id: this.$root.user.id }).then((response) => {
          this.valoracionesArray = response.data;
        });
    }, 1000);
  },
};
</script>