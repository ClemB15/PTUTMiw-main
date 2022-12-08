//////////////////////////////////   MAP
const iconProvider = require('./icon-provider.js')


window.addEventListener('load', function () {
    
    //initialisation de la map
    window.myMap = initMap();
    
    let bounds = myMap.getBounds();

    // arrondir 6 chiffres apres la virgule
    function roundCoord(coord) {
        for (let i = 0; i < coord.length; i++) {
            coord[i] = Math.round(coord[i] * 1000000) / 1000000
        }
        return coord
    }

    let northWest = roundCoord([bounds.getNorthWest()['lat'], bounds.getNorthWest()['lng']]);
    let southEast = roundCoord([bounds.getSouthEast()['lat'], bounds.getSouthEast()['lng']]);


    console.log(northWest, southEast);

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/",
        method:"POST",
        data:{
            northWest:northWest,
            southEast:southEast
        },
        success:function(response){
        console.log(response);
        //   if(response) {
        //   }
        },
        error:function () {
            console.log('error');      
        }
    });
    
    // quand la carte est déplacées on demande les commerces, categories et sous cat qui correspondent a la nouvelle zone
    myMap.on('moveend', function(e) {
        bounds = myMap.getBounds();
        northWest = roundCoord([bounds.getNorthWest()['lat'], bounds.getNorthWest()['lng']]);
        southEast = roundCoord([bounds.getSouthEast()['lat'], bounds.getSouthEast()['lng']]);

        $.ajax({
            url: "/",
            method:"POST",
            data:{
                northWest:northWest,
                southEast:southEast
            },
            success:function(response){
              console.log(response);
            //   if(response) {
            //   }
            },
            error:function () {
                console.log('error');      
            }
        });
    });
    

    // // On vérifie que la méthode est implémenté dans le navigateur
    // if (navigator.geolocation) {
    //     // On demande d'envoyer la position courante à la fonction callback
    //     navigator.geolocation.getCurrentPosition( callback, erreur );
    // } else {
    //     // Function alternative sinon
    //     alternative();
    // }

    // formatage des commerces
    formatCommerces()

    // creation des layer avec les commerce pour chaque sous categorie
    window.sousCatsLayer = layerSousCategories()
 

    console.log(commerces);
    console.log(sousCatsLayer);
})



// formater les données des commerces pour un objet geojson
export function formatCommerces() {
    for (var i = 0; i < commerces.length; i++) {
        
        let properties = commerces[i]
        let geometry = {coordinates: [properties.longCom, properties.latCom], type: 'Point'}
        
        commerces[i] = Object(null)

        commerces[i]["properties"] = properties;        
        commerces[i]["geometry"] = geometry
        commerces[i]["type"] = "Feature";
        
        if (commerces[i]["properties"]["siteCom"] !== null
            && commerces[i]["properties"]["siteCom"].indexOf("http://") < 0
            && commerces[i]["properties"]["siteCom"].indexOf("https://") < 0) {
            commerces[i]["properties"]["siteCom"] += 'http://';
        }
        // ajout du libelle de la categorie
        for (let j = 0; j < categories.length; j++) {
            if (commerces[i].properties.categorie_id == categories[j].id) {
                commerces[i]["properties"]["libCat"] = categories[j].libCat
            }
        }
        // ajout du libelle de la sous categorie
        for (let j = 0; j < sousCategories.length; j++) {
            if (commerces[i].properties.sous_categorie_id == sousCategories[j].id) {
                commerces[i]["properties"]["libSousCat"] = sousCategories[j].libSousCat
            }
        }
    }
}


function layerSousCategories() {
        
    let sousCatsLayer = [];
    for (var i = 0; i < commerces.length; i++) {

        let sousCat = getCat(sousCatsLayer, commerces[i].properties.sous_categorie_id, "sous_categorie_id");
        //si la categorie n'existe pas on la créée
        
        if (sousCat === undefined) {
            sousCat = {
                "interestPoints" : createInterestPoints(),
                "categorie_id" : commerces[i].properties.categorie_id,
                "sous_categorie_id" : commerces[i].properties.sous_categorie_id,         
                "libSousCat" : commerces[i].properties.libSousCat
            }
            sousCatsLayer.push(sousCat);
        }
        sousCat["interestPoints"].addData(commerces[i]);
    }
    return sousCatsLayer
}


// verification que l objet existe ou pas
function getCat(cats, cat, onParam) {
    for (var i = 0; i < cats.length; i++) {
        if (cats[i][onParam] === cat) {
            return cats[i];
        }
    }
    return ;
}

// creation d un objet geojson pour chaque sous catgorie, avec leur points et information, il suffit de l ajoutter a la map en tant que layer pour afficher les points
function createInterestPoints () {
    return new L.geoJson([], {
        pointToLayer: function(feature, latlng) {
            var smallIcon = L.icon({ 
                iconUrl: '../images/' + iconProvider.getIcon(feature.properties.libCat),
                //shadowUrl: 'icon-shadow.png',
                iconSize:     [33, 44], // taille de l'icone
                // shadowSize:   [50, 64], // taille de l'ombre
                iconAnchor:   [16, 44], // point de l'icone qui correspondra à la position du marker
                // shadowAnchor: [32, 64],  // idem pour l'ombre
                popupAnchor:  [-3, -76] // point depuis lequel la popup doit s'ouvrir relativement à l'iconAnchor
            });
            return L.marker(latlng, {icon: smallIcon});
        }
        ,
        onEachFeature: function(feature, layer) {
            var html = '';
            if (feature.properties.nomCom) {
                html += '<b>' + feature.properties.nomCom + '</b></br>';
            }
            if (feature.properties.libSousCat) {
                html += 'Sous Catégorie : ' + feature.properties.libSousCat + '</br>';
            }
            
            layer.bindPopup(html);

            layer.on('mouseover', function (e) {
                this.openPopup();
            });
            layer.on('mouseout', function (e) {
                this.closePopup();
            });
        }
    });
}

function initMap() {
    // declaration du layer et ses parametres, puis ajout a la map
    let osmLayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFncy0iLCJhIjoiY2tqanRoaG16MWJsMjJ0cW9iaWF4MW9zbCJ9.vH4eeVz-aHjI3dpNSjLFTg', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'your.mapbox.access.token'
    });

    let map = new L.Map('map', {
        center: new L.LatLng(46.33, 2.6),  // Paris : [48.856614, 2.3522219]
        zoom: 4,
        layers: [osmLayer]
    });
    return map
}

function callback( position ) {
    let lat = position.coords.latitude;
    let lng = position.coords.longitude;
    let clientLocation = [lat, lng];
    myMap.panTo(clientLocation)
    // L.marker(clientLocation).addTo(myMap)
}

function erreur( error ) {
    switch( error.code ) {
        case error.PERMISSION_DENIED:
            console.log( 'L\'utilisateur a refusé la demande de localisation' );
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



