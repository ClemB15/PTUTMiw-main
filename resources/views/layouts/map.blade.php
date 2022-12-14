<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="{{mix('css/nav.css') }}">
	<link rel="stylesheet" href="{{mix('css/style.css') }}">
	<!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->
	<!-- ... -->

	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
</head>

<style>
        html, body { height: 100% }
</style>
<body onload="initialize()">

	@include('layouts.nav')

	<div class="content">

		@yield('content')

	</div>
	<div id="map" style="width:100%; height:100%"></div>


</body>
</html>

<script type="text/javascript">
    function initialize() {
        var map = L.map('map').setView([48.833, 2.333], 7); // LIGNE 18

        var osmLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', { // LIGNE 20
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19
        });
    
        map.addLayer(osmLayer);
    }
</script>