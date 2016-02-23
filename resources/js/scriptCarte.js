/**
 * Created by simon on 22/02/2016.
 */
window.addEventListener("load",dessinerCarte);

var map;

// fonction de mise en place de la carte.
// Suppose qu'il existe dans le document
// un Ã©lÃ©ment possÃ©dant id="cartecampus"
function dessinerCarte(){
    // crÃ©ation de la carte, centrÃ©e sur le point 50.60976, 3.13909, niveau de zoom 16
    // cette carte sera dessinÃ©e dans l'Ã©lÃ©ment HTML "cartecampus"
    map = L.map('carteCampus').setView([50.60976, 3.13909], 16);

    // ajout du fond de carte OpenStreetMap
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    $("#listePostes li").each(function() {
        L.marker([$(this).data("latitude"), $(this).data("longitude")]).addTo(map)
            .bindPopup($(this).data("nom")+"<br><button type='button' data-id='"+$(this).data("id")+"' value='"+$(this).data("nom")+"'>Choisir</button>");
    });



    // Mise en place d'une gestionnaire d'Ã©vÃ¨nement : activerBouton se dÃ©clenchera Ã  chaque ouverture de popup
    map.on("popupopen",activerBouton);

    // NB : map.on() est une mÃ©thode propre Ã  la bibliothÃ¨que Leaflet qui permet d'associer des gestionnaires
    // aux Ã©vÃ¨nements concernant la carte.
    map.on("click",afficheCoord);
}

// gestionnaire d'Ã©vÃ¨nement (dÃ©clenchÃ© lors de l'ouverture d'un popup)
// cette fonction va rendre actif le bouton inclus dans le popup en lui assocaint un gestionnaire d'Ã©vÃ¨nement
function activerBouton(ev) {
    var noeudPopup = ev.popup._contentNode; // le noeud DOM qui contient le texte du popup
    var bouton = noeudPopup.querySelector("button"); // le noeud DOM du bouton inclu dans le popup
    bouton.addEventListener("click",boutonActive); // en cas de click, on dÃ©clenche la fonction boutonActive
}

// gestionnaire d'Ã©vÃ¨nement (dÃ©clenchÃ© lors d'un click sur le bouton dans un popup)
function boutonActive(ev) {
    // this est ici le noeud DOM de <button>. La valeur associÃ©e au bouton est donc this.value
    //alert("Vous avez choisi : " + this.value);
    $('#station').find("option[value="+$(this).data("id")+"]").attr("selected", "selected");
}

function afficheCoord(ev) {
    alert(ev.latlng);
}

function setView(latitude, longitude){
    map.setView([latitude, longitude]);
}