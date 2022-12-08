
window.addEventListener('load', function () {
    toggleAndAnimateFilters()
})
let clicked = 0

function toggleAndAnimateFilters() {

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
                visibility: 'hidden'
            },
            {
                transform: 'translateY(0px)',
                visibility: 'visible'
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
                            transform: 'translateY(' + filterContent.clientHeight + 'px)',
                            visibility: 'hidden'
                        },
                        {
                            transform: 'translateY(0px)',
                            visibility: 'visible'
                        }
                    ], {
                        // timing options
                        duration: animDuration,
                        fill: 'forwards',
                        direction: 'reverse',
                        easing: 'ease-in-out'
                        
                    });
                    document.removeEventListener('click', _hide)
                }
            })
        }, animDuration);


    })

    // changer la couleur de la sous-categorie si elle est cliquée, et l'ajouter a la liste des sousCat cliquées
    let btnSCat = document.getElementsByClassName('sous-categorie');
    let sousCatChecked = []
    for (let i = 0; i < btnSCat.length; i++) {
        btnSCat[i].addEventListener('click', function () {
            this.classList.toggle("sousCat-checked");
            // si il est checked on lajoute dans la liste de categorie
            if(this.classList.value.includes('sousCat-checked') && !sousCatChecked.includes(btnSCat[i].innerHTML)){
                sousCatChecked.push(btnSCat[i].innerHTML)
            } else {
                // sinon on l'y enleve
                let index = sousCatChecked.indexOf(btnSCat[i].innerHTML);
                if (index > -1) {
                    sousCatChecked.splice(index, 1);
                }
            }
            // actualisation de la carte pour afficher en fonction des filtres
            // console.log(sousCatChecked);
        })   
    }


    let btnToggleCat   = document.getElementsByClassName('toggle-cat')
    let categorieSection   = document.getElementsByClassName('categorie-section')
    let sousCatContent = document.getElementsByClassName('sous-categorie-content')

    // pour chaque div categorie-section et sous-categorie-content, ajout d un eventlistenner avec aniation show ou hide
    for (let i = 0; i < btnToggleCat.length; i++) {

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
                        height: '60px'
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

            
            }else{
                // FERMETURE 
                this.style.transform = "rotate(0deg)";

                categorieSection[i].animate([
                    // keyframes
                    {
                        height: '60px'
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

                showSousCat = 0
            }
        })   
    }
}


