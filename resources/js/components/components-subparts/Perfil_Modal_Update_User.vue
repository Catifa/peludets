<template>
  <div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <!-- Titulo Modal -->
        <div class="modal-header bg-azul-peludets">
          <h5 class="modal-title lila-peludets">
            {{ $t("perfil.perfilEditable.modalUpdateUser.tituloModal") }}
          </h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Body Modal -->
        <div class="modal-body">
          <form action method="post" enctype="multipart/form-data">
            <!-- Nombre -->
            <div class="mb-3">
              <label>
                {{ $t("perfil.perfilEditable.modalUpdateUser.nombreModal") }}
              </label>
              <input
                type="text"
                class="form-control"
                v-model="user.name"
                :placeholder="$root.user.name"
              />
            </div>
            <!-- Apellido -->
            <div class="mb-3">
              <label>
                {{ $t("perfil.perfilEditable.modalUpdateUser.apellidoModal") }}
              </label>
              <input
                type="text"
                class="form-control"
                v-model="user.lastname"
                :placeholder="$root.user.lastname"
              />
            </div>
            <!-- Segundo Apellido -->
            <div class="mb-3">
              <label for="apellido">
                {{ $t("perfil.perfilEditable.modalUpdateUser.segundoApellidoModal") }}
              </label>
              <input
                type="text"
                class="form-control"
                v-model="user.secondlastname"
                :placeholder="$root.user.secondlastname"
              />
            </div>
            <!-- Correo -->
            <div class="mb-3">
              <label>
                {{ $t("perfil.perfilEditable.modalUpdateUser.correoModal") }}
              </label>
              <input
                type="text"
                class="form-control"
                v-model="user.email"
                :placeholder="$root.user.email"
              />
            </div>
            <!-- DNI -->
            <div class="mb-3">
              <label>
                DNI
              </label>
              <input
                type="text"
                class="form-control"
                v-model="user.dni"
                :placeholder="$root.user.dni"
              />
            </div>
            <!-- Foto -->
            <div id="divFileMascota" class="mb-3 btn btn-azul-peludets">
              <label>
                 {{ $t("perfil.perfilEditable.modalUpdateUser.fotoModal") }}
              </label>
              <input
                type="file"
                class="form-control-file"
                id="file"
                @change="updateImg($event)"
              />
            </div>
          </form>
        </div>
        <!-- Footer Modal -->
        <div class="modal-footer bg-azul-peludets">
          <!-- Guardar cambios -->
          <button
            @click="updateUsuario($root.user.id)"
            type="button"
            class="btn btn-azul-peludets"
          >
            {{ $t("perfil.perfilEditable.modalUpdateUser.guardarModal") }}
          </button>
          <!-- Cerrar -->
          <button
            type="button"
            class="btn btn-danger"
            data-dismiss="modal"
          >
            {{ $t("perfil.perfilEditable.modalUpdateUser.cerrarModal") }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import Swal from "sweetalert2";
import Api from '../../Api';
import { utils } from '../../utils';

export default {
  props: ["updateUser"],
  data() {
    return {
      user: undefined,
      img: {},
    };
  },
  methods: {
    recuperarUser() {
      Api().get("/user").then((response) => {
        this.user = response.data;
        this.$root.user = response.data;
        this.$root.photo = response.data.photo;
        console.log(response.data);
      });
    },

    updateUsuario(id) {
      this.user.userId = this.$root.user.id;
      this.user.img = this.img;
      this.user.id = id;
      Api()
        .post("/usuario/updateUsuario", this.user)
        .then(() => {
          Swal.fire("Usuario modificada", "success");
          this.recuperarUser()
        });
    },

    updateImg(e) {
      utils.imgUpload(e);
    }
  }
};
</script>