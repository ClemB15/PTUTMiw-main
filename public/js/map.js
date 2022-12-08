/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/function_map_and_filter.js":
/*!*************************************************!*\
  !*** ./resources/js/function_map_and_filter.js ***!
  \*************************************************/
/*! exports provided: bindFilters, animateOpenCloseFilter, animateOpenCloseSousCat, displayCurrentFilter, roundCoord, initMap, geolocalisation, formatCommerces, layerSousCategories, getSCat, createInterestPoints, createFilter */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "bindFilters", function() { return bindFilters; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "animateOpenCloseFilter", function() { return animateOpenCloseFilter; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "animateOpenCloseSousCat", function() { return animateOpenCloseSousCat; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "displayCurrentFilter", function() { return displayCurrentFilter; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "roundCoord", function() { return roundCoord; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initMap", function() { return initMap; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "geolocalisation", function() { return geolocalisation; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "formatCommerces", function() { return formatCommerces; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "layerSousCategories", function() { return layerSousCategories; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getSCat", function() { return getSCat; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createInterestPoints", function() { return createInterestPoints; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createFilter", function() { return createFilter; });
/* harmony import */ var _icon_provider_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./icon-provider.js */ "./resources/js/icon-provider.js");

/**
 * asoscie les evenement (ajout dans les tableaux et changement de la couleur) avec les categories actuelles, commes les categories sont réactualisée a chaque modifications de la map il faut réapeller la fonction
 * @param {Array} catsChecked tableau d'objet de type categories
 * @param {Array} sousCatsChecked tableau d'objet de type sous categories
 */

function bindFilters(catsChecked, sousCatsChecked) {
  // changer la couleur de la categorie si elle est cliquée, et l'ajouter a la liste des categories cliquées
  var catSection = document.getElementsByClassName('categorie-section');

  var _loop = function _loop(i) {
    var btnCat = catSection[i].getElementsByClassName('categorie')[0];
    var btnSCat = catSection[i].getElementsByClassName('sous-categorie'); // si la categorie est enregistrée dans les checked on la remet en vert et checked et toutes les sous categories aussi

    if (catsChecked.includes(btnCat.getAttribute('numCat'))) {
      btnCat.classList.add('checked');

      for (var _i = 0; _i < btnSCat.length; _i++) {
        btnSCat[_i].classList.add('checked');
      }
    } // listenner des categories


    btnCat.addEventListener('click', function () {
      this.classList.toggle("checked"); // si il est check et qu il n y est pas deja, on l ajoute a la liste des categories

      if (this.className.includes('checked') && !catsChecked.includes(this.getAttribute('numCat'))) {
        catsChecked.push(btnCat.getAttribute('numCat'));
      } else {
        // sinon on l y enleve
        var index = catsChecked.indexOf(btnCat.getAttribute('numCat'));

        if (index > -1) {
          catsChecked.splice(index, 1);
        }
      } // changement class des sous-categorie de cette categorie


      for (var j = 0; j < btnSCat.length; j++) {
        if (this.className.includes('checked')) {
          // si la categorie est checked on supprime de la liste les sous categories qui lui appartiennent
          if (sousCatsChecked.includes(btnSCat[j].getAttribute('numSousCat'))) {
            var _index = sousCatsChecked.indexOf(btnSCat[j].getAttribute('numSousCat'));

            if (_index > -1) {
              sousCatsChecked.splice(_index, 1);
            }
          } // si la categorie n a pas la classe verte on l y ajoute


          if (!btnSCat[j].className.includes('checked')) {
            btnSCat[j].classList.add('checked');
          }
        } else {
          if (btnSCat[j].className.includes('checked')) {
            btnSCat[j].classList.remove('checked');
          }
        }
      }

      displayCurrentFilter(catsChecked, sousCatsChecked);
      console.log(catsChecked);
      console.log(sousCatsChecked);
    }); // listenner des sous categories

    for (var j = 0; j < btnSCat.length; j++) {
      if (sousCatsChecked.includes(btnSCat[j].getAttribute('numSousCat'))) {
        btnSCat[j].classList.add('checked');
      }

      btnSCat[j].addEventListener('click', function () {
        // si la categorie n'est pas checked, les sous categorie se selectionnent normalement
        if (!btnCat.className.includes('checked') && !catsChecked.includes(btnCat.getAttribute('numCat'))) {
          this.classList.toggle("checked"); // si il est check et qu il n y est pas deja, on l ajoute a la liste des sous-categories

          if (this.className.includes('checked') && !sousCatsChecked.includes(this.getAttribute('numSousCat'))) {
            sousCatsChecked.push(this.getAttribute('numSousCat'));
          } else {
            // sinon on l y enleve
            var index = sousCatsChecked.indexOf(this.getAttribute('numSousCat'));

            if (index > -1) {
              sousCatsChecked.splice(index, 1);
            }
          }

          displayCurrentFilter(window.catsChecked, window.sousCatsChecked);
          console.log(catsChecked);
          console.log(sousCatsChecked);
        }
      });
    }
  };

  for (var i = 0; i < catSection.length; i++) {
    _loop(i);
  }
}
/**
 * associe le boutton d ouverture et de fermeture (en mode mobile) a ses animations
 */

function animateOpenCloseFilter() {
  var btnOpenFilter = document.getElementById('filter-btn');
  var filterContent = document.getElementsByClassName('filter-content')[0];
  var btnCloseFilter = document.getElementsByClassName('btn-down-filter')[0]; // durré des animations

  var animDuration = 500; // en cliquant sur le btn des filtres la fenettre des filtres s'ouvre (avec l'animation)

  btnOpenFilter.addEventListener('click', function (e) {
    filterContent.animate([// keyframes
    {
      transform: 'translateY(' + filterContent.clientHeight + 'px)',
      visibility: 'hidden',
      opacity: '1'
    }, {
      transform: 'translateY(0px)',
      visibility: 'visible',
      opacity: '1'
    }], {
      // timing options
      duration: animDuration,
      fill: 'forwards',
      easing: 'ease-in-out'
    }); // quand le volet des filtres est ouvert, on attend animDuration, et a partir de là quand on clique sur la flecheRetour ou autre part que sur le volet il se referme

    setTimeout(function () {
      document.addEventListener('click', function _hide(e) {
        var target = e.target;

        if (!target.closest('.filter-content') || target.closest('.btn-down-filter') === btnCloseFilter) {
          filterContent.animate([// keyframes
          {
            transform: 'translateY(0px)',
            visibility: 'visible',
            opacity: '1'
          }, {
            transform: 'translateY(' + filterContent.clientHeight + 'px)',
            visibility: 'hidden',
            opacity: '0'
          }], {
            // timing options
            duration: animDuration,
            fill: 'forwards',
            easing: 'ease-in-out'
          });
          setTimeout(function () {
            filterContent.animate([// keyframes
            {
              transform: 'translateY(' + filterContent.clientHeight + 'px)'
            }, {
              transform: 'translateY(0px)'
            }], {
              // timing options
              duration: 0,
              fill: 'forwards',
              easing: 'ease-in-out'
            });
          }, animDuration);
          document.removeEventListener('click', _hide);
        }
      });
    }, animDuration);
  });
}
/**
 * associe les boutton des categories et sous categories avec leurs animations
 */

function animateOpenCloseSousCat() {
  // durré des animations
  var animDuration = 500;
  var btnToggleCat = document.getElementsByClassName('toggle-cat');
  var categorieSection = document.getElementsByClassName('categorie-section');
  var sousCatContent = document.getElementsByClassName('sous-categorie-content'); // pour chaque div categorie-section et sous-categorie-content, ajout d un eventlistenner avec aniation show ou hide

  console.log(btnToggleCat.length);
  console.log(sousCatContent.length);

  var _loop2 = function _loop2(i) {
    // categories FERMEE au debut
    var showSousCat = 0;
    var hauteur = parseInt(window.getComputedStyle(sousCatContent[i]).marginTop) + sousCatContent[i].clientHeight;
    btnToggleCat[i].addEventListener('click', function () {
      if (!showSousCat) {
        // OUVERTURE 
        this.style.transform = "rotate(90deg)"; // anim de la categorie

        categorieSection[i].animate([// keyframes
        {
          height: '60px'
        }, {
          height: 60 + hauteur + 'px'
        }], {
          // timing options
          duration: animDuration,
          fill: 'forwards',
          easing: 'ease-in-out'
        }); //anim de la sous categorie

        sousCatContent[i].animate([// keyframes
        {
          opacity: '0',
          transform: 'translateY(-' + hauteur + 'px)',
          visibility: 'hidden'
        }, {
          opacity: 1,
          transform: 'translateY(0px)',
          visibility: 'visible'
        }], {
          // timing options
          duration: animDuration,
          fill: 'forwards',
          easing: 'ease-in-out'
        }); // changement de l'etat d'affichage

        showSousCat = 1;
      } else {
        // FERMETURE 
        this.style.transform = "rotate(0deg)";
        categorieSection[i].animate([// keyframes
        {
          height: '60px'
        }, {
          height: 60 + hauteur + 'px'
        }], {
          // timing options
          duration: animDuration,
          direction: 'reverse',
          fill: 'forwards',
          easing: 'ease-in-out'
        });
        sousCatContent[i].animate([// keyframes
        {
          opacity: '0',
          transform: 'translateY(-' + hauteur + 'px)',
          visibility: 'hidden'
        }, {
          opacity: 1,
          transform: 'translateY(0px)',
          visibility: 'visible'
        }], {
          // timing options
          duration: animDuration,
          fill: 'forwards',
          direction: 'reverse',
          easing: 'ease-in-out'
        }); // changement de l etat d'affichage

        showSousCat = 0;
      }
    });
  };

  for (var i = 0; i < sousCatContent.length; i++) {
    _loop2(i);
  }
}
/**
 * en fonction des categories et sous categories selectionnées on les ajouttent (ou supprime) les marqueurs correspondants
 * @param {Array} catsChecked tableau d'objet de type categories
 * @param {Array} sousCatsChecked tableau d'objet de type sous categories
 */

function displayCurrentFilter(catsChecked, sousCatsChecked) {
  sousCatsLayer.forEach(function (sousCatLayer) {
    if (myMap.hasLayer(sousCatLayer["interestPoints"])) {
      myMap.removeLayer(sousCatLayer["interestPoints"]);
    }

    catsChecked.forEach(function (catChecked) {
      if (catChecked == sousCatLayer['categorie_id']) {
        sousCatLayer['interestPoints'].addTo(myMap);
      }
    });
    sousCatsChecked.forEach(function (sousCatChecked) {
      if (sousCatChecked == sousCatLayer['sous_categorie_id']) {
        sousCatLayer['interestPoints'].addTo(myMap);
      }
    });
  });
}
/**
 * arrondir 6 chiffres apres la virgule
 * @param {Float} coord 
 * @returns nombre arrondi a 6 chiffres apres la virgule
 */

function roundCoord(coord) {
  for (var i = 0; i < coord.length; i++) {
    coord[i] = Math.round(coord[i] * 1000000) / 1000000;
  }

  return coord;
}
/**
 * declaration et renvoie d'une map
 * @returns objet map
 */

function initMap() {
  // declaration du layer et ses parametres, puis ajout a la map
  var osmLayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFncy0iLCJhIjoiY2tqanRoaG16MWJsMjJ0cW9iaWF4MW9zbCJ9.vH4eeVz-aHjI3dpNSjLFTg', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    minZoom: 2,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'your.mapbox.access.token'
  });
  var map = new L.Map('map', {
    center: new L.LatLng(46.33, 2.6),
    // Paris : [48.856614, 2.3522219]
    zoom: 4,
    layers: [osmLayer]
  });
  return map;
}
/**
 * verifie que la methode est dans le naviagateur et que l utilisateur accepte de donnner sa position
 * puis centre la carte sur la position du client
 */

function geolocalisation() {
  // gestion de la geolocalisation
  if (navigator.geolocation) {
    // On demande d'envoyer la position courante à la fonction callback
    navigator.geolocation.getCurrentPosition(function (position) {
      var lat = position.coords.latitude;
      var lng = position.coords.longitude;
      var clientLocation = [lat, lng];
      myMap.panTo(clientLocation);
    }, function (error) {
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

function formatCommerces(commerces, categories, sousCategories) {
  for (var i = 0; i < commerces.length; i++) {
    var properties = commerces[i];
    var geometry = {
      coordinates: [properties.longCom, properties.latCom],
      type: 'Point'
    };
    commerces[i] = Object(null);
    commerces[i]["properties"] = properties;
    commerces[i]["geometry"] = geometry;
    commerces[i]["type"] = "Feature";

    if (commerces[i]["properties"]["siteCom"] !== null && commerces[i]["properties"]["siteCom"].indexOf("http://") < 0 && commerces[i]["properties"]["siteCom"].indexOf("https://") < 0) {
      commerces[i]["properties"]["siteCom"] += 'http://';
    } // ajout du libelle de la categorie


    for (var j = 0; j < categories.length; j++) {
      if (commerces[i].properties.categorie_id == categories[j].id) {
        commerces[i]["properties"]["libCat"] = categories[j].libCat;
      }
    } // ajout du libelle de la sous categorie


    for (var _j = 0; _j < sousCategories.length; _j++) {
      if (commerces[i].properties.sous_categorie_id == sousCategories[_j].id) {
        commerces[i]["properties"]["libSousCat"] = sousCategories[_j].libSousCat;
      }
    }
  }

  return commerces;
}
/**
 * creation d'une liste d'objet de sous categories correspondant aux sous categories des commerces en parammetres
 * @param {Array} commerces test
 * @returns liste d'objet de sous categories
 */

function layerSousCategories(commerces) {
  var sousCatsLayer = [];

  for (var i = 0; i < commerces.length; i++) {
    var sousCat = getSCat(sousCatsLayer, commerces[i].properties.sous_categorie_id, "sous_categorie_id"); //si la categorie n'existe pas on la créée

    if (sousCat === undefined) {
      sousCat = {
        "interestPoints": createInterestPoints(),
        "categorie_id": commerces[i].properties.categorie_id,
        "sous_categorie_id": commerces[i].properties.sous_categorie_id,
        "libSousCat": commerces[i].properties.libSousCat
      };
      sousCatsLayer.push(sousCat);
    }

    sousCat["interestPoints"].addData(commerces[i]);
  }

  return sousCatsLayer;
}
/**
 * verifie si l'objet ayant la valeur cat sur le parametre onParam existe dans cats 
 * @param {Array} cats 
 * @param {String} cat 
 * @param {String} onParam 
 * @returns object 
 */

function getSCat(cats, cat, onParam) {
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

function createInterestPoints() {
  return new L.geoJson([], {
    pointToLayer: function pointToLayer(feature, latlng) {
      var smallIcon = L.icon({
        iconUrl: '../images/' + Object(_icon_provider_js__WEBPACK_IMPORTED_MODULE_0__["getIcon"])(feature.properties.libCat),
        iconSize: [33, 44],
        // taille de l'icone
        iconAnchor: [16, 44],
        // point de l'icone qui correspondra à la position du marker
        popupAnchor: [0, 0] // point depuis lequel la popup doit s'ouvrir relativement à l'iconAnchor

      });
      return L.marker(latlng, {
        icon: smallIcon
      });
    },
    onEachFeature: function onEachFeature(feature, layer) {
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
/**
 * format les commerces en paramètres puis 
 * créé les nodes en fonction des filtres et les ajoutte dans le document
 * @param {Object} response 
 */

function createFilter(response) {
  // formatage des commerces
  var currentCommerces = formatCommerces(response.currentCommerces, response.currentCategories, response.currentSousCategories); // creation des layer avec les commerce pour chaque sous categorie

  window.sousCatsLayer = layerSousCategories(currentCommerces);
  console.log(window.catsChecked);
  console.log(window.sousCatsChecked); // on supprime tous les layer sur la carte

  myMap.eachLayer(function (layer) {
    if (layer.options.id != 'mapbox/streets-v11') {
      myMap.removeLayer(layer);
    }
  }); // on affiche les layer sur la zone presente et dont la categorie est selectionnée

  displayCurrentFilter(window.catsChecked, window.sousCatsChecked); // console.log(currentCommerces);

  console.log(sousCatsLayer); // console.log(response);

  var categories = response.currentCategories;
  var sousCategories = response.currentSousCategories;
  var filterList = document.getElementsByClassName('filter-list')[0];
  filterList.innerHTML = '';
  categories.forEach(function (categorie) {
    var currentSousCategories = [];
    var categorieSection = document.createElement('div');
    categorieSection.className = "categorie-section";
    sousCategories.forEach(function (sousCategorie) {
      if (sousCategorie["categorie_id"] == categorie["id"]) {
        currentSousCategories.push(sousCategorie);
      }
    });
    var souscatExist = "";

    if (!currentSousCategories.length) {
      souscatExist = "style=\"visibility: hidden\"";
    }

    var temp = "\n            <div class=\"categorie-content\">\n                <div class=\"toggle-cat\" ".concat(souscatExist, ">\n                    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"23.094\" height=\"13.532\" viewBox=\"0 0 23.094 13.532\">\n                        <g transform=\"translate(4.781 -4.781)\">\n                            <g transform=\"translate(18.313 4.781) rotate(90)\">\n                                <g transform=\"translate(0)\">\n                                    <path d=\"M13.532,11.572a1.991,1.991,0,0,1-.572,1.381L3.4,22.507A1.992,1.992,0,1,1,.58,19.7l8.149-8.149L.58,3.4A1.993,1.993,0,0,1,3.4.587l9.555,9.555a1.991,1.991,0,0,1,.572,1.431Z\" transform=\"translate(0 0)\" fill=\"#959595\"/>\n                                </g>\n                            </g>\n                        </g>\n                    </svg>\n                </div>\n                <div class=\"categorie\" numCat=\"").concat(categorie["id"], "\">").concat(categorie["libCat"], "</div>\n            </div>\n        ");
    categorieSection.innerHTML = temp;

    if (currentSousCategories.length) {
      var sousCategorieContent = document.createElement('div');
      sousCategorieContent.className = "sous-categorie-content";
      var sousCategorieSection = "<div class=\"sous-categorie-section\">";
      var sousCategorieSection2 = "<div class=\"middle\"></div> <div class=\"sous-categorie-section\">"; // console.log(currentSousCategories);

      for (var i = 0; i < currentSousCategories.length; i++) {
        if (i % 2 == 0) {
          sousCategorieSection += "<div class=\"sous-categorie\" numSousCat=\"".concat(currentSousCategories[i]["id"], "\">").concat(currentSousCategories[i]["libSousCat"], "</div>");
        } else {
          sousCategorieSection2 += "<div class=\"sous-categorie\" numSousCat=\"".concat(currentSousCategories[i]["id"], "\">").concat(currentSousCategories[i]["libSousCat"], "</div>");
        }
      }

      sousCategorieSection += "</div>";
      sousCategorieSection2 += "</div>";
      sousCategorieContent.innerHTML = sousCategorieSection + sousCategorieSection2;
      categorieSection.appendChild(sousCategorieContent);
    } else {
      var _sousCategorieContent = document.createElement('div');

      _sousCategorieContent.className = "sous-categorie-content";
      categorieSection.appendChild(_sousCategorieContent);
    }

    console.log(categorieSection);
    filterList.appendChild(categorieSection);
  });
}

/***/ }),

/***/ "./resources/js/icon-provider.js":
/*!***************************************!*\
  !*** ./resources/js/icon-provider.js ***!
  \***************************************/
/*! exports provided: getIcon */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getIcon", function() { return getIcon; });
function getIcon(categorie) {
  if (categorie === "administartif") {
    return "map-icons/administartif.png";
  } else if (categorie === "airDeJeu") {
    return "map-icons/airDeJeu.png";
  } else if (categorie === "animalerie") {
    return "map-icons/animalerie.png";
  } else if (categorie === "astronomie") {
    return "map-icons/astronomie.png";
  } else if (categorie === "automobile") {
    return "map-icons/automobile.png";
  } else if (categorie === "bar") {
    return "map-icons/bar.png";
  } else if (categorie === "basket") {
    return "map-icons/basket.png";
  } else if (categorie === "bijouterie") {
    return "map-icons/bijouterie.png";
  } else if (categorie === "bricolage") {
    return "map-icons/bricolage.png";
  } else if (categorie === "cafe") {
    return "map-icons/cafe.png";
  } else if (categorie === "centreCommercial") {
    return "map-icons/centreCommercial.png";
  } else if (categorie === "cinema") {
    return "map-icons/cinema.png";
  } else if (categorie === "coiffeur") {
    return "map-icons/coiffeur.png";
  } else if (categorie === "corcert") {
    return "map-icons/corcert.png";
  } else if (categorie === "danse") {
    return "map-icons/danse.png";
  } else if (categorie === "dentiste") {
    return "map-icons/dentiste.png";
  } else if (categorie === "discussion") {
    return "map-icons/discussion.png";
  } else if (categorie === "divertissement") {
    return "map-icons/divertissement.png";
  } else if (categorie === "education") {
    return "map-icons/education.png";
  } else if (categorie === "emploi") {
    return "map-icons/emploi.png";
  } else if (categorie === "etablissementReligieux") {
    return "map-icons/etablissementReligieux.png";
  } else if (categorie === "etablissementScolaire") {
    return "map-icons/etablissementScolaire.png";
  } else if (categorie === "evenement") {
    return "map-icons/evenement.png";
  } else if (categorie === "exposition") {
    return "map-icons/exposition.png";
  } else if (categorie === "festival") {
    return "map-icons/festival.png";
  } else if (categorie === "fete") {
    return "map-icons/fete.png";
  } else if (categorie === "fleuriste") {
    return "map-icons/fleuriste.png";
  } else if (categorie === "hiver") {
    return "map-icons/hiver.png";
  } else if (categorie === "hotel") {
    return "map-icons/hotel.png";
  } else if (categorie === "imprimeur") {
    return "map-icons/imprimeur.png";
  } else if (categorie === "informatique") {
    return "map-icons/informatique.png";
  } else if (categorie === "instrumentDeMusique") {
    return "map-icons/instrumentDeMusique.png";
  } else if (categorie === "internet") {
    return "map-icons/internet.png";
  } else if (categorie === "jardin") {
    return "map-icons/jardin.png";
  } else if (categorie === "jeux") {
    return "map-icons/jeux.png";
  } else if (categorie === "jeuxVideo") {
    return "map-icons/jeuxVideo.png";
  } else if (categorie === "karaoke") {
    return "map-icons/karaoke.png";
  } else if (categorie === "librairie") {
    return "map-icons/librairie.png";
  } else if (categorie === "livres") {
    return "map-icons/livres.png";
  } else if (categorie === "loi") {
    return "map-icons/loi.png";
  } else if (categorie === "magasin") {
    return "map-icons/magasin.png";
  } else if (categorie === "magasinDetail") {
    return "map-icons/magasinDetail.png";
  } else if (categorie === "magasinVoiture") {
    return "map-icons/magasinVoiture.png";
  } else if (categorie === "massage") {
    return "map-icons/massage.png";
  } else if (categorie === "medecin") {
    return "map-icons/medecin.png";
  } else if (categorie === "medical") {
    return "map-icons/medical.png";
  } else if (categorie === "chaussure") {
    return "map-icons/chaussure.png";
  } else if (categorie === "mode") {
    return "map-icons/mode.png";
  } else if (categorie === "muse") {
    return "map-icons/muse.png";
  } else if (categorie === "musique") {
    return "map-icons/musique.png";
  } else if (categorie === "boiteDeNuit") {
    return "map-icons/boiteDeNuit.png";
  } else if (categorie === "nourriture") {
    return "map-icons/nourriture.png";
  } else if (categorie === "oiseau") {
    return "map-icons/oiseau.png";
  } else if (categorie === "parc") {
    return "map-icons/parc.png";
  } else if (categorie === "patisserie") {
    return "map-icons/patisserie.png";
  } else if (categorie === "photographe") {
    return "map-icons/photographe.png";
  } else if (categorie === "piscine") {
    return "map-icons/piscine.png";
  } else if (categorie === "pizzeria") {
    return "map-icons/pizzeria.png";
  } else if (categorie === "pompesFunebres") {
    return "map-icons/pompesFunebres.png";
  } else if (categorie === "recette") {
    return "map-icons/recette.png";
  } else if (categorie === "residence") {
    return "map-icons/residence.png";
  } else if (categorie === "restaurant") {
    return "map-icons/restaurant.png";
  } else if (categorie === "restauration") {
    return "map-icons/restauration.png";
  } else if (categorie === "reunion") {
    return "map-icons/reunion.png";
  } else if (categorie === "salleDeJeu") {
    return "map-icons/salleDeJeu.png";
  } else if (categorie === "sante") {
    return "map-icons/sante.png";
  } else if (categorie === "science") {
    return "map-icons/science.png";
  } else if (categorie === "serviceFinacier") {
    return "map-icons/serviceFinacier.png";
  } else if (categorie === "serviceTechnique") {
    return "map-icons/serviceTechnique.png";
  } else if (categorie === "studioMedia") {
    return "map-icons/studioMedia.png";
  } else if (categorie === "telephone") {
    return "map-icons/telephone.png";
  } else if (categorie === "teletravail") {
    return "map-icons/teletravail.png";
  } else if (categorie === "terrainDeSport") {
    return "map-icons/terrainDeSport.png";
  } else if (categorie === "transport") {
    return "map-icons/transport.png";
  } else if (categorie === "tutora") {
    return "map-icons/tutora.png";
  } else if (categorie === "valise") {
    return "map-icons/valise.png";
  } else if (categorie === "vetement") {
    return "map-icons/vetement.png";
  } else if (categorie === "voyage") {
    return "map-icons/voyage.png";
  }

  return "map-icons/default.png";
}

/***/ }),

/***/ "./resources/js/map.js":
/*!*****************************!*\
  !*** ./resources/js/map.js ***!
  \*****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _function_map_and_filter_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./function_map_and_filter.js */ "./resources/js/function_map_and_filter.js");

window.addEventListener('load', function () {
  // associe le boutton des filtre a ses evenements
  Object(_function_map_and_filter_js__WEBPACK_IMPORTED_MODULE_0__["animateOpenCloseFilter"])(); // declaration des deux variables globales pour les utiliser dans d autres fichier

  window.catsChecked = [];
  window.sousCatsChecked = []; //initialisation de la map

  window.myMap = Object(_function_map_and_filter_js__WEBPACK_IMPORTED_MODULE_0__["initMap"])(); // implementation de la geolocalisation

  Object(_function_map_and_filter_js__WEBPACK_IMPORTED_MODULE_0__["geolocalisation"])(); // recuperation des coordonées des points de la map

  var bounds = myMap.getBounds();
  var northWest = Object(_function_map_and_filter_js__WEBPACK_IMPORTED_MODULE_0__["roundCoord"])([bounds.getNorthWest()['lat'], bounds.getNorthWest()['lng']]);
  var southEast = Object(_function_map_and_filter_js__WEBPACK_IMPORTED_MODULE_0__["roundCoord"])([bounds.getSouthEast()['lat'], bounds.getSouthEast()['lng']]);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  }); // appel ajax qui renvoie les commerces, leurs categories et sous categories 

  $.ajax({
    url: "/",
    method: "POST",
    data: {
      northWest: northWest,
      southEast: southEast
    },
    success: function success(response) {
      // traitement de la reponse
      if (response) {
        Object(_function_map_and_filter_js__WEBPACK_IMPORTED_MODULE_0__["createFilter"])(response);
        Object(_function_map_and_filter_js__WEBPACK_IMPORTED_MODULE_0__["animateOpenCloseSousCat"])();
        Object(_function_map_and_filter_js__WEBPACK_IMPORTED_MODULE_0__["bindFilters"])(window.catsChecked, window.sousCatsChecked);
      }
    },
    error: function error() {
      alert('la requette pour les commerces de cette zone n\'a pas fonctionné');
    }
  }); // quand la carte est déplacées on demande les commerces, categories et sous cat qui correspondent a la nouvelle zone et on traite les données

  myMap.on('moveend', function (e) {
    bounds = myMap.getBounds();
    northWest = Object(_function_map_and_filter_js__WEBPACK_IMPORTED_MODULE_0__["roundCoord"])([bounds.getNorthWest()['lat'], bounds.getNorthWest()['lng']]);
    southEast = Object(_function_map_and_filter_js__WEBPACK_IMPORTED_MODULE_0__["roundCoord"])([bounds.getSouthEast()['lat'], bounds.getSouthEast()['lng']]);
    $.ajax({
      url: "/",
      method: "POST",
      data: {
        northWest: northWest,
        southEast: southEast
      },
      success: function success(response) {
        // traintement de la reponse
        if (response) {
          //création des nodes de categories et sous categories
          Object(_function_map_and_filter_js__WEBPACK_IMPORTED_MODULE_0__["createFilter"])(response); //ajout des animation aux nodes de categories

          Object(_function_map_and_filter_js__WEBPACK_IMPORTED_MODULE_0__["animateOpenCloseSousCat"])(); // associe les boutton avec leurs actions

          Object(_function_map_and_filter_js__WEBPACK_IMPORTED_MODULE_0__["bindFilters"])(window.catsChecked, window.sousCatsChecked);
        }
      },
      error: function error() {
        alert('la requette pour les commerces de cette zone n\'a pas fonctionné');
      }
    });
  });
});

/***/ }),

/***/ 1:
/*!***********************************!*\
  !*** multi ./resources/js/map.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\Utilisateur\Programmes\xampp\htdocs\www\baluchon\resources\js\map.js */"./resources/js/map.js");


/***/ })

/******/ });