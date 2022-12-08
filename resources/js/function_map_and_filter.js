import { getIcon } from './icon-provider.js'


/**
 * asoscie les evenement (ajout dans les tableaux et changement de la couleur) avec les categories actuelles, commes les categories sont réactualisée a chaque modifications de la map il faut réapeller la fonction
 * @param {Array} catsChecked tableau d'objet de type categories
 * @param {Array} sousCatsChecked tableau d'objet de type sous categories
 */
export function bindFilters(catsChecked, sousCatsChecked) {

    // changer la couleur de la categorie si elle est cliquée, et l'ajouter a la liste des categories cliquées
    let catSection = document.getElementsByClassName('categorie-section');

    for (let i = 0; i < catSection.length; i++) {

        let btnCat = catSection[i].getElementsByClassName('categorie')[0];
        let btnSCat = catSection[i].getElementsByClassName('sous-categorie');

        // si la categorie est enregistrée dans les checked on la remet en vert et checked et toutes les sous categories aussi
        if (catsChecked.includes(btnCat.getAttribute('numCat'))) {
            btnCat.classList.add('checked')
            for (let i = 0; i < btnSCat.length; i++) {
                btnSCat[i].classList.add('checked')
            }
        }

        // listenner des categories
        btnCat.addEventListener('click', function () {
            this.classList.toggle("checked");

            // si il est check et qu il n y est pas deja, on l ajoute a la liste des categories
            if (this.className.includes('checked') && !catsChecked.includes(this.getAttribute('numCat'))) {
                catsChecked.push(btnCat.getAttribute('numCat'))
            } else {
                // sinon on l y enleve
                let index = catsChecked.indexOf(btnCat.getAttribute('numCat'));
                if (index > -1) {
                    catsChecked.splice(index, 1);
                }
            }

            // changement class des sous-categorie de cette categorie
            for (let j = 0; j < btnSCat.length; j++) {
                if (this.className.includes('checked')) {
                    // si la categorie est checked on supprime de la liste les sous categories qui lui appartiennent
                    if (sousCatsChecked.includes(btnSCat[j].getAttribute('numSousCat'))) {
                        let index = sousCatsChecked.indexOf(btnSCat[j].getAttribute('numSousCat'));
                        if (index > -1) {
                            sousCatsChecked.splice(index, 1);
                        }
                    }

                    // si la categorie n a pas la classe verte on l y ajoute
                    if (!btnSCat[j].className.includes('checked')) {
                        btnSCat[j].classList.add('checked')
                    }
                } else {
                    if (btnSCat[j].className.includes('checked')) {
                        btnSCat[j].classList.remove('checked')
                    }
                }
            }
            displayCurrentFilter(catsChecked, sousCatsChecked)
        })


        // listenner des sous categories
        for (let j = 0; j < btnSCat.length; j++) {

            if (sousCatsChecked.includes(btnSCat[j].getAttribute('numSousCat'))) {
                btnSCat[j].classList.add('checked')
            }

            btnSCat[j].addEventListener('click', function () {

                // si la categorie n'est pas checked, les sous categorie se selectionnent normalement
                if (!btnCat.className.includes('checked') && !catsChecked.includes(btnCat.getAttribute('numCat'))) {
                    this.classList.toggle("checked");

                    // si il est check et qu il n y est pas deja, on l ajoute a la liste des sous-categories
                    if (this.className.includes('checked') && !sousCatsChecked.includes(this.getAttribute('numSousCat'))) {
                        sousCatsChecked.push(this.getAttribute('numSousCat'))
                    } else {
                        // sinon on l y enleve
                        let index = sousCatsChecked.indexOf(this.getAttribute('numSousCat'));
                        if (index > -1) {
                            sousCatsChecked.splice(index, 1);
                        }
                    }
                    displayCurrentFilter(window.catsChecked, window.sousCatsChecked)
                }
            })
        }
    }
}



/**
 * associe le boutton d ouverture et de fermeture (en mode mobile) a ses animations
 */
