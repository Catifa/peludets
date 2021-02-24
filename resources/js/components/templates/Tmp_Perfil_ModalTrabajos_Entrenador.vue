<template>
  <!-- Solicitud de Entrenador -->
  <div class="col-md-12">
    <!-- Datos horario -->
    <div class="row">
      <!-- Seleccion de la fecha -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="fechaSolicitud">Fecha</label>
          <input type="date" class="form-control" v-model="propTrabajo.fecha" :class="{ 'border-danger': propErrores.fecha !=null }"/>
        </div>
      </div>
      <!-- Seleccion de la hora -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="horaSolicitud">Hora</label>
          <select class="form-control" v-model="propTrabajo.hora" :class="{ 'border-danger': propErrores.hora !=null }">
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
          <input type="text" class="form-control" placeholder="Nombre..." v-model="propTrabajo.nombre" :class="{ 'border-danger': propErrores.nombre !=null }"/>
        </div>
      </div>
      <!-- Raza Mascota -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="razaMascota"> Raza de la mascota </label>
          <select class="form-control" v-model="propTrabajo.especie" :class="{ 'border-danger': propErrores.especie !=null }">
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
        <label> Selecciona el tipo de entrenamiento </label>
        <div class="row mx-auto">
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="obedienciaBasica" name="obedienciaBasica" v-model="propTrabajo.entreno" :class="{ 'border-danger': propErrores.entreno !=null }" />
            <label class="custom-control-label" for="obedienciaBasica"> Obediencia básica </label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="habilidades" name="habilidades" v-model="propTrabajo.entreno" :class="{ 'border-danger': propErrores.entreno !=null }" />
            <label class="custom-control-label" for="habilidades"> Habilidades </label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="agility" name="agility" v-model="propTrabajo.entreno" :class="{ 'border-danger': propErrores.entreno !=null }" />
            <label class="custom-control-label" for="agility"> Agility </label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="trabajo" name="trabajo" v-model="propTrabajo.entreno" :class="{ 'border-danger': propErrores.entreno !=null }" />
            <label class="custom-control-label" for="trabajo"> Trabajo </label>
          </div>
        </div>
      </div>
    </div>
    <!-- Datos Localización -->
    <div class="row mt-3">
      <!-- Código Postal -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="codigoPostal">Codigo Postal</label>
          <input type="text" class="form-control" placeholder="CP..." v-model="propTrabajo.cp" :class="{ 'border-danger': propErrores.cp !=null }"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['propHora', 'propEspecies', 'propTrabajo', 'propErrores'],
  data() {
    return {
      horas: this.propHora,
      especies: this.propEspecies
    }
  },
  methods: {
    activeBtn(event) {
      console.log(event.target);
      $(".btn-outline-secondary").removeClass("active");
      $(event.target).addClass("active");
      this.propTrabajo.peso = event.target.innerText;
    }
  }
}
</script>