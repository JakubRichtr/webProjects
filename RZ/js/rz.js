car=[];
let spz;
// spz | type | make | model | generation | series | trim | is_spz_custom

stage=1;
let maxStage;

window.onload = function() {
    getStage();
};
function getStage(){
    maxStage = 2 //todo automatické číslování
    document.getElementById("stage").innerHTML=stage+"/"+maxStage;
}

//--------------------------------------------------------NAV-----------------------------------------------------------------
function back(){
    document.getElementById("box-stage-"+stage).style.display="none";
    stage--;
    document.getElementById("box-stage-"+stage).style.display="inline";
    getStage();

    document.getElementById("btn_div").innerHTML ="";
    if(stage ===1){
        document.getElementById("btn_div").innerHTML ="<button type='button' onclick='next()' id='next_btn' class='next_btn'>Next</button>";
        document.getElementById("bigBox").style.height="fit-content";
    }
}
function next(){
    if(stage===1){
        car[0]=spz;
        document.getElementById("btn_div").innerHTML = "<button type='button' onclick='back()' id='back_btn' class='back_btn'>Back</button>";
    }
    document.getElementById("hlaska").innerHTML= "Zadejte informace o autě."
    document.getElementById("box-stage-"+stage).style.display="none";
    stage++;
    document.getElementById("box-stage-"+stage).style.display="inline";
    getStage();

}
//-----------------------------------------------------------------------------------------------------------------------------


//------------------------------------------

// --------------STR1-----------------------------------------------------------------
function isValid(regMode,inputMode) { // regMode(0->normal reg || 1-> custom SPZ reg), inputMode(1->normal input || 2->select input)
    console.log("isValid("+regMode+","+ inputMode+")");
    const custom_key = /^[A-FHI-NPR-VXYZ0-9]{8}$/;
    const normal_key = /^[A-Z0-9][ABCEHJKLMPSTUZ][A-Z0-9][0-9]{3,4}$/i;


             if (inputMode === 1) {
                 spz = (document.getElementById("spz1").value).toUpperCase();
                 if (spz === "") {
                     document.getElementById("hlaska").innerHTML = "Zadejte SPZ.";
                     document.getElementById("btn_div").innerHTML = "";
                 }
                 var xmlhttp = new XMLHttpRequest();
                 xmlhttp.onreadystatechange = function () {
                     if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                         document.getElementById("hlaska").innerHTML = xmlhttp.responseText;

                         // tento kód se provede v okamžiku navrácení hodnoty ze serveru
                         if (xmlhttp.responseText === "1") {
                             document.getElementById("hlaska").innerHTML = "Značka již existuje";
                             document.getElementById("btn_div").innerHTML = ""

                         } else {
                             if (normal_key.test(spz) && regMode === 0) //testuje normal_key
                             {
                                 document.getElementById("hlaska").innerHTML = "Značka " + spz + " je platná a patří do kraje " + kraje(spz);
                                 document.getElementById("btn_div").innerHTML = "<button type='button' onclick='next()' id='next_btn' class='next_btn'>Next</button>"
                                 car[7] = 0;
                             } else {
                                 if (custom_key.test(spz)) //testuje custom_key
                                 {
                                     //pokud se registruje pouze custom SPZ ->regMode
                                     if (regMode === 0) {
                                         document.getElementById("btn_div").innerHTML = "<button type='button' onclick='next()' id='next_btn' class='next_btn'>Next</button>"
                                         car[7] = 1; //je custom
                                     }
                                     if (regMode === 1) {
                                         document.getElementById("btn_div").innerHTML = "<button type='button' onclick='zapisSPZ(spz,1);window.location.replace(\"https://lab.uzlabina.cz/~richtja/RZ/user/profile.php\")' id='next_btn' class='next_btn'>Zapiš</button>"
                                     }
                                     document.getElementById("hlaska").innerHTML = "Značka " + spz + " může být SPZ na přání";
                                 } else //ERROR
                                 {

                                     document.getElementById("hlaska").innerHTML = "Značka " + spz + " není platná RZ.";
                                     document.getElementById("btn_div").innerHTML = ""
                                 }
                             }
                         }
                     }
                 }
                 xmlhttp.open("GET", "vratSPZ.php?spz=" + spz, true);
                 xmlhttp.send();
             }



             if (inputMode === 2) {
                 spz = (document.getElementById("spz2").value).toUpperCase(); //načte hodnotu
                 if (spz === "") {
                     document.getElementById("hlaska").innerHTML = "Zadejte SPZ.";
                     document.getElementById("btn_div").innerHTML = "";
                 }

                 document.getElementById("hlaska").innerHTML = "SPZ";

                     document.getElementById("btn_div").innerHTML = "<button type='button' onclick='next()' id='next_btn' class='next_btn'>Next</button>"
                     car[7] = 1; //je custom


                     document.getElementById("hlaska").innerHTML = "Značka " + spz + " může být SPZ na přání";


             }


}
function kraje(rz){
    var text = "";
    switch(rz[1].toUpperCase()){
        case "A":
            text="Praha"
            break;
        case "B":
            text="Jihomoravského kraje"
            break;
        case "C":
            text="Jihočeského kraje"
            break;
        case "E":
            text="Pardubického kraje"
            break;
        case "H":
            text="Královéhradeckého kraje"
            break;
        case "J":
            text="Kraje Vysočina"
            break;
        case "K":
            text="Karlovarského kraje"
            break;
        case "L":
            text="Libereckého kraje"
            break;
        case "M":
            text="Olomouckého kraje"
            break;
        case "P":
            text="Plzeňského kraje"
            break;
        case "S":
            text="Středočeského kraje"
            break;
        case "T":
            text="Moravskoslezského kraje"
            break;
        case "U":
            text="Ústeckého kraje"
            break;
        case "Z":
            text="Zlínského kraje"
            break;
    }


    return text;
}
//------------------------------------------------------------------------------------------------------------------------------



