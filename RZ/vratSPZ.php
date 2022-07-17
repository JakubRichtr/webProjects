<?php
session_start();
if ($_SESSION["prihlasen"]==false)  //když nejsem přihlášen
{
    unset($_SESSION['nickname']);
    header("Location: user/login.php");  //přesměrování
    exit();                               //doporučeno po přesměrování
}
include_once 'rz.class.php';
$rz = new rz();
$spz=$_GET["spz"];

echo($rz->rzExists($spz));
