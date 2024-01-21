// let hotels = document.querySelectorAll('.hotel-item-block');
// for (let item of hotels) {
//     item.addEventListener('click', () => { pageTravel('hotel-package-view.php') });
// }


function DjDetails(id) {
    window.location.href = "dj-profile.php?id=" + id;
}


function DjbasicSearch(x) {


    var searchText = document.getElementById("dj_search_txt").value;


    var form = new FormData();

    form.append("st", searchText);
    form.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText
                // alert(t);

            document.getElementById("DjSearchResult").innerHTML = t;

        }
    };

    r.open("POST", "djSearchProcess.php", true);
    r.send(form);

}