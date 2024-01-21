// let hotels = document.querySelectorAll('.hotel-item-block');
// for (let item of hotels) {
//     item.addEventListener('click', () => { pageTravel('hotel-profile.php') });
// }



//hotel search



function basicSearch(x) {
    // id = 10;

    var searchText = document.getElementById("hotel_search_txt").value;


    var form = new FormData();

    form.append("st", searchText);
    form.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText
                // alert(t);

            document.getElementById("HotelSearchResult").innerHTML = t;

        }
    };

    r.open("POST", "hotelsearchProcess.php", true);
    r.send(form);

}


// hotel details
// var id = 0;

function hotelDetails(id) {
    // id;
    window.location.href = "hotel-profile.php?id=" + id;
}

// localStorage.setItem("activated-tab", window.location.href)