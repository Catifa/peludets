export const utils = {
    calcDistancia: (localizacion, posicionUsuario) => {


        var lat2 = localizacion.lat;  //Localización
        var lon2 = localizacion.lon;
        var lat1 = posicionUsuario[0];   //Usuario
        var lon1 = posicionUsuario[1];

        console.log(lat2, lon2, lat1, lon1);

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
        console.log(d);
        return d;
    }
}