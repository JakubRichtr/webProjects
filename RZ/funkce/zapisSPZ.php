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
$spz=strtoupper($_GET["spz"]);
$custom=$_GET["custom"];
if($_SESSION["prihlasen"]) {
    if (!$rz->spzRegisteredValue($spz)){
        $i = $rz->zapisSPZ($spz, $_SESSION['userID'], $custom);
        if ($i === true) {
            echo "1";
        } else {
            echo "0";
        }

    } else {
        echo "2";
    }
}
?>