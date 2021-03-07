respuestaConsulta = "peluquero";
profesionHome = "peluquero";
showByProf= false;
usuarios={};


function userProfOnly() {

    if (respuestaConsulta= this.profesionHome) {
        this.usuarios = "ok";
        console.log(this.usuarios);
        this.showByProf = true;
        
    }else{
        this.usuarios = "Usuario no encontrado";
        showByProf= false;
    }

  };
  module.exports = userProfOnly;