//--------------------------------------------------------STR2-----------------------------------------------------------------
function select_value_change(s_id){

    let value= document.getElementById("select-"+s_id).value;
    car[s_id] = document.getElementById("select-" + s_id).value;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var text;
            switch(s_id+1){
                case 2:
                    text="Výrobce: ";
                    break
                case 3:
                    text="Model: ";
                    break
                case 4:
                    text="Generace: ";
                    break
                case 5:
                    text="Série: ";
                    break
                case 6:
                    text="Motor: ";
                    break;

            }
            document.getElementById("label"+(s_id+1)).innerHTML=text+"<br>";
            document.getElementById("sel_div"+(s_id+1)).innerHTML="<select onchange='select_value_change("+(s_id+1)+")' name='select-"+(s_id+1)+"' id='select-"+(s_id+1)+"'>";
            document.getElementById("select-"+(s_id+1)).innerHTML = xmlhttp.responseText;
        }
    }
    switch(s_id) {
        case 1:
            xmlhttp.open("GET", "funkce/vratMake.php?typeID="+value, true);
            break;
        case 2:
            xmlhttp.open("GET", "funkce/vratModel.php?makeID="+value, true);
            break;
        case 3:
            xmlhttp.open("GET", "funkce/vratGeneration.php?modelID="+value, true);
            break;
        case 4:
            xmlhttp.open("GET", "funkce/vratSeries.php?generationID="+value, true);
            break;
        case 5:
            xmlhttp.open("GET", "funkce/vratTrim.php?serieID="+value, true);
            break;
        case 6:
            console.log(car[6]);
            if(document.getElementById("select-1").value!=="Select" &&document.getElementById("select-2").value!=="Select"&&document.getElementById("select-3").value!=="Select"&&document.getElementById("select-4").value!=="Select"&&document.getElementById("select-5").value!=="Select"&&document.getElementById("select-6").value!=="Select") {
                document.getElementById("btn_div").innerHTML = "<button type='button' onclick='back()' id='back_btn' class='back_btn'>Back</button><button type='button' onclick='zapisSPZ(car[0],car[7]);zapisCAR();window.location.replace(\"https://lab.uzlabina.cz/~richtja/RZ/user/profile.php\")' id='next_btn' class='next_btn'>Finish</button>"
            }
            else{
                document.getElementById("btn_div").innerHTML = "<button type='button' onclick='back()' id='back_btn' class='back_btn'>Back</button>";
            }
            break;

    }
    if(s_id<6){xmlhttp.send();}

}
//-----------------------------------------------------------------------------------------------------------------------------

function zapisSPZ($spz,$custom) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            // tento kód se provede v okamžiku navrácení hodnoty ze serveru
            console.log("zapisSPZ");



            }

        }
    xmlhttp.open("GET", "funkce/zapisSPZ.php?spz=" + $spz+"&custom="+ $custom, true);
    xmlhttp.send();
}

function zapisCAR() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            // tento kód se provede v okamžiku navrácení hodnoty ze serveru
            console.log("zapisCar: "+xmlhttp.responseText);

        }
    }
    xmlhttp.open("GET", "funkce/zapisCar.php?spz=" + car[0] + "&type=" + car[1] + "&make=" + car[2] + "&model=" + car[3] + "&generation=" + car[4] + "&series=" + car[5] + "&trim=" + car[6], true);
    xmlhttp.send();
}
function changeMode(){
    if(document.getElementById("inputMode").checked){
        document.getElementsByName("mode_1")[0].style.display="none";
        document.getElementsByName("mode_2")[0].style.display="inline";
    }
    else {
        document.getElementsByName("mode_1")[0].style.display="inline";
        document.getElementsByName("mode_2")[0].style.display="none";
    }
}