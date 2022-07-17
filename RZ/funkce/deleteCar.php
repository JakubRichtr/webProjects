<?php
session_start();
include_once '../rz.class.php';
if ($_SESSION["prihlasen"]==false)  //když nejsem přihlášen
{
    unset($_SESSION['nickname']);
    header("Location: ../user/login.php");  //přesměrování
    exit();                               //doporučeno po přesměrování
}
$rz = new rz();
$id=$_GET["id"];
$car=$rz->vratCarPodleID($id);
$spz=$rz->vratCarSPZ($car[0]->spz_id);
if(($spz[0]->isCustom)==0){
    $rz->deleteSPZ($spz[0]->id);
}
$rz->deleteCar($id);
