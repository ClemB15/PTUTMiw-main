//////////////////////////////////   MAP
let cities = []
let url ="";


var mymap = L.map('map').setView([48.856614
    , 2.3522219], 11);
var markergroup = L.layerGroup().addTo(mymap);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFncy0iLCJhIjoiY2tqanRoaG16MWJsMjJ0cW9iaWF4MW9zbCJ9.vH4eeVz-aHjI3dpNSjLFTg', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'your.mapbox.access.token'
}).addTo(mymap);

///////////////GEOLOCATION
// On vérifie que la méthode est implémenté dans le navigateur
if ( navigator.geolocation ) {
    // On demande d'envoyer la position courante à la fonction callback
    navigator.geolocation.getCurrentPosition( callback, erreur );
} else {
    // Function alternative sinon
    alternative();
}

function erreur( error ) {
    switch( error.code ) {
        case error.PERMISSION_DENIED:
            console.log( 'L\'utilisateur a refusé la demande' );
            break;
        case error.POSITION_UNAVAILABLE:
            console.log( 'Position indéterminée' );
            break;
        case error.TIMEOUT:
            console.log( 'Réponse trop lente' );
            break;
    }
    // Function alternative
    alternative();
};



function callback( position ) {
    let lat = position.coords.latitude;
    let lng = position.coords.longitude;
    // console.log( lat, lng );
    let coords = [lat, lng];
    mymap.panTo(coords)
    // L.marker(coords).addTo(mymap)
}

function alternative() {
    /*$.ajax({
        // pensez à définir le chemin vers admin-ajax.php…
        // … en front via localize_script()…
        // … au moment de l'enqueue de votre script
        url:adminajax,
        data:{
            action:get_user_coords
        }
    }).done( function( data ){
        if ( data.success ) {
            var lat = data.data.lat;
            var lng = data.data.lng;
            // console.log( lat, lng );
            // Do stuff

        }
    });*/
}


function changeLocal(latlng){
    markergroup.clearLayers();
    let addrMark = latlng;
    console.log(addrMark)
    marker = L.marker(addrMark).addTo(markergroup);
    marker.bindPopup("<b>"+addrMark+"</b>");
    mymap.flyTo(latlng);
}
