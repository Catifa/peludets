<template>
  <!-- Solicitud de Paseo -->
  <div class="col-md-12">
    <!-- Datos horario -->
    <div class="row">
      <!-- Seleccion de la fecha -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="fechaSolicitud">Fecha</label>
          <input type="date" class="form-control" />
        </div>
      </div>
      <!-- Seleccion de la hora -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="horaSolicitud">Hora</label>
          <select class="form-control">
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
          <input type="text" class="form-control" placeholder="Nombre..." />
        </div>
      </div>
      <!-- Raza Mascota -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="razaMascota"> Raza de la mascota </label>
          <select class="form-control">
            <option>
            </option>
          </select>
        </div>
      </div>
      <!-- Peso Mascota -->
      <div class="col-md-12">
        <label for="pesoMascota"> Peso </label>
        <div class="row">
          <div class="col-md-3 ml-auto">
            <button type="button" class="btn btn-outline-secondary">
              0 - 5 kg
            </button>
          </div>
          <div class="col-md-3">
            <button type="button" class="btn btn-outline-secondary">
              5 - 10 kg
            </button>
          </div>
          <div class="col-md-3 mr-auto">
            <button type="button" class="btn btn-outline-secondary">
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
          <label for="codigoPostal">Codigo Postal</label>
          <input type="text" class="form-control" placeholder="CP..." />
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