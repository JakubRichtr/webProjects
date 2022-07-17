<?php
session_start();
if ($_SESSION["prihlasen"]==false)  //když nejsem přihlášen
{
    unset($_SESSION['nickname']);
    header("Location: ../user/login.php");  //přesměrování
    exit();                               //doporučeno po přesměrování
}
include_once ('../rz.class.php');
$rz = new rz();
$spz=$_GET["spz"];
$type=$_GET["type"];
$make=$_GET["make"];
$model=$_GET["model"];
$generation=$_GET["generation"];
$series=$_GET["series"];
$trim=$_GET["trim"];
if($_SESSION['prihlasen']){
    $i=$rz->zapisCar($_SESSION['userID'], $spz, $type,$make,$model,$generation,$series,$trim);
    if($i===true){
        echo "1";
    }
    else{
        echo "0";
    }

}
else{
    echo "2";
}
