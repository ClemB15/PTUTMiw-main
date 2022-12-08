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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/testAPIGouv.js":
/*!*************************************!*\
  !*** ./resources/js/testAPIGouv.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var itemsList = document.querySelector(".items");
var search = document.querySelector("#search");
var map = document.querySelector('#map');
var cities = [];
var url = ""; //////////////////////////////////////   AUTOCOMPLETE

var fetchImages = function fetchImages() {
  fetch(url).then(function (res) {
    res.json().then(function (res) {
      cities = res.features; // console.log(cities)

      showCities(cities);
    })["catch"](function (err) {
      return console.log(err);
    });
  })["catch"](function (err) {
    return console.log(err);
  });
};

var showCities = function showCities(arr) {
  clearItemsList();
  arr.forEach(function (_ref) {
    var properties = _ref.properties,
        geometry = _ref.geometry;
    var item = document.createElement('div');
    item.className = 'item';
    var content = document.createElement('div');
    content.className = 'content';
    content.innerHTML = properties.label;
    item.appendChild(content);
    item.addEventListener('click', function () {
      changeLocal([geometry.coordinates[1], geometry.coordinates[0]]);
      clearItemsList();
    });
    itemsList.appendChild(item);
  });
  items = document.getElementsByClassName('item');

  if (items.length > 0) {
    itemsList.style.padding = '45px 15px 15px';
  }
};

function autocomplete() {
  // si champ recherche pas vide on fait l appel, sinon on vide la liste
  if (search.value) {
    var adr = search.value.replace(/ /gi, '+');
    url = 'https://api-adresse.data.gouv.fr/search/?q=' + adr; // console.log(url)

    fetchImages();
  } else {
    clearItemsList();
  }
}

search.addEventListener('click', function () {
  autocomplete(); // eventlistener sur la barre de recherche

  search.addEventListener('keyup', function () {
    autocomplete();
  }); // eventlistener quand on clique autre part, pour masquer la liste

  document.addEventListener('mousedown', function _hide(e) {
    var target = e.target;

    if (!target.closest('.search-container')) {
      clearItemsList();
      document.removeEventListener('mousedown', _hide);
    }
  });
}); // vide la liste

function clearItemsList() {
  itemsList.innerHTML = '';
  itemsList.style.padding = '0px';
} // deplace la carte


function changeLocal(latlng) {
  var addrMark = latlng;
  myMap.setZoom(8);
  myMap.flyTo(latlng, 16, {
    animate: true,
    duration: 0.4 // in seconds

  });
}

/***/ }),

/***/ 3:
/*!*******************************************!*\
  !*** multi ./resources/js/testAPIGouv.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\cours\baluchon\PTUTMiw\resources\js\testAPIGouv.js */"./resources/js/testAPIGouv.js");


/***/ })

/******/ });