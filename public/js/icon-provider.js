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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

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

/***/ 2:
/*!*********************************************!*\
  !*** multi ./resources/js/icon-provider.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\cours\baluchon\PTUTMiw\resources\js\icon-provider.js */"./resources/js/icon-provider.js");


/***/ })

/******/ });