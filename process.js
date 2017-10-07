function check() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var myObj = JSON.parse(this.responseText);
            document.getElementById("out_table").innerHTML = myObj.name;
            document.getElementById("out_table").hidden="false";
            
        }
    };
    xmlhttp.open("GET", "search_error.php", true);
    xmlhttp.send();
}
