<template>
<div class="row">
<div class="row col-md-12 col-xs-12">
    <div class="col-md-12 col-xs-12">
        <p style=" text-align: center; font-size: 60px; color:rgb(243, 174, 26) ">Busca Toby, Busca!</p>
    </div>
</div>
<div class="row col-md-12 col-xs-12">
    <div class="col-md-1 col-xs-12"> </div>
    <div class="col-md-2 col-xs-12">
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
        <button  id="tarjeta" class="btn btn-block btn-lg btn-pelu-naranja  mt-4 " value="trabajos" name="trabajos">Buscar trabajos</button>
    </div>
    <div class="col-md-2 col-xs-12 ">
        <a href="javascript:Alternar(flotante);" class="quitarSubrayado"><button type="button" class="btn btn-block btn-lg btn-dark mt-4">Mostrar / Ocultar Mapa</button></a>
    </div>
    <div class="col-md-1 col-xs-12"> </div>
</div>
<div class="row mt-3 ">
    <div class="col-md-6 col-xs-12 mt-4" id="flotante" style="display:none"><iframe src="https://www.google.com/maps/d/embed?mid=17xf3LHMIkTtpIPJFl85w764Is7dAkxAX" width="100%" height="480"></iframe></div>
    <!-- Seccion de Lugares Favoritors (recuadros) -->
    <!-- Cartas trabajos -->
    
     <div id="cards" class="row col-md-12 col-xs-12">
</div>
    

</div>



<!---TEMPLATE DE LAS CARTAS DE PROFESIONALES-->

<div id="templates" name="profesionales" class="row col-md-12 col-xs-12" v-for="usuario in usuarios" :key="usuario.dni">
    <div class="card border border-dark col-md-2 mt-2 ml-2 id" mierda_Aitor="id">
    <a href="#" class="stretched-link id" >Ver Perfil </a>
        <img class="card-img-top foto" src="resources/img/carousel/slide1.jpg" height="50%" width="50%">
       
        <div class="card-body">                           
                <h6 class="card_name card_attr">erick{{usuario.nombre}}</h6>
                <h6 class="card_surname card_attr"><p>  esta </p>{{usuario.apellido}}</h6>
                <h6 class="card_age card_attr">aqui</h6>
        </div>
    </div>
</div>

</div>

</template>

  
<script languague="javascript">
    function Alternar(flotante) {
        if (flotante.style.display == "none") {
            flotante.style.display = ""
        } else {
            flotante.style.display = "none"
        }
    }
</script>

<script>
    export default {
        data() {
            return {
                usuarios: []
            }
        },
        created() {
            this.axios
                .get('http://localhost/api/usuario/select')
                .then(response => {
                    this.usuarios = response.data;
                });
        },
        methods: {
             usuariosFiltrados(profesiones, disponibilidad, titulacion) {
                this.axios
                    .get(`http://localhost:8000/api/book/delete/${profesiones}, ${disponibilidad}, ${titulacion}`)
                    .then(response => {
                    this.usuarios = response.data;
                });
            }
        }
    }
</script>
