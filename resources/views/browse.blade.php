<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
        href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css"
        rel="stylesheet"
    />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>

    <link rel="stylesheet" href="/resources/styles/style.css">

    <title>Filterable List</title>
</head>

<body class="antialiased font-sans bg-gray-200">
<main class="container m-auto max-w-2xl mt-4 p-2 sm:px-8">
    <input
        type="search"
        id="search"
        placeholder="Recherche d'adresses.."
        class="appearance-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 rounded-lg text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
    />
    <div class="sticky-rec my-0 shadow rounded-lg overflow-hidden">
        <table class="items min-w-full leading-normal"></table>
    </div>
</main>
<div id="mapid"></div>
<script src="/resources/js/map.js"></script>
<script src="/resources/js/testAPIGouv.js"></script>

</body>
</html>