export function animateOpenCloseFilter() {
    let btnOpenFilter = document.getElementById('filter-btn');
    let filterContent = document.getElementsByClassName('filter-content')[0];
    let btnCloseFilter = document.getElementsByClassName('btn-down-filter')[0];

    // durré des animations
    let animDuration = 500

    // en cliquant sur le btn des filtres la fenettre des filtres s'ouvre (avec l'animation)
    btnOpenFilter.addEventListener('click', function (e) {

        filterContent.animate([
            // keyframes
            {
                transform: 'translateY(' + filterContent.clientHeight + 'px)',
                visibility: 'hidden',
                opacity: '1'
            },
            {
                transform: 'translateY(0px)',
                visibility: 'visible',
                opacity: '1'
            }
        ], {
            // timing options
            duration: animDuration,
            fill: 'forwards',
            easing: 'ease-in-out'
        });

        // quand le volet des filtres est ouvert, on attend animDuration, et a partir de là quand on clique sur la flecheRetour ou autre part que sur le volet il se referme
        setTimeout(() => {
            document.addEventListener('click', function _hide(e) {
                let target = e.target
                if (!target.closest('.filter-content') || target.closest('.btn-down-filter') === btnCloseFilter) {
                    filterContent.animate([
                        // keyframes
                        {
                            transform: 'translateY(0px)',
                            visibility: 'visible',
                            opacity: '1'
                        },
                        {
                            transform: 'translateY(' + filterContent.clientHeight + 'px)',
                            visibility: 'hidden',
                            opacity: '0'
                        }
                    ], {
                        // timing options
                        duration: animDuration,
                        fill: 'forwards',
                        easing: 'ease-in-out'
                    });
                    setTimeout(() => {
                        filterContent.animate([
                            // keyframes
                            {
                                transform: 'translateY(' + filterContent.clientHeight + 'px)',
                            },
                            {
                                transform: 'translateY(0px)',
                            }
                        ], {
                            // timing options
                            duration: 0,
                            fill: 'forwards',
                            easing: 'ease-in-out'
                        });
                    }, animDuration);

                    document.removeEventListener('click', _hide)
                }
            })
        }, animDuration);
    })
}





/**
 * associe les boutton des categories et sous categories avec leurs animations
 */
export function animateOpenCloseSousCat() {

    // durré des animations
    let animDuration = 500

    let btnToggleCat = document.getElementsByClassName('toggle-cat')
    let categorieSection = document.getElementsByClassName('categorie-section')
    let sousCatContent = document.getElementsByClassName('sous-categorie-content')

    // pour chaque div categorie-section et sous-categorie-content, ajout d un eventlistenner avec aniation show ou hide
    for (let i = 0; i < sousCatContent.length; i++) {

        // categories FERMEE au debut
        let showSousCat = 0

        let hauteur = parseInt(window.getComputedStyle(sousCatContent[i]).marginTop) + sousCatContent[i].clientHeight

        btnToggleCat[i].addEventListener('click', function () {
            if (!showSousCat) {
                // OUVERTURE
                this.style.transform = "rotate(90deg)";

                // anim de la categorie
                categorieSection[i].animate([
                    // keyframes
                    {
                        height: (window.innerWidth > 1280) ? '45px' : '60px'
                    },
                    {
                        height: 60 + hauteur + 'px'
                    }
                ], {
                    // timing options
                    duration: animDuration,
                    fill: 'forwards',
                    easing: 'ease-in-out'
                });

                //anim de la sous categorie
                sousCatContent[i].animate([
                    // keyframes
                    {
                        opacity: '0',
                        transform: 'translateY(-' + hauteur + 'px)',
                        visibility: 'hidden'
                    },
                    {
                        opacity: 1,
                        transform: 'translateY(0px)',
                        visibility: 'visible'
                    }
                ], {
                    // timing options
                    duration: animDuration,
                    fill: 'forwards',
                    easing: 'ease-in-out'
                });

                // changement de l'etat d'affichage
                showSousCat = 1


            } else {
                // FERMETURE
                this.style.transform = "rotate(0deg)";

                categorieSection[i].animate([
                    // keyframes
                    {
                        height: (window.innerWidth > 1280) ? '45px' : '60px'
                    },
                    {
                        height: 60 + hauteur + 'px'
                    }
                ], {
                    // timing options
                    duration: animDuration,
                    direction: 'reverse',
                    fill: 'forwards',
                    easing: 'ease-in-out'
                });

                sousCatContent[i].animate([
                    // keyframes
                    {
                        opacity: '0',
                        transform: 'translateY(-' + hauteur + 'px)',
                        visibility: 'hidden'

                    },
                    {
                        opacity: 1,
                        transform: 'translateY(0px)',
                        visibility: 'visible',
                    }
                ], {
                    // timing options
                    duration: animDuration,
                    fill: 'forwards',
                    direction: 'reverse',
                    easing: 'ease-in-out'
                });
                // changement de l etat d'affichage
                showSousCat = 0
            }
        })

    }
}


