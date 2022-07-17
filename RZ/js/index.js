function loginEntered() {
    if(document.getElementById("nameInput").value!=="" && document.getElementById("passInput").value!==""){
        document.getElementById("btn_div").innerHTML = "<button class='loginBtn'  name='prihlas' type='submit' onclick='location.href =\" \"'>Login</button>"
    }
    else{
        document.getElementById("btn_div").innerHTML="";
    }
}
function navShow() {
    if(document.getElementById("nav").style.left<="0"){
        document.getElementById("nav").style.boxShadow= "4px 0px 23px 5px #000000";
        document.getElementById("nav").style.left="0";
        document.getElementById("rot_text").style.transform= "rotate(180deg)";
        document.getElementById("nav_show_btn").style.marginLeft="85px";
        document.getElementById("parent").style.filter="blur(5px)"

    }
    else{
        document.getElementById("nav").style.boxShadow= "none";
        document.getElementById("nav").style.left="-87px";
        document.getElementById("nav_show_btn").style.marginLeft="0px";
        document.getElementById("rot_text").style.transform= "rotate(0deg)";
        document.getElementById("parent").style.filter="none"


    }
}
function closeDeleteForm(){
    document.getElementById("parent").style.filter="none";
    document.getElementById("deleteForm").innerHTML="";
    document.getElementById("deleteForm").style.display="none";
    setTimeout(function() {
        document.getElementById("parent").style.pointerEvents= "Auto";
    }, 500);

}
function showDeleteForm(id,type,extraID=0){
        document.getElementById("parent").style.pointerEvents = "none";
        document.getElementById("parent").style.filter = "blur(5px) grayscale(50%)";
        let form = document.getElementById("deleteForm");
        form.style.display = "inline";
    if(type===1) {
        form.innerHTML = "<div class='upBox'>Opravdu chcete odstranit toto auto?</div>" +
            "<button style='bottom: 30px;' class='btn_1' onclick='closeDeleteForm()'>Zrušit</button>" +
            "<button style='bottom: 0;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;' class='btn_1' type='button' onclick='deleteCar(" + id +","+extraID+ ")'>Ano</button>"
    }
    if(type===2){
        form.innerHTML = "<div class='upBox'>Opravdu chcete odstranit tuto SPZ?</div>" +
            "<button style='bottom: 30px;' class='btn_1' onclick='closeDeleteForm()'>Zrušit</button>" +
            "<button style='bottom: 0;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;' class='btn_1' type='button' onclick='deleteSPZ(" + id + "," +extraID + ")'>Ano</button>"
    }
    if(type===3){
        form.innerHTML = "<div class='upBox'>Opravdu chcete odstranit tohoto uživatele?</div>" +
            "<button style='bottom: 30px;' class='btn_1' onclick='closeDeleteForm()'>Zrušit</button>" +
            "<button style='bottom: 0;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;' class='btn_1' type='button' onclick='deleteUser(" + id +")'>Ano</button>"
    }
}

function deleteCar(id,spzID) {
    let car = document.getElementById("car_" + id);
    if(car!==null) {
        car.remove();
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("spzCarName_"+spzID).innerHTML="NENÍ REGISTROVÁNO"
                closeDeleteForm();

            }
        }
        xmlhttp.open("GET", "../funkce/deleteCar.php?id=" + id, true);
        xmlhttp.send();
    }
}
function deleteSPZ(id,carID) {
    let spz = document.getElementById("spz_" + id);
    spz.remove();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            deleteCar(carID);
            closeDeleteForm();
        }
    }
    xmlhttp.open("GET", "../funkce/deleteSPZ.php?id=" + id, true);
    xmlhttp.send();

}
function deleteUser(id) {

    let ownerBox = document.getElementById("owner_" + id);
    ownerBox.remove();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            closeDeleteForm();
        }
    }
    xmlhttp.open("GET", "../funkce/deleteUser.php?id=" + id, true);
    xmlhttp.send();

}

function createResult(name) {
    let li = document.createElement('li');
    li.textContent = name;
    return li;
}


function search(){
    let value = document.getElementById("searchValue").value;
    let searchType =document.getElementById("searchType").value;
    if(value===""){
        document.getElementById("lowerPart").innerHTML="";
    }
    else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("lowerPart").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "../funkce/vratOwner.php?value=" + value + "&type=" + searchType, true);
        xmlhttp.send();
    }
}