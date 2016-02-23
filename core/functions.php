<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 22/02/2016
 * Time: 11:42
 */
define("LINK_MF", "compress.zlib://https://donneespubliques.meteofrance.fr/donnees_libres/Txt/Synop/Archive/synop.");
define("EXT", ".csv.gz");
define("LINK_POSTES", "../resources/postesSynop.csv");

include("proxySettings.php");

function getDatas($month, $year){
    $row = 1;
    if(($handle = fopen(LINK_MF . $year . $month . EXT, "r")) !== FALSE){
       // echo fread($handle,filesize(LINK_MF . $year . $month . EXT));
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $num = count($data);
            echo "<p> $num champs à la ligne $row: <br /></p>\n";
            $row++;
            for ($c=0; $c < $num; $c++) {
                echo $data[$c] . "<br />\n";
            }
        }
        fclose($handle);
    }
}

function getPostes(){
    $row = 1;
    if(($handle = fopen(LINK_POSTES, "r")) !== FALSE){
        while (($data = fgetcsv($handle,1000, ';')) !== FALSE) {
            if($row != 0){
                $num = count($data);
                for ($c=0; $c < $num; $c++) {
                    echo $data[$c] . "<br />\n";
                }
            }
            $row++;
        }
        fclose($handle);
    }
}


getDatas('01', '2016');
//getPostes();
?>