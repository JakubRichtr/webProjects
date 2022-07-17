<?php
include_once 'regform.class.php';
$street=new regform();
$attr=htmlspecialchars($_GET["param1"]);
$streets=$street->vratVsechnyObce($attr);
foreach ($streets as $obcicka) {
    echo '<option value="' . $obcicka->nazev . '">' . "\n";
}