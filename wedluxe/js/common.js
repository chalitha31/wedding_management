// signForm.style.opacity = 1;
// signForm.style.display = 'flex';

function paybutton(pay, cid) {
  window.location = "bookingcartpay.php?pay=" + pay + "&Cid=" + cid;
}

function gobookhis() {
  window.location = "purchaseHistory.php";
}

// sign up //

function signUp() {
  let fname = document.getElementById("fname");
  let lname = document.getElementById("lname");
  let email = document.getElementById("email");
  let password = document.getElementById("pw");
  let Repassword = document.getElementById("Rpw");

  let condition = 0;

  if (document.getElementById("seller-hotel-r").checked) {
    condition = "2";
  } else if (document.getElementById("seller-photo-r").checked) {
    condition = "3";
  } else if (document.getElementById("seller-dj-r").checked) {
    condition = "4";
  } else if (document.getElementById("seller-vehicle-r").checked) {
    condition = "5";
  } else {
    condition = "1";
  }

  var form = new FormData();

  form.append("fname", fname.value);
  form.append("lname", lname.value);
  form.append("email", email.value);
  form.append("password", password.value);
  form.append("Repassword", Repassword.value);
  form.append("condition", condition);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      let t = r.responseText;

      if (t == "success") {
        window.location = "home.php";
        // window.location = "home.php?from=signup";
        // signMenu(signForm);
      } else {
        document.getElementById("errorView").innerHTML = t;
      }
    }
  };

  r.open("POST", "signUpProcess.php", true);
  r.send(form);
}

// sign up //

//  log in form   //

function login() {
  let email = document.getElementById("email");
  let password = document.getElementById("pw");
  let rememberMe = document.getElementById("rememberMe");

  var form = new FormData();
  form.append("email", email.value);
  form.append("password", password.value);
  form.append("rememberMe", rememberMe.checked);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      let t = r.responseText;

      if (t == "success") {
        document.getElementById("errorView").innerHTML = t;

        location.reload();
      } else {
        document.getElementById("errorView").innerHTML = t;
      }
    }
  };

  r.open("POST", "signInProcess.php", true);
  r.send(form);
}

//  log in form   //

// sign Out  //

function signOut() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == "success") {
        window.location = "home.php";
      }
    }
  };

  r.open("GET", "signOutProcess.php", true);
  r.send();
}
// sign Out  //

// reset password //

function forgotpassword() {
  let email = document.getElementById("Vemail");

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "Success") {
        document.getElementById("VerrorView").innerHTML = "";

        alert("Verification Code Send to your Email. Please Check the inbox");
        document.getElementById("np").removeAttribute("readonly");
        document.getElementById("rnp").removeAttribute("readonly");
        document.getElementById("vc").removeAttribute("readonly");
        document
          .getElementById("change-pass-button")
          .removeAttribute("disabled");

        document.getElementById("send-otp-button").innerText = "Re-sent OTP";
      } else {
        document.getElementById("VerrorView").innerHTML = t;
        //  alert(t);
      }
    }
  };

  r.open("GET", "FogotPasswordProcess.php?e=" + email.value, true);
  r.send();
}

function resetPassword() {
  var e = document.getElementById("Vemail");
  var np = document.getElementById("np");
  var rnp = document.getElementById("rnp");
  var vc = document.getElementById("vc");

  var form = new FormData();
  form.append("e", e.value);
  form.append("np", np.value);
  form.append("rnp", rnp.value);
  form.append("vc", vc.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == "success") {
        alert("Password reset success");
        window.location = "home.php";
      } else {
        document.getElementById("VerrorView").innerHTML = text;
        //  alert(text);
      }
    }
  };

  r.open("POST", "resetPassword.php", true);
  r.send(form);
}

// reset password //

function removefeedback(id) {
  document.getElementById("removefeedback" + id).style.border = "solid 4px red";
  document.getElementById("custom-dialog").style.display = "block";
  document.getElementById("customAlert").innerText =
    "Do you want to remove this feedback?";

  // add event listeners to custom buttons
  document.getElementById("custom-yes").addEventListener("click", function () {
    // alert("You clicked Yes");
    document.getElementById("custom-dialog").style.display = "none";

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        if (r.responseText == "success") {
          alert("feedback successfully removed");
          location.reload();
        } else {
          alert(r.responseText);
        }
      }
    };

    r.open("GET", "deleteFeedbak.php?id=" + id, true);
    r.send();
  });
  document.getElementById("custom-no").addEventListener("click", function () {
    // alert("You clicked No");
    document.getElementById("custom-dialog").style.display = "none";

    document.getElementById("removefeedback" + id).style.border = "none";
    // alert("Your Profile is Updated.");
    location.reload();
  });
}

// packg details view

function packageDetails(pid) {
  window.location.href = "hotel-package-view.php?pid=" + pid;
}

// photograph packg details view

function phPackageDetails(pid) {
  window.location.href = "photography-package-view.php?pid=" + pid;
}

// dj packg details view

function djPackageDetails(pid) {
  window.location.href = "dj-package-view.php?pid=" + pid;
}

let hotelPackageTitles = document.querySelectorAll(".package-title");
// console.log(hotelPackageTitles);

let index = hotelPackageTitles.length - 1;

let classArray = ["gold", "platinum", "bronze", "metal", "plastic"];
let colorIndex = 0;

for (i = index; i >= 0; i--) {
  hotelPackageTitles[i].classList.add(classArray[colorIndex]);
  colorIndex++;
}