/**
 * en fonction des categories et sous categories selectionnées on les ajouttent (ou supprime) les marqueurs correspondants
 * @param {Array} catsChecked tableau d'objet de type categories
 * @param {Array} sousCatsChecked tableau d'objet de type sous categories
 */
export function displayCurrentFilter(catsChecked, sousCatsChecked) {

    sousCatsLayer.forEach(sousCatLayer => {
        if (myMap.hasLayer(sousCatLayer["interestPoints"])) {
            myMap.removeLayer(sousCatLayer["interestPoints"]);
        }

        catsChecked.forEach(catChecked => {
            if (catChecked == sousCatLayer['categorie_id']) {
                sousCatLayer['interestPoints'].addTo(myMap)
            }
        });
        sousCatsChecked.forEach(sousCatChecked => {
            if (sousCatChecked == sousCatLayer['sous_categorie_id']) {
                sousCatLayer['interestPoints'].addTo(myMap)
            }
        });
    });
}


/**
 * arrondir 6 chiffres apres la virgule
 * @param {Float} coord
 * @returns nombre arrondi a 6 chiffres apres la virgule
 */
export function roundCoord(coord) {
    for (let i = 0; i < coord.length; i++) {
        coord[i] = Math.round(coord[i] * 1000000) / 1000000
    }
    return coord
}

/**
 * declaration et renvoie d'une map
 * @returns objet map
 */
export function initMap() {
    // declaration du layer et ses parametres, puis ajout a la map
    var osmLayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFncy0iLCJhIjoiY2tqanRoaG16MWJsMjJ0cW9iaWF4MW9zbCJ9.vH4eeVz-aHjI3dpNSjLFTg', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        minZoom: 4,
        noWrap: true,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'your.mapbox.access.token'
    });

    let map = new L.Map('map', {
        maxBounds: L.latLngBounds([-90, -180], [90, 180]),
        center: new L.LatLng(46.33, 2.6),  // Paris : [48.856614, 2.3522219]
        zoom: 7,
        minZoom: 4,
        layers: [osmLayer]
    });
    return map
}

/**
 * verifie que la methode est dans le naviagateur et que l utilisateur accepte de donnner sa position
 * puis centre la carte sur la position du client
 */
export function geolocalisation() {
    // gestion de la geolocalisation
    if (navigator.geolocation) {
        // On demande d'envoyer la position courante à la fonction callback
        navigator.geolocation.getCurrentPosition((position) => {
            let lat = position.coords.latitude;
            let lng = position.coords.longitude;
            let clientLocation = [lat, lng];
            myMap.panTo(clientLocation)
        }, (error) => {
            switch (error.code) {
                case error.POSITION_UNAVAILABLE:
                    console.log('Position indéterminée');
                    break;
                case error.TIMEOUT:
                    console.log('Réponse trop lente');
                    break;
            }
        });
    }
}


/**
 * formater les données des commerces, categories, et sous categories pour un objet GeoJson
 * @param {Array} commerces liste de commerces (objet)
 * @param {Array} categories liste de categories (objet)
 * @param {Array} sousCategories liste de sous categories (objet)
 * @returns array de commerces (objet) formatées
 */
