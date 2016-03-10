<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 22/02/2016
 * Time: 11:12
 */

define("LINK_POSTES", "resources/postesSynop.csv");


function displayPostes(){
    $row = 1;
    $tab = [
        0 => "ID",
        1 => "Nom",
        2 => "Latitude",
        3 => "Longitude",
        4 => "Altitude"
    ];

    if(($handle = fopen(LINK_POSTES, "r")) !== FALSE){
        while (($data = fgetcsv($handle,1000, ';')) !== FALSE) {

            if($row != 1){
                $num = count($data);
                echo "<li id='". $data[0] ."'";
                for ($c=0; $c < $num; $c++) {
                    echo " data-". $tab[$c] . "=\"" .$data[$c] . "\"";
                }
                echo "></li>";
            }

            $row++;
        }
        fclose($handle);
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Projet météo</title>

    <meta name="description" content="Projet S4 TW2">
    <meta name="author" content="Simon Le Pallac & Valentin Poupart">

    <!-- CSS -->
    <link rel="stylesheet" href="resources/css/style.css" />
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.png" type="image/png">
    <link rel="icon" sizes="32x32" href="resources/img/favicons/favicon-32.png" type="image/png">
    <link rel="icon" sizes="64x64" href="resources/img/favicons/favicon-64.png" type="image/png">
    <link rel="icon" sizes="96x96" href="resources/img/favicons/favicon-96.png" type="image/png">
    <link rel="icon" sizes="196x196" href="resources/img/favicons/favicon-196.png" type="image/png">
    <link rel="apple-touch-icon" sizes="152x152" href="resources/img/favicons/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="60x60" href="resources/img/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="resources/img/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="resources/img/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="resources/img/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="resources/img/favicons/apple-touch-icon-144x144.png">
    <meta name="msapplication-TileImage" content="resources/img/favicons/favicon-144.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">

    <!-- JS -->
    <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>

</head>
<body>
<nav>
            <a href="#">Stat1</a>
            <a href="#">Stat2</a>
            <a href="#">Crédits</a>
</nav>
    <ul id="listePostes">
        <?php

        displayPostes();

        ?>
    </ul>

                    <form id="formStation">
                        <select id="station" name="slist" size="10" form="formStation">

                        </select>
                    </form>
                    <div class='input-group date' id='datepicker'>
                        <input type='date' name="date" class="form-control" />
                    </div>
                    <button onclick="displayStat1()">Stat 1</button>
            <h3 id="stat-title">Statistiques</h3>
            <table id="stat1" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>
                        Température (K)
                    </th>
                    <th>
                        Vitesse du vent (m/s)
                    </th>
                    <th>
                        Humidité (%)
                    </th>
                    <th>
                        Nébulosité totale (%)
                    </th>
                    <th>
                        Précipitations (mm)
                    </th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div id="carteCampus"></div>

<script src="resources/js/scriptCarte.js"></script>
<script src="resources/js/script.js"></script>
</body>
</html>

