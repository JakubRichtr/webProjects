<?php
include_once 'regform.class.php';
$street=new regform();
$attr=htmlspecialchars($_GET["param1"]);
$streets=$street->vratVsechnyUlice($attr);
foreach ($streets as $ulicka) {
    echo '<option value="' . $ulicka->nazev . '">' . "\n";
}