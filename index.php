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
    <meta name="author" content="Simon Le Pallac">

    <link href="resources/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
    <link rel="stylesheet" href="resources/css/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="resources/css/style.css" />

    <!-- JS -->
    <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>

</head>
<body>

<div class="container-fluid">
    <ul id="listePostes">
        <?php

        displayPostes();

        ?>
    </ul>

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
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
                   <!-- <button>Stat 2</button>-->
                </div>
            </div>
        </div>
        <div class="col-md-6">
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
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
                <div id="carteCampus"></div>
        </div>
    </div>
</div>

<script src="//code.jquery.com/jquery-2.2.0.min.js"></script>
<script src="resources/js/moment.min.js"></script>
<script src="resources/js/bootstrap.min.js"></script>
<script src="resources/js/bootstrap-datepicker.min.js"></script>
<script src="resources/js/scriptCarte.js"></script>
<script src="resources/js/script.js"></script>
</body>
</html>

