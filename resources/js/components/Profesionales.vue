<template>
  <div>
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <p style="text-align: center; font-size: 60px; color: rgb(243, 174, 26)">Busca Toby, Busca!</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2 ml-auto col-xs-12">
        <div class="form-group m-2">
          <label for="exampleFormControlSelect1">Profesiones</label>
          <select name="selectOption" class="form-control" id="selectOption">
            <option value="Psicologo">Psicologo</option>
            <option value="Entrenador">Entrenador</option>
            <option value="Peluquero">Peluquero</option>
          </select>
        </div>
      </div>
      <div class="col-md-2 col-xs-12">
        <div class="form-group m-2">
          <label for="exampleFormControlSelect1">Disponibilidad</label>
          <select name="selectOption2" class="form-control" id="exampleFormControlSelect2">
            <option value="Presencial">Presencial</option>
            <option value="Online">Online</option>
            <option value="Presencial y Online">Presencial y Online</option>
          </select>
        </div>
      </div>
      <div class="col-md-2 col-xs-12">
        <div class="form-group m-2">
          <label for="exampleFormControlSelect1">¿Titulación?</label>
          <select name="selectOption3" class="form-control" id="exampleFormControlSelect1">
            <option value="Si">Si</option>
            <option value="No">No</option>
          </select>
        </div>
      </div>
      <div class="col-md-2 col-xs-12">
        <button
          id="tarjeta"
          class="btn btn-block btn-lg btn-lila-peludets mt-4"
          value="trabajos"
          name="trabajos"
          @click="mostrarTarj"
        >Buscar Profesionales</button>
      </div>
      <div class="col-md-2 mr-auto col-xs-12">
        <button type="button" class="btn btn-block btn-lg btn-lila-peludets mt-4" @click="geoFindMe">Cerca de ti</button>
        <div id="out" class="col-md-12 mt-3"></div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-6 col-xs-12" id="flotante">
        <mapa-prof></mapa-prof>
      </div>
      <div id="cards" v-if="enseña" class="col-md-6 mt-4 col-xs-12">
      <div
        name="profesionales"
        class="col-md-4"
        v-for="usuario in usuarios"
        :key="usuario"
      >
        <div class="card border border-dark mt-4 ml-2 id">
          <img
            class="card-img-top foto"
            src="/resources/img/tarjetas_home/perro-paseando.jpg"
            height="50%"
            width="50%"
          />
          <br />
          <br />
          <div class="card-body">
            <h6 class="card_name card_attr">{{ usuario.nombre }}</h6>
            <h6 class="card_surname card_attr">{{ usuario.apellido }}</h6>
            <a href="#" class="stretched-link id">Ver Perfil</a>
          </div>
        </div>
      </div>
    </div>
    </div>
    <!-- Seccion de Lugares Favoritors (recuadros) -->
    <!-- Cartas trabajos -->
    
    <!---TEMPLATE DE LAS CARTAS DE PROFESIONALES-->
  </div>
</template>

<script>
export default {
  data() {
    return {
      usuarios: [{ nombre: "Pol", apellido: "Prats" },
      { nombre: "Adrian ", apellido: "Sanchez" }
      , { nombre: "Carlos", apellido: "Marchena" }
      , { nombre: "Erick", apellido: "Aciego" }
      , { nombre: "Aitor", apellido: "Lopez" }
      , { nombre: "Oscar", apellido: "Montoya" }],
      enseña: false
    };
  },
  methods: {
    usuariosFiltrados(profesiones, disponibilidad, titulacion) {
      this.axios
        .get(
          `http://localhost:8000/api/book/delete/${profesiones}, ${disponibilidad}, ${titulacion}`
        )
        .then(response => {
          this.usuarios = response.data;
        });
    },
    mostrarTarj() {
      this.enseña = true;
    },
    geoFindMe() {
      var output = document.getElementById("out");

      if (!navigator.geolocation) {
        output.innerHTML =
          "<p>Geolocation is not supported by your browser</p>";
        return;
      }

      function success(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        output.innerHTML =
          "<p>Latitude is " +
          latitude +
          "° <br>Longitude is " +
          longitude +
          "°</p>";

        var img = new Image();
        img.src =
          "http://maps.googleapis.com/maps/api/staticmap?center=" +
          latitude +
          "," +
          longitude +
          "&zoom=13&size=300x300&sensor=false";

        output.appendChild(img);
      }

      function error() {
        output.innerHTML = "Unable to retrieve your location";
      }

      output.innerHTML = "<p>Locating…</p>";

      navigator.geolocation.getCurrentPosition((success, error));
    }
  }
};
</script>
