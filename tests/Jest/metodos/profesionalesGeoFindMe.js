function geoFindMe() {
    var output = "1";

    if (!navigator.geolocation) {
      output.innerHTML =
        "<p>Geolocation is not supported by your browser</p>";
      return;
    }

}

module.exports = geoFindMe;
