
<style>
@import "../../css/perfil.css";
</style>

<template>
  <div class="row mt-4">
    <div class="col-9 mt-2">
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
            id="mascota-tab"
            data-toggle="tab"
            href="#mascota"
            role="tab"
            aria-controls="mascota"
            aria-selected="false"
            >Mascotas</a
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

        <li class="nav-item">
          <a
            class="nav-link"
            id="edita-tab"
            data-toggle="tab"
            href="#tareas"
            role="tab"
            aria-controls="tareas"
            aria-selected="false"
            >Tareas</a
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
            <editorPerfil></editorPerfil>
          </div>
        </div>
        <div
          class="tab-pane fade"
          id="mascota"
          role="tabpanel"
          aria-labelledby="mascota-tab"
        >
          <div class="row mt-5">
            <button
              type="button"
              class="btn btn-azul-peludets ml-5"
              data-toggle="modal"
              data-target="#form-registroMascota"
            >
              Añade tu mascota
            </button>
          </div>

          <div class="row">
            <div
              class="col-md-3 mt-3"
              v-for="mascota in mascotas"
              :key="mascota.id"
            >
              <div class="card" style="width: 18rem" name="mascotas">
                <img
                  v-bind:src="mascota.photo"
                  class="card-img-top"
                  width="286px"
                  height="286px"
                  alt="..."
                />
                <div class="card-body bg-crema-peludets">
                  <h5 class="card-title">{{ mascota.nombre }}</h5>
                  <ul>
                    <li>{{ mascota.especie }}</li>
                    <li>{{ mascota.raza }}</li>
                    <li>{{ mascota.edad }}</li>
                    <li>{{ mascota.peso }}</li>
                  </ul>
                  <a
                    href="javascript:void(0)"
                    id=""
                    class="fas fa-cog"
                    aria-hidden="true"
                    data-toggle="modal"
                    data-target="#form-updateMascota"
                    @click="modalMascota(mascota)"
                  ></a>
                  <a
                    href="javascript:void(0)"
                    id=""
                    class="fas fa-trash ml-3"
                    aria-hidden="true"
                    @click="deleteMascota(mascota.id)"
                  ></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- Modal -->
          <div id="form-registroMascota" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <div class="container-fluid">
                    <div class="col-md-12">
                      <h4 class="modal-title">Añade a tu Mascota</h4>
                    </div>
                  </div>
                </div>
                <div class="modal-body">
                  <form action method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                      <label for class="form-label">Nombre</label>
                      <input
                        type="text"
                        v-model="mascota.nombre"
                        class="form-control"
                        aria-describedby="emailHelp"
                      />
                    </div>
                    <div class="mb-3">
                      <label for class="form-label">Especie</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="mascota.especie"
                        aria-describedby="emailHelp"
                      />
                    </div>
                    <div class="mb-3">
                      <label for class="form-label">Raza</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="mascota.raza"
                        aria-describedby="emailHelp"
                      />
                    </div>
                    <div class="mb-3">
                      <label for class="form-label">Edad</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="mascota.edad"
                        aria-describedby="emailHelp"
                      />
                    </div>
                    <div class="mb-3">
                      <label for class="form-label">Peso</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="mascota.peso"
                        aria-describedby="emailHelp"
                      />
                    </div>

                    <div id="divFileMascota" class="mb-3 btn btn-azul-peludets">
                      <label id="textoFile" for
                        >Añade la foto de tu mascota</label
                      >
                      <input type="file" id="file" @change="file($event)" />
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button
                    id="btn-registroMascota"
                    @click="registerMascota()"
                    class="btn btn-azul-peludets"
                  >
                    Registrala!
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <!-- Modal -->
          <modalUpdateMascota :propMascota="mascota" id="modalMascota"></modalUpdateMascota>
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
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
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
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
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
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
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
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
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
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
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
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div
          class="tab-pane fade"
          id="tareas"
          role="tabpanel"
          aria-labelledby="edita-tab"
        >
          <Tareas></Tareas>
        </div>
      </div>
    </div>
    <div class="col-xs-12 mt-5 ml-5">
      <ZonaPerfil></ZonaPerfil>
    </div>
  </div>
</template>

<script>
import Tareas from "./Tareas";
import Swal from "sweetalert2";
import ZonaPerfil from "./templates/ZonaPerfil.vue";
import editorPerfil from "./components-subparts/perfil-subparts/editablePerfil";
import Perfil_Modal_Update_Mascotas from "./components-subparts/Perfil_Modal_Update_Mascotas";
export default {
  components: {
    Tareas,
    ZonaPerfil,
    editorPerfil,
    modalUpdateMascota: Perfil_Modal_Update_Mascotas,
  },
  name: "panel",
  data() {
    return {
      mascota: {},
      img: {},
      mascotas: [],
    };
  },
  methods: {
    modalMascota(mascota) {
      this.mascota = mascota;
    },

    deleteMascota(id) {
      console.log(id);
      this.axios
        .post("api/mascota/deleteMascota", { id })
        .then((response) => {
          Swal.fire("Mascota eliminada", "success");
        })
        .catch((error) => console.log(error))
        .finally(() => (this.loading = false));
    },
    registerMascota() {
      this.mascota.userId = this.$root.user.id;
      this.mascota.img = this.img;
      this.axios
        .post("api/mascota/registerMascota", this.mascota)
        .then((response) => {
          $("#form-registroMascota").modal("hide");
          Swal.fire("Registro completado", "success");
        })
        .catch((error) => console.log(error))
        .finally(() => (this.loading = false));
    },
    file(e) {
      var formData = new FormData();
      var file = e.target.files[0];
      formData.append("Filedata", file);
      var t = file.type.split("/").pop().toLowerCase();
      if (t != "jpeg" && t != "jpg" && t != "png") {
        alert("Seleccione un formato de imágen válido: (jpeg, jpg, png)");
        document.getElementById("file").value = "";
        return false;
      }
      if (file.size > 1024000) {
        alert("Tamaño de imágen máximo (1MB)");
        document.getElementById("file").value = "";
        return false;
      }

      let f = e.target.files[0];
      let reader = new FileReader();

      reader.onloadend = () => {
        this.img = reader.result;
      };

      reader.readAsDataURL(f);
    },
  },

  mounted() {
    this.axios.post("/api/mascota/recuperarMascota").then((response) => {
      this.mascotas = response.data;
      console.log(response.data);
    });
  },
};
</script>
