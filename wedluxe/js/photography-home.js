// let hotels = document.querySelectorAll('.photograpy-item-block');
// for (let item of hotels) {
//     item.addEventListener('click', () => { pageTravel('photography-profile.php') });
// }

// localStorage.setItem("activated-tab", window.location.href)



function phbasicSearch(x) {


    var searchText = document.getElementById("hotel_search_txt").value;


    var form = new FormData();

    form.append("st", searchText);
    form.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText
                // alert(t);

            document.getElementById("phSearchResult").innerHTML = t;

        }
    };

    r.open("POST", "photographysearchProcess.php", true);
    r.send(form);

}

function photographyDetails(id) {
    window.location.href = "photography-profile.php?id=" + id;
}