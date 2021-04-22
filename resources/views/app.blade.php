<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <title>Peludets!</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css" />

</head>

<body>
    <div id="app"></div>
    <script src="https://kit.fontawesome.com/215bc124ef.js" crossorigin="anonymous"></script>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
    <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-map.js?key=S8d7L47mdyAG5nHG09dUnSPJjreUVPeC"></script>
    <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-routing.js?key=S8d7L47mdyAG5nHG09dUnSPJjreUVPeC">
    </script>

    <script>
        // default map layer
let map = L.map("map", {
    layers: MQ.mapLayer(),
    center: [41.50546, 2.11775],
    zoom: 16
});

function runDirection(start, end) {
    // recreating new map layer after removal
    map = L.map("map", {
        layers: MQ.mapLayer(),
        center: [41.50546, 2.11775],
        zoom: 16
    });

    var dir = MQ.routing.directions();

    dir.route({
        locations: [start, end]
    });

    CustomRouteLayer = MQ.Routing.RouteLayer.extend({
        createStartMarker: location => {
            var custom_icon;
            var marker;

            custom_icon = L.icon({
                iconUrl: "https://newtonvet.com/wp-content/uploads/2017/05/paw-icon.png",
                iconSize: [20, 29],
                iconAnchor: [10, 29],
                popupAnchor: [0, -29]
            });

            marker = L.marker(location.latLng, { icon: custom_icon }).addTo(
                map
            );

            return marker;
        },

        createEndMarker: location => {
            var custom_icon;
            var marker;

            custom_icon = L.icon({
                iconUrl: "https://newtonvet.com/wp-content/uploads/2017/05/paw-icon.png",
                iconSize: [20, 29],
                iconAnchor: [10, 29],
                popupAnchor: [0, -29]
            });

            marker = L.marker(location.latLng, { icon: custom_icon }).addTo(
                map
            );

            return marker;
        }
    });

    map.addLayer(
        new CustomRouteLayer({
            directions: dir,
            fitBounds: true
        })
    );
}

// function that runs when form submitted
function submitForm(event) {
    event.preventDefault();

    // delete current map layer
    map.remove();

    // getting form data
    start = document.getElementById("start").value;
    end = document.getElementById("destination").value;
    

    // run directions function
    runDirection(start, end);

    // reset form
    document.getElementById("form").reset();
}

// asign the form to form variable
const form = document.getElementById("form");

// call the submitForm() function when submitting the form
form.addEventListener("submit", submitForm);

    </script>



</body>

</html>