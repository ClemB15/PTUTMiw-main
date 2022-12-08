const itemsList = document.querySelector(".items")
const search = document.querySelector("#search")
const map = document.querySelector('#map');

let cities = []
let url ="";


//////////////////////////////////////   AUTOCOMPLETE
const fetchImages = () => {
    fetch(url)
        .then(res => {
            res
                .json()
                .then(res => {
                    cities = res.features

                    // console.log(cities)

                    showCities(cities)
                })
                .catch(err => console.log(err))
        })
        .catch(err => console.log(err))
}


const showCities = arr => {
    clearItemsList()
    arr.forEach(
        ({ properties, geometry }) => {
            let item = document.createElement('div')
            item.className = 'item'
            let content = document.createElement('div')
            content.className  = 'content'
            content.innerHTML = properties.label

            item.appendChild(content)
            item.addEventListener('click', function () {
                changeLocal([geometry.coordinates[1], geometry.coordinates[0]])
                clearItemsList()
            })
            itemsList.appendChild(item)
    })

    items = document.getElementsByClassName('item')
    if (items.length > 0) {
        itemsList.style.padding = '45px 15px 15px';
    }

}

function autocomplete() {
    // si champ recherche pas vide on fait l appel, sinon on vide la liste
    if (search.value) {
        let adr = search.value.replace(/ /gi, '+');
        url = 'https://api-adresse.data.gouv.fr/search/?q=' + adr;
        // console.log(url)
        fetchImages()

    } else {
        clearItemsList()
    }
}

search.addEventListener('click', function (){
    autocomplete()

    // eventlistener sur la barre de recherche
    search.addEventListener('keyup', () => {
        autocomplete()
    });

    // eventlistener quand on clique autre part, pour masquer la liste
    document.addEventListener('mousedown', function _hide(e) {
        let target = e.target
        if (!target.closest('.search-container')) {
            clearItemsList()
            document.removeEventListener('mousedown', _hide)
        }
    })
})

// vide la liste
function clearItemsList() {
    itemsList.innerHTML = '';
    itemsList.style.padding = '0px';
}

// deplace la carte
function changeLocal(latlng){
    let addrMark = latlng;
    myMap.setZoom(8);
    myMap.flyTo(latlng, 16, {
        animate: true,
        duration: 0.4 // in seconds

      });
}
