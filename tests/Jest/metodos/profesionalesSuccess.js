

function success() {
    var latitude = 45;
    var longitude = 13;

   
      "<p>Latitude is " +
      latitude +
      "° <br>Longitude is " +
      longitude +
      "°</p>";

    var img = new Image();
    
      "http://maps.googleapis.com/maps/api/staticmap?center=" +
      latitude +
      "," +
      longitude +
      "&zoom=13&size=300x300&sensor=false";

  }
  module.exports = success;
