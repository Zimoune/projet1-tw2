/**
 * Created by simon on 22/02/2016.
 */
$( document ).ready(function() {

    //Remplissage du select des stations
    $("#listePostes li").each(function() {
        $("#formStation select").append("<option onclick='selectedView($(this))' id='"+$(this).data("id")+"' value='"+$(this).data("id")+"' >"+$(this).data("nom")+"</option>");
    });

    var today = new Date();

    $('#datepicker').datepicker({
        format: "dd/mm/yyyy",
        startDate: "01/01/1996",
        endDate: today.getDate()+"/"+(today.getMonth()+1)+"/"+today.getFullYear(),
        language: "fr"
    });

});

function selectedView(elem){
    var poste = $('li#'+$(elem).val());
    setView($(poste).data("latitude"), $(poste).data("longitude"));
}

function displayStat1(){
    var date = $('#datepicker').datepicker('getDate');
    if( date == null){
        alert("Merci de selectionner une date valide")
        return;
    }

    $.ajax({
        url: "core/stat1.php",
        data: {
            station: $("#station").val(),
            year: date.getFullYear(),
            month: date.getMonth()+1,
            day: date.getDate()
        },
        type: "get",
        dataType: "json"
    }).done(function(result) {
        //On vide le tableau
        var elem = $("table#stat1 tbody");
        $(elem).empty();
        //On change le titre
        $("h3#stat-title").text("Statistiques du "+date.getDate()+"/"+
            (date.getMonth()+1)+"/"+date.getFullYear()+" pour "+
            $('#station').find("option[value='"+$("#station").val()+"']+").text());

        //On le remplis
        $.each(result, function(i, res){
            $(elem).append("<tr>" +
                "<td>"+res.t+"</td>" +
                "<td>"+res.ff+"</td>"+
                "<td>"+res.u+"</td>"+
                "<td>"+res.n+"</td>"+
                "<td>"+res.rrN+"</td></tr>");
        })


    }).fail(function(){
        alert("une erreur est survenue");
    });
}