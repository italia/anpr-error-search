function check() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var myObj = JSON.parse(this.responseText);
            document.getElementById("out_table").innerHTML = myObj.name;
            document.getElementById("out_table").hidden="false";
            
        }
    };
    var urlPHP = "130.162.71.133/anpr-error-search/search_error.php?code=" + document.getElementById("codice").value
    xmlhttp.open("GET", urlPHP, true);
    xmlhttp.send();
}