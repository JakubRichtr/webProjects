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
$makeID=$_GET["makeID"];
$models=$rz->vratModel($makeID);
echo("<option id='def_sel' value='def_sel' hidden disabled selected='selected'>Select</option>");
foreach ($models as $model) {
    echo("<option value='$model->id_car_model'>$model->name</option>\n");
}
