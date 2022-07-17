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
$typeID=$_GET["typeID"];
$makes=$rz->vratMakes($typeID);
echo("<option id='def_sel' value='def_sel' hidden disabled selected='selected'>Select</option>");
foreach ($makes as $make) {
    echo("<option value='$make->id_car_make'>$make->name</option>\n");
}
