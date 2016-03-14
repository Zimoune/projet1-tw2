<?php

define("LINK_MF", "compress.zlib://https://donneespubliques.meteofrance.fr/donnees_libres/Txt/Synop/Archive/synop.");
define("EXT", ".csv.gz");

include("proxySettings.php");

$station = "".$_GET["station"]."";
$year = "".$_GET["year"]."";
$month = "".$_GET["month"]."";
$day = "".$_GET["day"]."";
$row = 1;
$order = array();
$result = array();

$month = str_pad($month, 2, '0', STR_PAD_LEFT);
$day = str_pad($day, 2, '0', STR_PAD_LEFT);
    if(($handle = fopen(LINK_MF . $year . $month . EXT, "r")) !== FALSE){
        if(($data = fgetcsv($handle, 1000, ";")) !== FALSE){
            for ($c = 0; $c < count($data); $c++){
                array_push($order, $data[$c]);
            }
        }

        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                //Recuperation de la bonne station
                if($data[0] == $station && substr($data[1], 0, 8 ) == $year.$month.$day){
                    $tab = array();
                    for( $i = 0; $i < count($order); $i++){
                        $tab[$order[$i]] = $data[$i];
                    }
                    array_push($result, $tab);
                }
            }
            $row++;
        fclose($handle);
    }
echo json_encode($result);