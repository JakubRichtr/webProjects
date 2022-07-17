var jmeno_platny;
var prijmeni_platny;
var vek_platny;
var email_platny;
var heslo_platny;
var hesla_stejny;
var email_stejny;
const error = document.getElementById('error');


function check_platny() {
    if(jmeno_platny &&prijmeni_platny&&vek_platny&&email_platny&&heslo_platny&&hesla_stejny&&email_stejny){
        document.getElementById("btn_div").innerHTML="<button id=\"overreg\" class=\"loginBtn\">Registruj</button>";
    }
    else{
        document.getElementById("btn_div").innerHTML="";
    }
}


function zobrazoverreg(id) {

    var jmeno_regex = /[a-zA-Z]{2,32}$/;
    var prijmeni_regex = /[a-zA-Z]{2,32}$/;
    var vek_regex = /[0-9]{1,3}$/;
    var cislo_regex = /[0-9]{9}$/;
    var email_regex = /[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
    var heslo_regex = /[a-zA-Z]$/;


    switch (id) {
        case 1: //jmeno
            jmeno_platny = jmeno_regex.test(document.form1.jmeno.value);
            if (!jmeno_platny) {
                document.form1.jmeno.style.color = "red";
                document.form1.jmeno.style.borderColor = "red";
            } else {
                document.form1.jmeno.style.color = "#8e8e8e";
                document.form1.jmeno.style.borderColor = "#8e8e8e";
            }
            break;
        case 2://prijmeni
            prijmeni_platny = prijmeni_regex.test(document.form1.prijmeni.value);
            if (!prijmeni_platny) {
                document.form1.prijmeni.style.color = "red";
                document.form1.prijmeni.style.borderColor = "red";
            } else {
                document.form1.prijmeni.style.color = "#8e8e8e";
                document.form1.prijmeni.style.borderColor = "#8e8e8e";
            }
            break;
        case 3: //vek
            vek_platny = vek_regex.test(document.form1.vek.value);
            if (!vek_platny || document.form1.vek.value > 116 || document.form1.vek.value < 15) {
                document.form1.vek.style.color = "red";
                document.form1.vek.style.borderColor = "red";
            } else {
                document.form1.vek.style.color = "#8e8e8e";
                document.form1.vek.style.borderColor = "#8e8e8e";
            }
            break;

        case 5://email
            zobrazoverreg(6);
            email_platny = email_regex.test(document.form1.email1.value);
            if (!email_platny) {
                document.form1.email1.style.color = "red";
                document.form1.email1.style.borderColor = "red";
            } else {
                document.form1.email1.style.color = "#8e8e8e";
                document.form1.email1.style.borderColor = "#8e8e8e";
            }
            break;
        case 6://email potvrzení
            email_stejny = document.form1.email1.value === document.form1.email2.value;
            if (!email_stejny) {
                document.form1.email2.style.color = "red";
                document.form1.email2.style.borderColor = "red";
            } else {
                document.form1.email2.style.color = "#8e8e8e";
                document.form1.email2.style.borderColor = "#8e8e8e";
            }
            break;


        case 8://username
            username_platny = username_regex.test(document.form1.username.value);
            if (!username_platny) {
                document.form1.username.style.color = "red";
                document.form1.username.style.borderColor = "red";
            } else {
                document.form1.username.style.color = "#8e8e8e";
                document.form1.username.style.borderColor = "#8e8e8e";
            }
            break;
        case 9: //heslo
            zobrazoverreg(10);
            heslo_platny = heslo_regex.test(document.form1.heslo1.value);
            if (!heslo_platny) {
                document.form1.heslo1.style.color = "red";
                document.form1.heslo1.style.borderColor = "red";
            } else {
                document.form1.heslo1.style.color = "#8e8e8e";
                document.form1.heslo1.style.borderColor = "#8e8e8e";
            }
            break;


        case 10: //heslo potbrzení
            hesla_stejny = document.form1.heslo1.value === document.form1.heslo2.value;
            if (!hesla_stejny) {
                document.form1.heslo2.style.color = "red";
                document.form1.heslo2.style.borderColor = "red";
            } else {
                document.form1.heslo2.style.color = "#8e8e8e";
                document.form1.heslo2.style.borderColor = "#8e8e8e";
            }
            break;
    }

}