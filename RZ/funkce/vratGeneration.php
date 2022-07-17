<?php
session_start();
include_once '../rz.class.php';
$rz = new rz();
if ($_SESSION["prihlasen"]==false)  //když nejsem přihlášen
{
    unset($_SESSION['nickname']);
    header("Location: ../user/login.php");  //přesměrování
    exit();                               //doporučeno po přesměrování
}
$modelID=$_GET["modelID"];
$generations=$rz->vratGeneration($modelID);
echo("<option id='def_sel' value='def_sel' hidden disabled selected='selected'>Select</option>");
foreach ($generations as $gen) {
    echo("<option value='$gen->id_car_generation'>$gen->name</option>\n");
}
