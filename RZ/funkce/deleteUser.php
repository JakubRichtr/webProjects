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
$rz->deleteUser($id);
