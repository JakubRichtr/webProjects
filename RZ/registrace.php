<?php
session_start();
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
    <div id="stage" class="stage"></div>

    <div class="smallBox" name="form" id="smallBox" style="text-align:left">
        <!------------------------------------STAGE-1-------------------------------->
        <div class="box-stage-1" style="display: inline" id="box-stage-1">
            <h2>Registrační značka vozidla</h2>
            <div class="strip" >
                <div style="margin-bottom:10px;">RZ:<mark style="font-size: 10px">CZ</mark></div>
                <div class="inputSPZ" id="inputSPZ">
                    <!---MODE_1-------------------------------------------------------------->
                    <label for="spz"></label><input placeholder="|" onkeyup="isValid(0,1)" style="text-transform:uppercase; display:inline;" id="spz1" name="mode_1" type="text">
                    <!----------------------------------------------------------------------->
                    <!---MODE_2-------------------------------------------------------------->
                    <label for="mode_2"></label>
                    <select style="display:none" id="spz2" name="mode_2" onchange="isValid(0,2)">
                        <?php
                        $allSpz=$rz->vratOwnerSPZ($_SESSION["userID"]);
                        echo("<option id='def_sel' value='' hidden disabled selected='selected'>Select</option>");
                        foreach ($allSpz as $spz) {
                            if ($spz->isCustom == 1 && $rz->spzRegisteredID($spz->id)==false) {
                                echo("<option value='$spz->value'>$spz->value</option>");
                            }
                        }
                        ?>
                    </select>
                    <!----------------------------------------------------------------------->
                </div>
            </div>
            <div class="modeChanger">
            <label class="inputModeLabel" for="inputMode">Custom SPZ: </label><input style="text-align:center" class="checkbox" type="checkbox" id="inputMode" onchange="changeMode()">
            </div>
        </div>
        <!--------------------------------------------------------------------------->

        <!------------------------------------STAGE-2-------------------------------->
        <div style="display: none" class="box-stage-2" id="box-stage-2">
            <h2>Registrace vozidla</h2>
                <div class="strip">
                    <ul style="text-align: center;list-style-type:none;">
                        <li id="label1">Typ:</li>
                        <li><div id="sel_div1">
                            <select value="Type" onchange="select_value_change(1)" name="select-1" id="select-1">
                            <?php
                                $types=$rz->vratTypes();
                                echo("<option id='def_sel' value='' hidden disabled selected='selected'>Select</option>");
                                foreach($types as $type){
                                echo("<option value='$type->id_car_type'>$type->name</option>");
                                }
                            ?>
                            </select></div></li>

                <li id="label2"></li>
                <li><div id="sel_div2"></div></li>
                <li id="label3"></li>
                <li><div id="sel_div3"></div></li>
                <li id="label4"></li>
                <li><div id="sel_div4"></div></li>
                <li id="label5"></li>
                <li><div id="sel_div5"></div></li>
                <li id="label6"></li>
                <li><div id="sel_div6"></div></li>
                </ul>
            </div>
        </div>
        <!----------------------------------------------------------------------------->
    </div>
    <div class="btn_div">
        <div class="hlaska" id="hlaska">Zadejte SPZ. </div>
        <div  id="btn_div"></div>
    </div>
</form>


</body>
</html>