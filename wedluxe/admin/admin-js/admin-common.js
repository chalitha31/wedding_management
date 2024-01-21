function pageTravel(location) {
  window.location.href = location;
}

// sign Out  //

function signOut() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == "success") {
        window.location = "admin-Sign-in.php";
      }
    }
  };

  r.open("GET", "AdminsignOutProcess.php", true);
  r.send();
}
// sign Out  //

function profile(id, val) {
  if (val == "2") {
    window.location.href = "hotel-profile.php?id=" + id;
  } else if (val == "3") {
    window.location.href = "dj-profile.php?id=" + id;
  } else if (val == "4") {
    window.location.href = "photography-profile.php?id=" + id;
  } else if (val == "5") {
    window.location.href = "vehicle-profile.php?id=" + id;
  }
}
