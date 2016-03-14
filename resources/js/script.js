document.addEventListener("DOMContentLoaded", function(event) {
    //Remplissage du select des stations
    var elems = document.getElementById("listePostes").getElementsByTagName("li");
    var optionsList = "";
    for(var i=0; i<elems.length; i++){
        optionsList += "<option onclick='selectedView(\""+elems[i].dataset.id+"\")'" +
                        //" id='"+elems[i].dataset.id+"'" +
                        " value='"+elems[i].dataset.id+"'" +
                        ">"+elems[i].dataset.nom.replace("'", "&apos;") +
                        "</option>";
    }

    var form = document.getElementById("station");
    form.innerHTML = optionsList;
});

function selectedView(id){
    var poste = document.getElementById(id);
    setView(poste.dataset.latitude, poste.dataset.longitude);
}

function displayStat1(){
    var date = document.getElementById("datepicker").getElementsByTagName("input")[0].value;
    if(date == ""){
        alert("bad date");
        return;
    }
    date = date.split("-");
    var stationName = "";
    //On récupère le lieux + la date
    var stations = document.getElementById("station").getElementsByTagName("option");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            // on vide le tableau
            var tableBody = document.getElementById("stat1").getElementsByTagName("tbody");
            for(i = 0; i<tableBody[0].rows.length; i++){
                tableBody[0].deleteRow(i);
            }
            var i;
            for(i = 0; i< stations.length; i++){
                if(stations[i].value == document.getElementById("station").value){
                    stationName = stations[i].textContent;
                    break;
                }
            }
            //On affiche le titre
            document.getElementById("stat-title").innerHTML = "Statistique du " + date[2]+"/"+date[1]+"/"+date[0]+" pour "+stationName;

            //On recupere le resultat et on l'affiche
            var response = JSON.parse(xhttp.responseText);
            for (i = 0; i<response.length; i++){
                var row = tableBody[0].insertRow(-1);
                row.insertCell(-1).innerHTML = response[i].t;
                row.insertCell(-1).innerHTML = response[i].ff;
                row.insertCell(-1).innerHTML = response[i].u;
                row.insertCell(-1).innerHTML = response[i].n;
                row.insertCell(-1).innerHTML = response[i].rrN;
            }
        }
    };
    xhttp.open("GET", "core/stat1.php?station="+document.getElementById("station").value+"&year="+date[0]+"&month="+date[1]+"&day="+date[2], true);
    xhttp.send();
}