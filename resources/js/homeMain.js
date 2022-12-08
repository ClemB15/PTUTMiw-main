
import { bindFilters, 
    animateOpenCloseFilter, 
    animateOpenCloseSousCat,
    geolocalisation,
    roundCoord, 
    initMap, 
    createFilter,
    initializeQuitInfoPanel } from './function_map_and_filter.js'




window.addEventListener('load', function () {
    function manageHours() {
        console.log('test');
    }
    //initialisation de la map
    window.myMap = initMap();

    // initialisation du panneau d'iformation des commerces
    initializeQuitInfoPanel()

    // associe le boutton des filtre a ses evenements
    animateOpenCloseFilter()

    // declaration des deux variables globales pour les utiliser dans d autres fichier
    window.catsChecked = []
    window.sousCatsChecked = []

    // implementation de la geolocalisation
    geolocalisation()

    // recuperation des coordonées des points de la map
    let bounds = myMap.getBounds();
    let northWest = roundCoord([bounds.getNorthWest()['lat'], bounds.getNorthWest()['lng']]);
    let southEast = roundCoord([bounds.getSouthEast()['lat'], bounds.getSouthEast()['lng']]);


    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // appel ajax qui renvoie les commerces, leurs categories et sous categories 
    $.ajax({
        url: "/map",
        method:"POST",
        data:{
            northWest:northWest,
            southEast:southEast
        },
        success:function(response){
            // traitement de la reponse
            if(response) {
                createFilter(response)
                animateOpenCloseSousCat()
                bindFilters(window.catsChecked, window.sousCatsChecked)
            }
        },
        error: () => {
            alert('la requette pour les commerces de cette zone n\'a pas fonctionné \r essayez de deplacer la carte ou de recharger la carte')
        }
    });
    
    // quand la carte est déplacées on demande les commerces, categories et sous cat qui correspondent a la nouvelle zone et on traite les données
    myMap.on('moveend', function(e) {
        bounds = myMap.getBounds();
        northWest = roundCoord([bounds.getNorthWest()['lat'], bounds.getNorthWest()['lng']]);
        southEast = roundCoord([bounds.getSouthEast()['lat'], bounds.getSouthEast()['lng']]);

        $.ajax({
            url: "/map",
            method:"POST",
            data:{
                northWest:northWest,
                southEast:southEast
            },
            success:function(response){
                // traintement de la reponse
                if(response) {

                    //création des nodes de categories et sous categories
                    createFilter(response)

                    //ajout des animation aux nodes de categories
                    animateOpenCloseSousCat()

                    // associe les boutton avec leurs actions
                    bindFilters(window.catsChecked, window.sousCatsChecked)
                }
            },
            error:function () {
                alert('la requette pour les commerces de cette zone n\'a pas fonctionné \r essayez de deplacer la carte ou de recharger la carte')
            }
        });
    });

})
