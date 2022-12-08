(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./resources/js/filters.js":
/*!*********************************!*\
  !*** ./resources/js/filters.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// permet la declaration au debut de la page, dans le head
window.addEventListener('load', function () {
  toggleAndAnimateFilters();
}); // gere les aniation et changement d etat des categories et sous categories

function toggleAndAnimateFilters() {
  var btnOpenFilter = document.getElementById('filter-btn');
  var filterContent = document.getElementsByClassName('filter-content')[0];
  var btnCloseFilter = document.getElementsByClassName('btn-down-filter')[0]; // durré des animations

  var animDuration = 500; // en cliquant sur le btn des filtres la fenettre des filtres s'ouvre (avec l'animation)

  btnOpenFilter.addEventListener('click', function (e) {
    filterContent.animate([// keyframes
    {
      transform: 'translateY(' + filterContent.clientHeight + 'px)',
      visibility: 'hidden'
    }, {
      transform: 'translateY(0px)',
      visibility: 'visible'
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
            transform: 'translateY(' + filterContent.clientHeight + 'px)',
            visibility: 'hidden'
          }, {
            transform: 'translateY(0px)',
            visibility: 'visible'
          }], {
            // timing options
            duration: animDuration,
            fill: 'forwards',
            direction: 'reverse',
            easing: 'ease-in-out'
          });
          document.removeEventListener('click', _hide);
        }
      });
    }, animDuration);
  }); // changer la couleur de la categorie si elle est cliquée, et l'ajouter a la liste des categories cliquées

  var catSection = document.getElementsByClassName('categorie-section'); // declaration des deux variables globales pour les utiliser dans d autres fichier

  window.catsChecked = [];
  window.sousCatsChecked = [];

  var _loop = function _loop(i) {
    var btnCat = catSection[i].getElementsByClassName('categorie')[0];
    var btnSCat = catSection[i].getElementsByClassName('sous-categorie'); // listenner des categories

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

      displayCurrentFilter(window.catsChecked, window.sousCatsChecked);
      console.log(catsChecked);
      console.log(sousCatsChecked);
    }); // listenner des sous categories

    for (var j = 0; j < btnSCat.length; j++) {
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

  var btnToggleCat = document.getElementsByClassName('toggle-cat');
  var categorieSection = document.getElementsByClassName('categorie-section');
  var sousCatContent = document.getElementsByClassName('sous-categorie-content'); // pour chaque div categorie-section et sous-categorie-content, ajout d un eventlistenner avec aniation show ou hide

  var _loop2 = function _loop2(_i) {
    // categories FERMEE au debut
    var showSousCat = 0; // si la categorie a des sous categories on les animes

    if (sousCatContent[_i]) {
      var hauteur = parseInt(window.getComputedStyle(sousCatContent[_i]).marginTop) + sousCatContent[_i].clientHeight;

      btnToggleCat[_i].addEventListener('click', function () {
        if (!showSousCat) {
          // OUVERTURE 
          this.style.transform = "rotate(90deg)"; // anim de la categorie

          categorieSection[_i].animate([// keyframes
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


          sousCatContent[_i].animate([// keyframes
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

          categorieSection[_i].animate([// keyframes
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

          sousCatContent[_i].animate([// keyframes
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
          });

          showSousCat = 0;
        }
      });
    }
  };

  for (var _i = 0; _i < btnToggleCat.length; _i++) {
    _loop2(_i);
  }
} // parcours les categories et sous categorie selectionnées et affiche les marqueurs correspondants


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

/***/ })

}]);