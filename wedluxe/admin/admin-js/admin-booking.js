let selectOptions = document.querySelector('.type-selector');

selectOptions.addEventListener('change', () => {
    if (selectOptions.value == '3') {
        document.querySelector('.package-head').textContent = 'Vehicle Name';
        document.querySelector('.extra-head').textContent = 'Extra Days';
    } else {
        document.querySelector('.package-head').textContent = 'Package Name';
        document.querySelector('.extra-head').textContent = 'Day or Night';
    }
})



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

    r.open("GET", "adminbookingHistoryProcess.php?Cid=" + val.value, true);
    r.send();
}

window.onload = function() {

    let val = 0;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText
                // alert(t);

            document.getElementById("results").innerHTML = t;

        }
    };

    r.open("GET", "adminbookingHistoryProcess.php?Cid=" + val, true);
    r.send();
}