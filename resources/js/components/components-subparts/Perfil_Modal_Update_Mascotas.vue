<template>
  <div>
    <div id="form-updateMascota" class="modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <div class="container-fluid">
              <div class="col-md-12">
                <h4 class="modal-title">Modifica a tu Mascota</h4>
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
                  :placeholder="propMascota.nombre"
                />
              </div>
              <div class="mb-3">
                <label for class="form-label">Especie</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="mascota.especie"
                  aria-describedby="emailHelp"
                  :placeholder="propMascota.especie"
                />
              </div>
              <div class="mb-3">
                <label for class="form-label">Raza</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="mascota.raza"
                  aria-describedby="emailHelp"
                  :placeholder="propMascota.raza"
                />
              </div>
              <div class="mb-3">
                <label for class="form-label">Edad</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="mascota.edad"
                  aria-describedby="emailHelp"
                  :placeholder="propMascota.edad"
                />
              </div>
              <div class="mb-3">
                <label for class="form-label">Peso</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="mascota.peso"
                  aria-describedby="emailHelp"
                  :placeholder="propMascota.peso"
                />
              </div>

              <div id="divFileMascota" class="mb-3 btn btn-azul-peludets">
                <label id="textoFile" for>Añade la foto de tu mascota</label>
                <input type="file" id="file" @change="file($event)" />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              id="btn-registroMascota"
              @click="updateMascota(propMascota.id)"
              class="btn btn-azul-peludets"
            >
              Registrala!
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Swal from "sweetalert2";

export default {
  props: ["propMascota"],
  data() {
    return {
      mascota: {},
      img: {},
      mascotas: [],
    };
  },
  methods: {
    recuperarMascota() {
      this.axios.post("/api/mascota/recuperarMascota").then((response) => {
        this.mascotas = response.data;
        console.log(response.data);
      });
    },

    updateMascota(id) {
      this.mascota.userId = this.$root.user.id;
      this.mascota.img = this.img;
      this.mascota.id = id;
      console.log(this.mascota);
      this.axios
        .post("api/mascota/updateMascota", this.mascota)
        .then((response) => {
          $("#form-updateMascota").modal("hide");
          Swal.fire("Mascota modificada", "success");
          this.recuperarMascota();
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