export function formatCommerces(commerces, categories, sousCategories, photos) {
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
            commerces[i]["properties"]["siteCom"] = 'http://' + commerces[i]["properties"]["siteCom"];
        }
        // ajout du libelle de la categorie et le nom du marqueur corrsepondant
        for (let j = 0; j < categories.length; j++) {
            if (commerces[i].properties.categorie_id == categories[j].id) {
                commerces[i]["properties"]["libCat"] = categories[j].libCat
                commerces[i]["properties"]["nomMarker"] = categories[j].cheminMarkerCat
            }
        }
        // ajout du libelle de la sous categorie
        for (let j = 0; j < sousCategories.length; j++) {
            if (commerces[i].properties.sous_categorie_id == sousCategories[j].id) {
                commerces[i]["properties"]["libSousCat"] = sousCategories[j].libSousCat
            }
        }
        // ajout des chemins, alt  des photos
        for (let j = 0; j < photos.length; j++) {
            if (commerces[i].properties.id == photos[j].commerce_id) {
                commerces[i]["properties"]["cheminPhoto"] = photos[j].cheminPhoto
                commerces[i]["properties"]["descPhoto"] = photos[j].descPhoto
            }
        }
    }
    return commerces
}


/**
 * creation d'une liste d'objet de sous categories correspondant aux sous categories des commerces en parammetres
 * @param {Array} commerces test
 * @returns liste d'objet de sous categories
 */
