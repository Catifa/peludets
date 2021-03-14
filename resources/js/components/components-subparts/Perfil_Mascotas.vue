<template>
  <div class="container-fluid">
    <!-- Boton añadir mascotas -->
    <div class="row mt-3">
      <div class="col-lg-2">
        <button
          type="button"
          class="btn btn-azul-peludets"
          @click="anadirMascotaModal"
        >
          {{ $t("perfil.mascotas.btnAnadirMascota") }}
        </button>
      </div>
    </div>

    <!-- Boton añadir mascotas -->
    <div class="row">
      <div class="col-md-3 mt-3" v-for="mascota in mascotas" :key="mascota.id">
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

    <!-- Modal registro mascotas-->
    <div id="registroMascota" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-azul-peludets">
            <h5 class="modal-title lila-peludets">Modal title</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Modal body text goes here.</p>
          </div>
          <div class="modal-footer bg-azul-peludets">
            <button type="button" class="btn btn-primary">Save changes</button>
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { u } from "../../utils";

export default {
  data: {},
  methods: {
    anadirMascotaModal() {
      $("#registroMascota").modal("show");
    },
  },
};
</script>

