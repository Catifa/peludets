export const utils = {
    // Caulcular distancia entre 2 puntos
    calcDistancia: (localizacion, posicionUsuario) => {

        var lat2 = localizacion.lat;  //Localización
        var lon2 = localizacion.lon;
        var lat1 = posicionUsuario[0];   //Usuario
        var lon1 = posicionUsuario[1];

        var R = 6371; // km 
        //has a problem with the .toRad() method below.
        var x1 = lat2 - lat1;
        var dLat = x1 * Math.PI / 180;
        var x2 = lon2 - lon1;
        var dLon = x2 * Math.PI / 180;
        var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        var d = R * c;
        return d;
    },
    // Upload Imagen
    imgUpload(e) {
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
    }
}