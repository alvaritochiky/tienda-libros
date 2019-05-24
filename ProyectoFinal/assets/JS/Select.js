function testFilt(str) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("central").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "views/producto/AjaxSelect/" + str + ".php", true);
    xhttp.send();
}