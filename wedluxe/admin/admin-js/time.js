function updateDateTime() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            var currentDateTime = response.datetime;
            document.getElementById('current-datetime').innerHTML = currentDateTime;
        }
    };
    xhttp.open("GET", "time.php", true);
    xhttp.send();
}

// Update the date and time every second
setInterval(updateDateTime, 1000);