export function layerSousCategories(commerces) {

    let sousCatsLayer = [];
    for (var i = 0; i < commerces.length; i++) {

        let cat = getSCat(sousCatsLayer, commerces[i].properties.categorie_id, "categorie_id");
        let sousCat = getSCat(sousCatsLayer, commerces[i].properties.sous_categorie_id, "sous_categorie_id");

        //si la sous categorie et la categorie n'existe pas on la créée
        if (sousCat === undefined || cat === undefined || (sousCat.sous_categorie_id === null && (cat.categorie_id !== sousCat.categorie_id))) {
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


/**
 * verifie si l'objet ayant la valeur cat sur le parametre onParam existe dans cats
 * @param {Array} cats
 * @param {String} cat
 * @param {String} onParam
 * @returns object
 */
export function getSCat(cats, cat, onParam) {
    for (var i = 0; i < cats.length; i++) {
        if (cats[i][onParam] === cat) {
            return cats[i];
        }
    }
    return;
}


/**
 * création d'un objet json pour chaque sous categorie, avec leurs points et infomrations,
 * il suffit de l'ajoutter a la map en tant que layer pour afficher les points
 * @returns object GeoJson
 */
export function createInterestPoints () {
    return new L.geoJson([], {
        pointToLayer: function(feature, latlng) {
            var smallIcon = L.icon({
                iconUrl: '../images/' + getIcon(feature.properties.nomMarker),
                iconSize:     [33, 44], // taille de l'icone
                iconAnchor:   [16, 44], // point de l'icone qui correspondra à la position du marker
                popupAnchor:  [0, -50] // point depuis lequel la popup doit s'ouvrir relativement à l'iconAnchor
            });
            return L.marker(latlng, {icon: smallIcon});
        }
        ,
        onEachFeature: function(feature, layer) {

            // pour chaque marqueur de commerce on execute les instructions

            let nav = document.getElementById('nav')

            layer.addEventListener('click', function () {
                // appel ajax pour comptabiliser le click dans la base de données
                $.ajax({
                    url: "/map",
                    method:"POST",
                    data:{
                        clicked:feature.properties.id
                    },
                    // success:function(response){
                    // },
                    error: () => {
                        alert('le commerce n\'a pas put etre contabilsé au click')
                    }
                });

                // gestion des infomations
                if (nav.classList.contains('expanded')) {
                    // si le commerce cliqué est differend de celui d avant
                    if (document.getElementsByClassName('mail-com') != feature.properties.mailCom) {
                        nav.classList.remove('expanded');
                        setTimeout(() =>{
                            //changer le contenu de la nav
                            fillInfoPanel(feature)

                            // réafficher
                            nav.classList.add('expanded');
                        }, 400)
                    }
                }else{
                    fillInfoPanel(feature)
                    nav.classList.add('expanded');
                }

            })

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
            // layer.on('mouseout', function (e) {
            //     this.closePopup();
            // });
            layer.on('click', function (e) {
                this.openPopup();
            })
        }
    });
}




/**
 * format les commerces en paramètres puis
 * créé les nodes en fonction des filtres et les ajoute dans le document
 * @param {Object} response
 */
export function createFilter(response) {
    // formatage des commerces
    let currentCommerces = formatCommerces(response.currentCommerces, response.currentCategories, response.currentSousCategories, response.currentPhotosCom)

    // creation des layer avec les commerce pour chaque sous categorie
    window.sousCatsLayer = layerSousCategories(currentCommerces)

    // on supprime tous les layer sur la carte
    myMap.eachLayer(function (layer) {
        if (layer.options.id != 'mapbox/streets-v11') {
                myMap.removeLayer(layer);
        }
    });

    // on affiche les layer sur la zone presente et dont la categorie est selectionnée
    displayCurrentFilter(window.catsChecked, window.sousCatsChecked)

    let categories = response.currentCategories
    let sousCategories = response.currentSousCategories

    // on affiche dynamiquement les options
    let filterList = document.getElementsByClassName('filter-list')[0]
    filterList.innerHTML = ''

    // si il y en a
    if (categories.length < 1) {
        filterList.innerHTML = '<p style=" font-size: 1.2rem; text-align: center">Aucun commerce dans cette zone</p>'

    }else {
        categories.forEach(categorie => {
            let currentSousCategories = []
            let categorieSection = document.createElement('div')
            categorieSection.className = "categorie-section"

            sousCategories.forEach(sousCategorie => {
                if (sousCategorie["categorie_id"] == categorie["id"]) {
                    currentSousCategories.push(sousCategorie)
                }
            });

            let souscatExist = ``
            if (!currentSousCategories.length) {
                souscatExist = `style="visibility: hidden"`
            }

            let temp = `
                <div class="categorie-content">
                    <div class="toggle-cat" ${souscatExist}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="23.094" height="13.532" viewBox="0 0 23.094 13.532">
                            <g transform="translate(4.781 -4.781)">
                                <g transform="translate(18.313 4.781) rotate(90)">
                                    <g transform="translate(0)">
                                        <path d="M13.532,11.572a1.991,1.991,0,0,1-.572,1.381L3.4,22.507A1.992,1.992,0,1,1,.58,19.7l8.149-8.149L.58,3.4A1.993,1.993,0,0,1,3.4.587l9.555,9.555a1.991,1.991,0,0,1,.572,1.431Z" transform="translate(0 0)" fill="#959595"/>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class="categorie" numCat="${categorie["id"]}">${categorie["libCat"]}</div>
                </div>
            `

            categorieSection.innerHTML = temp

            if (currentSousCategories.length) {
                let sousCategorieContent = document.createElement('div')
                sousCategorieContent.className = "sous-categorie-content"

                let sousCategorieSection  = `<div class="sous-categorie-section">`
                let sousCategorieSection2 = `<div class="sous-categorie-section">`

                for (let i = 0; i < currentSousCategories.length; i ++) {
                    if (i % 2 == 0) {
                        sousCategorieSection  += `<div class="sous-categorie" numSousCat="${currentSousCategories[i]["id"]}">${currentSousCategories[i]["libSousCat"]}</div>`
                    }else {
                        sousCategorieSection2 += `<div class="sous-categorie" numSousCat="${currentSousCategories[i]["id"]}">${currentSousCategories[i]["libSousCat"]}</div>`
                    }
                }
                sousCategorieSection  += `</div>`
                sousCategorieSection  += (currentSousCategories.length > 1) ? `<div class="middle"></div>` : ''
                sousCategorieSection2 += `</div>`

                sousCategorieContent.innerHTML = sousCategorieSection + sousCategorieSection2

                categorieSection.appendChild(sousCategorieContent)

            }else {
                let sousCategorieContent = document.createElement('div')
                sousCategorieContent.className = "sous-categorie-content"

                categorieSection.appendChild(sousCategorieContent)
            }
            filterList.appendChild(categorieSection)
        });
    }
}


export function initializeQuitInfoPanel() {
    let nav = document.getElementById('nav')
    let navToggle = document.getElementsByClassName('nav-toggle')[0]
    navToggle.addEventListener('click', () => {
        nav.classList.remove('expanded')
    })
}



function fillInfoPanel(feature) {
    let infoContainer = document.getElementById('info-container')
    let productContainer    = ``
    let commContainer       = `<h2>Avis :</h2><a href="/commentaires/create" class="btn-avis"><div>Ajouter un avis</div></a>`

    let nav = document.getElementsByClassName('nav')[0]

    // on enleve l ancien bouton si il y en a un
    let oldToggleProd = document.getElementsByClassName('prod-toggle')[0]
    if (oldToggleProd) {
        nav.removeChild(oldToggleProd)
    }

    // gestion du favoris
    manageFav(feature.properties.id)

    $.ajax({
        url: "/map",
        method:"POST",
        data:{
            commerce_id:feature.properties.id
        },
        success:function(response){
            // afficher les produits
            let produits     = response.produits
            let commentaires = response.commentaires

            // gestion des produits
            produits.forEach(produit => {
                productContainer += `
                <div class="prod-container">
                    <div class="img-prod">
                        <img src="uploads/produits/${produit.cheminPhotoProd}" alt="${produit.labelProd}">
                    </div>
                    <div class="info-prod">
                        <div class="nom-prod">${produit.labelProd}</div>
                        <div class="desc-prod">${produit.descProd}</div>
                        <div class="prix-prod">${produit.prixProd} € / ${produit.libelleUnit}</div>
                    </div>
                </div>
                `
            });

            // gestion des commentaires/avis
            commentaires.forEach(commentaire => {
                commContainer += `
				<div class="avis-container">
					<div class="note-avis">${Math.round(commentaire.note)}/5</div>
					<div class="text-avis">${commentaire.commentaireAvis}</div>
				</div>
                `
            });
            infoContainer.innerHTML += commContainer



            // création du btn si le commerce a des produits !
            if (productContainer != '') {
                let toggleProd = document.createElement('div')
                toggleProd.className = 'prod-toggle'
                toggleProd.innerHTML = 'Voir les produits'

                //ajout du nouveau boutton
                nav.appendChild(toggleProd)

                // gestion evenement du btn
                toggleProd.addEventListener('click', function() {
                    if (this.innerHTML == 'Voir les produits') {
                        // on affiche les produits
                        this.innerHTML = 'Voir le commerce'
                        infoContainer.innerHTML = productContainer

                    }else {
                        // réafficher les infos du commerce
                        this.innerHTML = 'Voir les produits'
                        infoContainer.innerHTML = info + commContainer
                    }
                })
            }else {
                // aucun produits
                let toggleProd = document.createElement('div')
                toggleProd.className = 'prod-toggle'
                toggleProd.innerHTML = 'Pas de produits'
                nav.appendChild(toggleProd)
            }
        },
        error: () => {
            alert('Les produit de ce commerce n\'ont pas put être chargés')
        }
    });



    let info = `
        <div class="img-com">
            <img src="uploads/commerces/${feature.properties.cheminPhoto}" alt="${feature.properties.descPhoto}">
        </div>
        <div class="titre-com">${feature.properties.nomCom}</div>
        <div class="desc-com">
            <p>${feature.properties.descCom}</p>
        </div>
        <div class="general-com">
            <div class="adr-container">
                <i class="fas fa-map-marker-alt"></i>
                <div class="adr-com">${feature.properties.ad1Com}</div>
            </div>
            <div class="tel-container">
                <i class="fas fa-phone-alt"></i>
                <div class="tel-com">${feature.properties.telCom}</div>
            </div>
            <div class="mail-container">
                <i class="fas fa-envelope"></i>
                <div class="mail-com"><a href="mailto:${feature.properties.mailCom}">${feature.properties.mailCom}</a></div>
            </div>
    `
    // si les element ne sont pas dans la bd il ne faut pas les afficher
    if (feature.properties.horairesCom !== null) {
        info += initHours()



        // gestion des horaires
        function initHours() {
            let semaine = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi']
            let today = semaine[new Date().getDay()]
            let Hours = JSON.parse(feature.properties.horairesCom)

            let content =  `
                <div class="horaire-container">
                    <i class="far fa-clock"></i>
                    <div class="horaire-com" onclick="this.classList.toggle('showHours')">Aujourd'hui : ${Hours[today]}
                        <div>   ${semaine[1]} : ${Hours[semaine[1]]} </br>
                                ${semaine[2]} : ${Hours[semaine[2]]} </br>
                                ${semaine[3]} : ${Hours[semaine[3]]} </br>
                                ${semaine[4]} : ${Hours[semaine[4]]} </br>
                                ${semaine[5]} : ${Hours[semaine[5]]} </br>
                                ${semaine[6]} : ${Hours[semaine[6]]} </br>
                                ${semaine[0]} : ${Hours[semaine[0]]} </br>
                        </div>
                    </div>
                </div>
            `
            return content;
        }
    }

    if (feature.properties.siteCom !== null) {
        info += `<div class="site-container">
            <i class="fas fa-laptop"></i>
            <div class="site-com"><a href="${feature.properties.siteCom}" target="_blank">Visitez notre site</a></div>
        </div>`
    }
    // fermer les info
    info += `</div>`

    infoContainer.innerHTML = info
}



/**
 * gestion des favoris en localstorage
 * @param {*} commerce_id id du commerce cliqué
 */
function manageFav(commerce_id) {
    // gestion de l icon de favoris
    let favToggle =document.getElementsByClassName('fav-toggle')[0]
    let nav = document.getElementsByClassName('nav')[0]
    if (favToggle) {
        nav.removeChild(favToggle)
    }
    favToggle = document.createElement('div')
    favToggle.className ='fav-toggle'
    nav.appendChild(favToggle)


    // verification si le commerce est en favoris
    if (localStorage.getItem('commerce_id') != null) {
        if (JSON.parse(localStorage.getItem('commerce_id')).includes(commerce_id)) {
            // met l icon des favoris
            favToggle.innerHTML = `<i class="fas fa-bookmark"></i>`
        }else {
            // met l icon des favoris
            favToggle.innerHTML = `<i class="far fa-bookmark"></i>`
        }
    }else {
        // fav pas enregistré
        favToggle.innerHTML = `<i class="far fa-bookmark"></i>`
    }

    //eventlistenner sur l icon favoris
    favToggle.addEventListener('click', function (e) {
        // si pas present ds le localstorage
        if (localStorage.getItem('commerce_id') == null) {
            localStorage.setItem('commerce_id', JSON.stringify([commerce_id]))
            favToggle.innerHTML = `<i class="fas fa-bookmark"></i>`
            console.log('pas present ds le localstore');

        }else {
            let commerceLocal = JSON.parse(localStorage.getItem('commerce_id'))

            if (commerceLocal.includes(commerce_id)) {
                // changer l icon de fav et le supprimer du local
                favToggle.innerHTML = `<i class="far fa-bookmark"></i>`;
                commerceLocal.splice(commerceLocal.indexOf(commerce_id),1)
                localStorage.setItem('commerce_id', JSON.stringify(commerceLocal))

            }else {
                // changer l'icon et ajoutter ds le localstorage
                favToggle.innerHTML = `<i class="fas fa-bookmark"></i>`;
                (commerceLocal).push(commerce_id)
                localStorage.setItem('commerce_id', JSON.stringify(commerceLocal))
            }
        }
    })
}

