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

</head>
<body>
    <ul class="nav">
        <li class="active">
            <a href="#">Stat1</a>
        </li>
        <li>
            <a href="#">Stat2</a>
        </li>
        <li>
            <a href="#">Crédits</a>
        </li>
    </ul>

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
                        <input type='text' class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
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

