  <template>
  <!-- Solicitud de Alojamiento -->
  <div class="col-md-12">
    <!-- Datos Fecha -->
    <div class="row">
      <!-- Seleccion de la fecha de inicio de la solicitud -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="fechaInicioSolicitud">Fecha Inicio</label>
          <input type="date" class="form-control" v-model="propTrabajo.fechaInicio" />
        </div>
      </div>
      <!-- Seleccion de la fecha fin de la solicitud -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="fechaFinalSolicitud">Fecha Final</label>
          <input type="date" class="form-control" v-model="propTrabajo.fechaFinal" />
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
      <!-- Datos adicionales Mascota -->
      <div class="col-md-12 mt-2">
        <label for="datosAdicionalesMascota">
          Datos adicionales sobre la mascota
        </label>
        <textarea
          class="form-control"
          rows="3"
          placeholder="Indica si tu mascota requiere algun cuidado especial"
          v-model="propTrabajo.textoAdicional"
        ></textarea>
      </div>
      <!-- Horarios de paseo -->
      <div class="col-md-12 mt-2">
        <div class="form-group">
          <label>Horarios de paseos</label>
          <div class="row">
            <div class="col-md-4">
              <label for="horaSolicitud">Mañana</label>
              <select class="form-control" v-model="propTrabajo.horaManana">
                <option v-for="hora in horas" :key="hora">
                  {{ hora }}
                </option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="horaSolicitud">Mediodia</label>
              <select class="form-control" v-model="propTrabajo.horaTarde">
                <option v-for="hora in horas" :key="hora">
                  {{ hora }}
                </option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="horaSolicitud">Noche</label>
              <select class="form-control" v-model="propTrabajo.horaNoche">
                <option v-for="hora in horas" :key="hora">
                  {{ hora }}
                </option>
              </select>
            </div>
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
          <input type="text" class="form-control" placeholder="CP..." v-model="propTrabajo.cp" />
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
              El cliente entregará la mascota
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['propHora', 'propEspecies', 'propTrabajo'],
  data() {
    return {
      especies: this.propEspecies,
      horas: this.propHora
    }
  },
  methods: {
    activeBtn(event) {
      $(".btn-outline-secondary").removeClass("active");
      $(event.target).addClass("active");
      this.propTrabajo.peso = event.target.innerText;
    }
  }
}
</script>