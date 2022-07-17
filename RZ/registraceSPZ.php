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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/registrace.css">
    <title>Reg Začka</title>
    <script src="js/rz.js"></script>
</head>
<body>

<form class="bigBox" id="bigBox">
    <div style="display: none;" id="stage" class="stage"></div>

    <div class="smallBox" name="form" id="smallBox" style="text-align:left">
        <!------------------------------------STAGE-1-------------------------------->
        <div class="box-stage-1" style="display: inline" id="box-stage-1">
            <h2>Registrační značka vozidla</h2>
            <div class="strip" >
                <div style="margin-bottom:10px;">RZ:<mark style="font-size: 10px">CZ</mark></div>
                <div class="inputSPZ" id="inputSPZ">
                    <label for="spz"></label><input placeholder="|" onkeyup="isValid(1,1)" style="text-transform:uppercase; display:inline;" id="spz1" name="mode_1" type="text">
                </div>
            </div>
        </div>
        <!--------------------------------------------------------------------------->
    </div>
    <div class="btn_div">
        <div class="hlaska" id="hlaska">Zadejte SPZ. </div>
        <div  id="btn_div"></div>
    </div>
</form>


</body>
</html>