<?php
session_start();

include_once ("../user/login.class.php");
$login=new login();
$jmeno=$_POST['jmeno'];
$prijmeni=$_POST['prijmeni'];
$vek=$_POST['vek'];
$email=$_POST['email1'];
$heslo=$_POST['heslo1'];
echo($jmeno);
echo($prijmeni);
echo($vek);
echo($email);
echo($heslo);
$login->registruj($jmeno,$prijmeni,$heslo,$vek,$email);
header("Location:../user/login.php");

