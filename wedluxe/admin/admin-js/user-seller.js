function bookhisry() {
    let val = document.getElementById("type-select");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText
                // alert(t);

            document.getElementById("results").innerHTML = t;

        }
    };

    r.open("GET", "userSellerManageProcess.php?Cid=" + val.value, true);
    r.send();
}

window.onload = function() {

    let val = 1;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText
                // alert(t);

            document.getElementById("results").innerHTML = t;

        }
    };

    r.open("GET", "userSellerManageProcess.php?Cid=" + val, true);
    r.send();
}