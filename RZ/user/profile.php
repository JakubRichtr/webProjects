<?php
session_start();
include_once ("../rz.class.php");
$rz=new rz();
if ($_SESSION["prihlasen"]==false)  //když nejsem přihlášen
{
    unset($_SESSION['nickname']);
    header("Location: login.php");  //přesměrování
    exit();                               //doporučeno po přesměrování


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Play&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/profile.css">
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <title>Profil</title>
    <script src="../js/index.js"></script>
</head>
<body>
<!----------------------NAV----------------------->
<button class="nav_show" id="nav_show_btn" onclick="navShow()"><div id="rot_text" class="rot_text">➤</div></button>
<div class="nav" id="nav" style="left: -87px">
    <div class="nav_header" id="nav_header">
        <div>RegCar</div>
    </div>
    <div class="nav_body">
        <button class='button-nav' onclick='location.href="../index.php"'>Domů</button>
        <?php
        if($_SESSION['userID']!=1) {
            echo("<button class='button-nav' onclick='location.href=\"../registrace.php\"'>Registrace Auta</button>
        <button class='button-nav' onclick='location.href=\"../registraceSPZ.php\"'>Registrace SPZ</button>");
        }
        ?>
        <button class='button-nav' onclick='location.href="logout.php"'>Odhlásit</button>
    </div>
</div>
<!------------------------------------------------>
<div  id="parent" class="parent">
    <!-------------------------Vítání----------------->
    <div class="div1">
        <h1>Vítejte <?php echo($_SESSION["nickname"])?></h1>
    </div>
    <!------------------------------------------------>




    <!-------------------------AUTA------------------->
    <?php
    if($_SESSION['userID']==1){ //admin
    echo("
        <div class='upperPart'>
            <div class='search-box'> 
                <h2>Vyhledávání</h2>
                <input onkeyup='search()' id='searchValue' class='search' type='text'>
                <select class='mode-select' name='type' id='searchType' onchange='search()'>
                    <option  selected='selected' value='1'>SPZ</option>
                    <option value='2'>Jméno</option>              
                
                </select>
            </div>  
        </div>
        <div class='lowerPart' id='lowerPart'>
        
        
        </div>

");
    }



    else{ //user
    echo("<div class='div2'>
        <h2 class='h2-box1'>Vaše auta</h2>");

             $cars=$rz->vratOwnerCarsFromID($_SESSION["userID"]);
            foreach ($cars as $car){
                $spz=$rz->vratCarSPZ($car->spz_id);
                echo("<div class='cell' id='car_$car->id' >")
            ?>

                <div class='deleteButton'><img onclick='showDeleteForm(<?php echo($car->id)?>,1,<?php echo($spz[0]->id)?>)' class='deleteIcon' src='../assets/trash.png'></div>

            <?php
                echo("
                <div class='showRow'>".$rz->vratCarMake($car->car_make_id)." ".$rz->vratCarModel($car->car_model_id) ."</div>
                    <table class='values' style='margin-left: -1.5%;'>
                        <tr>
                            <th class='label' >SPZ:</th>
                            <th class='value'>".$spz[0]->value."</th>
                        </tr>
                        <tr>
                            <th class='label'>Gen:</th>
                            <th class='value'>".$rz->vratCarGeneration($car->car_generation_id)."</th>
                        </tr>
                        <tr>
                            <th class='label'>Serie:</th>
                            <th class='value'>".$rz->vratCarSerie($car->car_serie_id)."</th>
                        </tr>
                        <tr>
                            <th class='label'>Motor:</th>
                            <th class='value'>".$rz->vratCarTrim($car->car_trim_id)."</th>
                        </tr>
                </table>
                </div>
                ");
            }



    echo("</div>");

    echo("<!------------------------------------------------>");

    echo("<!----------------------SPZ------------------------>");
    echo("<div class='div3 '>
        <h2 class='h2-box2'>Vaše SPZ na přání</h2>");
        $allSpz=$rz->vratOwnerSPZ($_SESSION["userID"]);
        foreach ($allSpz as $spz)
        {
            if ($spz->isCustom == 1) {
                $car=$rz->vratCarPodleSPZ($spz->id);
                echo("<div class='cell' id='spz_$spz->id'>")
        ?>
                <div class='deleteButton'><img onclick='showDeleteForm(<?php echo($spz->id)?>,2,<?php echo($car[0]->id)?>)' class='deleteIcon' src='../assets/trash.png'></div>
        <?php
                echo("
                    <div class='showRow'>" . $rz->vratSPZvalue($spz->id) . "</div>
                        <table class='values' style='margin-left: -9%;'>
                            <tr>
                                <th class='label' >Reg. datum:</th>
                                <th class='value'>" . $spz->registration_date . "</th>
                            </tr>
                            <tr>
                                <th class='label' >Car info:</th>");

                            if($rz->vratCarMake($car[0]->car_make_id)!==null)
                            {
                                echo("<th id='spzCarName_$spz->id' class='value'>".$rz->vratCarMake($car[0]->car_make_id)." ".$rz->vratCarModel($car[0]->car_model_id)."</th>");
                            }
                            else
                            {
                                echo("<th class='value'>NENÍ REGISTROVÁNO</th>");
                            }

                            echo("
                        </tr>
                </table>
                </div>
                ");
            }
            }
    echo("</div>
    </div>
");
    }
    ?>
    <!------------------------------------------------>

</div>
</body>

<div class="deleteForm" id="deleteForm"></div>
</html>
