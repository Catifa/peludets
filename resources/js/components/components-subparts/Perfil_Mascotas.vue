<template>
  <div class="container-fluid mt-2">
    <!-- Boton añadir mascota -->
    <div class="row">
      <button
        type="button"
        class="btn btn-azul-peludets"
        @click="showAnadirMascotaModal"
      >
        {{ $t("perfil.mascotas.btnAnadirMascota") }}
      </button>
    </div>
    <!-- Tarjetas Mascotas -->
    <div id="cards-mascotas" class="row mt-2">
      <div
        class="col-lg-3 col-md-6 col-12 mt-2 card-mascotas"
        v-for="mascota in propMascotas"
        :key="mascota.id"
      >
        <div class="card" style="max-width: 540px">
          <!-- Imagen -->
          <img
            v-bind:src="mascota.photo"
            class="card-img-top"
            alt="Imatge Mascota"
          />
          <!-- Nombre -->
          <div class="card-body text-center bg-crema-peludets">
            <h5 class="card-title lila-peludets">
              {{ mascota.nombre }}
            </h5>
          </div>
          <!-- Datos Mascota -->
          <ul class="list-group list-group-flush">
            <li class="list-group-item bg-crema-peludets-suave">
              {{ $t("perfil.mascotas.cardEspecie") }}: {{ mascota.especie }}
            </li>
            <li class="list-group-item bg-crema-peludets-suave">
              {{ $t("perfil.mascotas.cardRaza") }}: {{ mascota.raza }}
            </li>
            <li class="list-group-item bg-crema-peludets-suave">
              {{ $t("perfil.mascotas.cardPeso") }}: {{ mascota.peso }} Kg
            </li>
          </ul>
          <!-- Botones -->
          <div class="card-body bg-crema-peludets">
            <!-- Boton Editar -->
            <button
              class="btn btn-lila-peludets btn-sm"
              @click="showUpdateMascotaModal(mascota)"
            >
              <i class="fas fa-cog"></i>
            </button>
            <!-- Boton Eliminar -->
            <button
              class="btn btn-lila-peludets btn-sm"
              @click="deleteMascota(mascota.id)"
            >
              <i class="fas fa-trash"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal añadir mascota -->
    <modalAnadirMascota
      id="anadirMascota"
      :propHideModal="hideAnadirMascotaModal"
      :propEspecies="especies"
      :propMascotas="propMascotas"
    ></modalAnadirMascota>
    <!-- Modal editar mascota -->
    <modalUpdateMascota 
      id="updateMascota"
      :propHideModal="hideUpdateMascotaModal"
      :propEspecies="especies"
      :propMascota="mascota"
      :propMascotas="propMascotas"
    ></modalUpdateMascota>
  </div>
</template>

<script>
import Swal from "sweetalert2";
import Api from "../../Api";
import Mascotas_AnadirModal from "./Perfil_Mascotas_Modal_AnadirMascota.vue";
import Mascotas_UpdateModal from "./Perfil_Mascotas_Modal_Update_Mascotas.vue";

export default {
  components: {
    modalAnadirMascota: Mascotas_AnadirModal,
    modalUpdateMascota: Mascotas_UpdateModal,
  },
  props: ["propMascotas"],
  data() {
    return {
      especies: undefined,
      // Variable que se le pasara al modal con la mascota
      mascota: {}
    };
  },
  methods: {
    showAnadirMascotaModal() {
      $("#anadirMascota").modal("show");
    },
    hideAnadirMascotaModal() {
      $("#anadirMascota").modal("hide");
    },
    showUpdateMascotaModal(mascota) {
      this.mascota = mascota;
      $("#updateMascota").modal("show");
    },
    hideUpdateMascotaModal() {
      $("#updateMascota").modal("hide");
    },
    deleteMascota(id) {
      Api()
        .post("/mascota/deleteMascota", { id })
        .then(() => {
          // Eliminar el objeto mascota seleccionado
          this.propMascotas.splice(
            this.propMascotas.findIndex((i) => {
              return i.id === id;
            }),
            1
          );
          Swal.fire("Mascota eliminada", "", "success");
        })
        .catch((error) => console.log(error));
    },
  },
  mounted() {
    Api()
      .get("/especie/getAll")
      .then((response) => {
        this.especies = response.data;
      });
  },
};
</script>
