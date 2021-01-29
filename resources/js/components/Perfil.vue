
<style>
@import "../../css/perfil.css";
</style>

<template>
  <div class="row mt-4">
    <div class="col-3 mt-2">
      <h3 class="crema-peludets">Peticion de contrato</h3>
      <form id="peticionTrabajo" class="rounded">
        <div class="form-group">
          <label>Tabajo</label>
          <input type="text" class="form-control" id="peticionInfoTrabajo" />
        </div>
        <div class="form-group">
          <label>Tipo de mascota</label>
          <select class="form-control" id="peticionTipoMascota">
            <option>Perro</option>
            <option>Gato</option>
            <option>Roedor</option>
            <option>Reptil</option>
            <option>Pajaro</option>
          </select>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label>Fecha Inicio</label>
              <input type="date" class="form-control" id="peticionFechaInicio" />
            </div>
            <div class="col-md-6">
              <label>Fecha Fin</label>
              <input type="date" class="form-control" id="peticionFechaFin" />
            </div>
          </div>
        </div>
        <button id="enviarPeticionTrabajo" class="btn btn-verde-peludets">Enviar</button>
      </form>
      <div class="col-md-12 mt-2">
        <h3 class="crema-peludets">Disponibilidad</h3>
        <div id="calendarioDispPerfil"></div>
      </div>
    </div>
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
          >Perfil</a>
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
          >Mascotas</a>
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
          >Valoraciones</a>
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            id="edita-tab"
            data-toggle="tab"
            href="#editaPerfilMascota"
            role="tab"
            aria-controls="editaPerfilMascota"
            aria-selected="false"
          >Edita perfil mascota</a>
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
          >Tareas</a>
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
        <div class="tab-pane fade" id="mascota" role="tabpanel" aria-labelledby="mascota-tab">
          <div class="row">
            <div class="col-md-3 mt-1 mr-2">
              <div class="card" style="width: 18rem">
                <img
                  src="sources/img/corgi1-z.jpg"
                  class="card-img-top"
                  width="286px"
                  height="286px"
                  alt="..."
                />
                <div class="card-body bg-crema-peludets">
                  <h5 class="card-title">Cacahuete</h5>
                  <ul>
                    <li>
                      <i class="fas fa-dog"></i>
                    </li>
                    <li>Corgi</li>
                    <li>3 Años</li>
                    <li>11 Kg</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-3 mt-1">
              <div class="card" style="width: 18rem">
                <img
                  src="https://img3.wikia.nocookie.net/__cb20140801151543/howtotrainyourdragon/images/9/91/Toothless_k.png"
                  class="card-img-top"
                  width="286px"
                  height="286px"
                  alt="..."
                />
                <div class="card-body bg-crema-peludets">
                  <h5 class="card-title">Toothless</h5>
                  <ul>
                    <li>
                      <i class="fas fa-dragon"></i>
                    </li>
                    <li>Night Fury</li>
                    <li>20 Años</li>
                    <li>805,585 Kg</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-3 mt-1 buttonmass">
              <a
                href
                class="fas fa-plus-circle buttonmas"
                data-toggle="modal"
                data-target="#form-registroMascota"
              ></a>
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
                        id="nombreMascota"
                        class="form-control"
                        aria-describedby="emailHelp"
                      />
                    </div>
                    <div class="mb-3">
                      <label for class="form-label">Especie</label>
                      <input
                        type="text"
                        class="form-control"
                        id="especieMascota"
                        aria-describedby="emailHelp"
                      />
                    </div>
                    <div class="mb-3">
                      <label for class="form-label">Raza</label>
                      <input
                        type="text"
                        class="form-control"
                        id="razaMascota"
                        aria-describedby="emailHelp"
                      />
                    </div>
                    <div class="mb-3">
                      <label for class="form-label">Tamaño</label>
                      <input
                        type="text"
                        class="form-control"
                        id="tamanoMascota"
                        aria-describedby="emailHelp"
                      />
                    </div>
                    <div class="mb-3">
                      <label for class="form-label">Peso</label>
                      <input
                        type="text"
                        class="form-control"
                        id="pesoMascota"
                        aria-describedby="emailHelp"
                      />
                    </div>

                    <div id="divFileMascota" class="mb-3 btn btn-azul-peludets">
                      <label id="textoFile" for>Añade la foto de tu mascota</label>
                      <input
                        name="avatarMascota"
                        type="file"
                        class="form-control btn btn-azul-peludets"
                        id="updateFotoMascota"
                      />
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button
                    id="btn-registroMascota"
                    type="submit"
                    class="btn btn-azul-peludets"
                  >Registrala!</button>
                </div>
              </div>
            </div>
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
          id="editaPerfilMascota"
          role="tabpanel"
          aria-labelledby="edita-tab"
        >
          <div class="row">
            <div class="row mt-4"></div>
            <div class="container-sm">
              <h3 class="crema-peludets">Edita los datos de tu mascota</h3>
              <form action method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for class="form-label">Nombre</label>
                  <input
                    type="text"
                    id="nombreMascota"
                    class="form-control"
                    aria-describedby="emailHelp"
                  />
                </div>
                <div class="mb-3">
                  <label for class="form-label">Especie</label>
                  <input
                    type="text"
                    class="form-control"
                    id="especieMascota"
                    aria-describedby="emailHelp"
                  />
                </div>
                <div class="mb-3">
                  <label for class="form-label">Raza</label>
                  <input
                    type="text"
                    class="form-control"
                    id="razaMascota"
                    aria-describedby="emailHelp"
                  />
                </div>
                <div class="mb-3">
                  <label for class="form-label">Tamaño</label>
                  <input
                    type="text"
                    class="form-control"
                    id="tamanoMascota"
                    aria-describedby="emailHelp"
                  />
                </div>
                <div class="mb-3">
                  <label for class="form-label">Peso</label>
                  <input
                    type="text"
                    class="form-control"
                    id="pesoMascota"
                    aria-describedby="emailHelp"
                  />
                </div>

                <div id="divFileMascota" class="mb-3 btn btn-azul-peludets">
                  <label id="textoFile" for>Añade la foto de tu mascota</label>
                  <input
                    name="avatarMascota"
                    type="file"
                    class="form-control btn btn-azul-peludets"
                    id="updateFotoMascota"
                  />
                </div>
                <br />
                <button
                  id="btn-updateMascota"
                  type="submit"
                  class="btn btn btn-azul-peludets"
                >Submit</button>
              </form>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="tareas" role="tabpanel" aria-labelledby="edita-tab">
          <Tareas></Tareas>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Tareas from "./Tareas";
import editorPerfil from "./components-subparts/perfil-subparts/editablePerfil";

export default {
  components: {
    Tareas,
    editorPerfil
  },
  name: "panel",
  data() {
    return {};
  },
  beforeCreate: function() {
    if (!this.$session.exists()) {
      this.$router.push("/");
    }
  },
  methods: {
    logout: function() {
      this.$session.destroy();
      this.$router.push("/");
    }
  }
};
</script>
