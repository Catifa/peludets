<template>
  <!-- Solicitud de Psicologo -->
  <div class="col-md-12">
    <!-- Datos horario -->
    <div class="row">
      <!-- Seleccion de la fecha -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="fechaSolicitud">Fecha</label>
          <input type="date" class="form-control" v-model="propTrabajo.fecha" />
        </div>
      </div>
      <!-- Seleccion de la hora -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="horaSolicitud">Hora</label>
          <select class="form-control" v-model="propTrabajo.hora">
            <option v-for="hora in horas" :key="hora">
              {{ hora }}
            </option>
          </select>
        </div>
      </div>
    </div>
    <!-- Datos Mascota -->
    <div class="row">
      <!-- Nombre Mascota -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="nombreMascotaSolicitud"> Nombre de la mascota </label>
          <input type="text" class="form-control" placeholder="Nombre..." v-model="propTrabajo.nombre" />
        </div>
      </div>
      <!-- Raza Mascota -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="razaMascota"> Raza de la mascota </label>
          <select class="form-control" v-model="propTrabajo.especie">
            <option v-for="especie in especies" :key="especie.id">
              {{ especie.nombre }}
            </option>
          </select>
        </div>
      </div>
      <!-- Peso Mascota -->
      <div class="col-md-12">
        <label for="pesoMascota"> Peso </label>
        <div class="row">
          <div class="col-md-3 ml-auto">
            <button
              type="button"
              class="btn btn-outline-secondary"
              @click="activeBtn($event)"
            >
              0 - 5 kg
            </button>
          </div>
          <div class="col-md-3">
            <button
              type="button"
              class="btn btn-outline-secondary"
              @click="activeBtn($event)"
            >
              5 - 10 kg
            </button>
          </div>
          <div class="col-md-3 mr-auto">
            <button
              type="button"
              class="btn btn-outline-secondary"
              @click="activeBtn($event)"
            >
              + 10 kg
            </button>
          </div>
        </div>
      </div>
      <!-- Datos Entrenamiento Mascota -->
      <div class="col-md-12 mt-2">
        <label> Describe brevemente el problema de tu mascota </label>
        <textarea
          class="form-control"
          rows="3"
          placeholder="Miedo a ruidos fuertes, no quiere comer, etc."
          v-model="propTrabajo.textoAdicional"
        ></textarea>
      </div>
    </div>
    <!-- Datos Localización -->
    <div class="row mt-3">
      <!-- Código Postal -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="codigoPostal">Codigo Postal</label>
          <input type="text" class="form-control" placeholder="CP..." v-model="propTrabajo.cp" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["propHora", "propEspecies", 'propTrabajo'],
  data() {
    return {
      horas: this.propHora,
      especies: this.propEspecies,
    };
  },
  methods: {
    activeBtn(event) {
      $(".btn-outline-secondary").removeClass("active");
      $(event.target).addClass("active");
      this.propTrabajo.peso = event.target.innerText;
    }
  }
};
</script>