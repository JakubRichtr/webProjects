<?php
session_start();
include_once("rz.class.php");
$rz=new rz();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Play&display=swap" rel="stylesheet">
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <title>Reg Začka</title>
    <script src="js/index.js"></script>
</head>
<body>


<button class="nav_show" id="nav_show_btn" onclick="navShow()"><div id="rot_text" class="rot_text">➤</div></button>
<div class="nav" id="nav" style="left: -87px">
    <div class="nav_header" id="nav_header">
        <div>RegCar</div>
    </div>
    <div class="nav_body">
        <button class="button-nav" onclick="location.href='user/profile.php'"><?php if($_SESSION["prihlasen"]){echo("Profil");} else{echo("Přihlásit");}?></button>
        <?php
        if($_SESSION["prihlasen"]){
            if($_SESSION['userID']!=1) {
                echo("<button class='button-nav' onclick='location.href=\"registrace.php\"'>Registrace Auta</button>
                      <button class='button-nav' onclick='location.href=\"registraceSPZ.php\"'>Registrace SPZ</button>");
            }
            echo("<button class='button-nav' onclick='location.href=\"user/logout.php\"'>Odhlásit</button>");

        }
        if(!$_SESSION["prihlasen"]){
            echo("<button class='button-nav' onclick='location.href=\"user/ownerReg.php\"'>Registrace</button>");
        }
        ?>
    </div>
</div>


<div  id="parent" class="parent">
    <div class="div1">
        <h1>Vítejte na...</h1>
    </div>

    <div class="div2">
        <h2 class="h2-box1">Poskytujeme...</h2>
        <ul>
            <li>Vytvoření profilu pro uchování všech dat.</li>
            <li>Možnost registrace nové SPZ.</li>
            <li>Možnost vytvoření a registrace custom SPZ.</li>
            <li>Správa svých vozidel na přehledném profilu.</li>
            <li>Správa custom SPZ.</li>
            <li>Informace o svém autě vyberete z předvolené databáze.</li>
            <li style="margin-top:15px; list-style-type: none; padding-left: 28%;">~~~~PŘIPRAVUJE~~SE~~~~ </li>
            <li>~ Select na custom PSZ při registraci auta. ~</li>
            <li>~ "Policejní mód" -> vyhledávání pomocí PSZ (Admin). ~</li>
            <li>~ Scrolling. ~</li>
        </ul>
    </div>

    <div class="div3 ">
        <h2 class="h2-box2" >O nás...</h2>
        <ul>
            <li>Nedobrovolně neziskový školní projekt.</li>
            <li>Design stránky, včetně animací, je dělaný bez frameworků a externích knihoven.</li>
            <li style="list-style-type: none; padding-left: 15px">➜ Mimo load animace, které jsou z <a href="https://animate.style/">knihovny</a>.</li>
            <li>Použitá databáze aut: <a href="https://car2db.com/">zde</a>.</li>
        </ul>
    </div>



    <div class="div4">
        <center>
        <h2>Pojďme na to...</h2>
        <div>
            <?php
            if($_SESSION["prihlasen"]){
                 echo("<form class='form-box' action='registrace.php'>");
                 echo("    <button class='buttonReg'>Registrace Auta</button>");
                 echo("</form>");

                }
            else {
                echo("<form class='form-box' action='user/ownerReg.php'>");
                echo("    <button class='buttonReg'>Registrace</button>");
                echo("</form>");
                echo("    <a style='color:rgb(130, 158, 173);' href='user/login.php'>Už máte učet?</a>");
            }
        ?>
        </div>
        </center>
    </div>
            <div class="div5 ">
                <img src="assets/regcar.png" alt="">
            </div>

</body>

</html>