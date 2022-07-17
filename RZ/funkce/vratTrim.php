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
$serieID=$_GET["serieID"];
$trims=$rz->vratTrims($serieID);
echo("<option id='def_sel' value='def_sel' hidden disabled selected='selected'>Select</option>");
foreach ($trims as $trim) {
    echo("<option value='$trim->id_car_trim'>$trim->name</option>\n");
}
