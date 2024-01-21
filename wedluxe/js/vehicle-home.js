// let hotels = document.querySelectorAll('.vehicle-item-block');
// for (let item of hotels) {
//     item.addEventListener('click', () => { pageTravel('vehicle-profile.php') });
// }


//vehical search

function VehibasicSearch(x) {


    var searchText = document.getElementById("hotel_search_txt").value;


    var form = new FormData();

    form.append("st", searchText);
    form.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText
                // alert(t);



            document.getElementById("VehiclSearchResult").innerHTML = t;


        }
    };

    r.open("POST", "vehicalSearchProcess.php", true);
    r.send(form);

}


// vehical details


// vehical details

function vehicalDetails(id) {
    window.location.href = "vehicle-profile.php?id=" + id;
}