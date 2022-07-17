<?php
session_start();
if ($_SESSION["prihlasen"]==false)  //když nejsem přihlášen
{
    unset($_SESSION['nickname']);
    header("Location: ../user/login.php");  //přesměrování
    exit();                               //doporučeno po přesměrování
}
include_once '../rz.class.php';
$rz = new rz();
$generationID=$_GET["generationID"];
$series=$rz->vratSeries($generationID);
echo("<option id='def_sel' value='def_sel' hidden disabled selected='selected'>Select</option>");
foreach ($series as $serie) {
    echo("<option value='$serie->id_car_serie'>$serie->name</option>\n");
}
