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
</body>

</html>