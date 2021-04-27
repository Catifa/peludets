<template>
  <!-- Solicitud de Peluqueria -->
  <div class="col-md-12">
    <!-- Datos horario -->
    <div class="row">
      <!-- Seleccion de la fecha -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="fechaSolicitud">
            {{ $t("tmpPerfil.solicitud.labels.fecha") }}
          </label>
          <input type="date" class="form-control" v-model="propTrabajo.fecha" :class="{ 'border-danger': propErrores.fecha !=null }" />
        </div>
      </div>
      <!-- Seleccion de la hora -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="horaSolicitud">
            {{ $t("tmpPerfil.solicitud.labels.hora") }}
          </label>
          <select class="form-control" v-model="propTrabajo.hora" :class="{ 'border-danger': propErrores.hora !=null }" >
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
          <label for="nombreMascotaSolicitud"> 
            {{ $t("tmpPerfil.solicitud.labels.nombre") }}
          </label>
          <input type="text" class="form-control" v-model="propTrabajo.nombre" :class="{ 'border-danger': propErrores.nombre !=null }" />
        </div>
      </div>
      <!-- Raza Mascota -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="razaMascota"> 
            {{ $t("tmpPerfil.solicitud.labels.raza") }}
          </label>
          <select class="form-control" v-model="propTrabajo.especie" :class="{ 'border-danger': propErrores.especie !=null }" >
            <option v-for="especie in especies" :key="especie.id">
              {{ especie.nombre }}
            </option>
          </select>
        </div>
      </div>
      <!-- Peso Mascota -->
      <div class="col-md-12">
        <label for="pesoMascota"> 
          {{ $t("tmpPerfil.solicitud.labels.peso") }}
        </label>
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
    </div>
    <!-- Datos Localización -->
    <div class="row mt-3">
      <!-- Código Postal -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="codigoPostal">
            {{ $t("tmpPerfil.solicitud.labels.cp") }}
          </label>
          <input type="text" class="form-control" v-model="propTrabajo.cp" :class="{ 'border-danger': propErrores.cp !=null }" />
        </div>
      </div>
      <!-- Recoger o entregar Mascota -->
      <div class="col-md-6 mt-4">
        <div class="form-group">
          <div class="custom-control custom-switch">
            <input
              type="checkbox"
              class="custom-control-input"
              id="switchEntrega"
              v-model="propTrabajo.entregaMascota"
            />
            <label class="custom-control-label" for="switchEntrega">
              {{ $t("tmpPerfil.solicitud.labels.entregaMascota") }}
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['propHora','propEspecies', 'propTrabajo', 'propErrores', 'propErrores'],
  data() {
    return {
      horas: this.propHora,
      especies: this.propEspecies
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