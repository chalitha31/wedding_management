let gifC = document.querySelector(".gif-container");
let loadIcon = document.querySelector("lord-icon");
let proc = document.querySelector(".proc");
// let sentL = document.querySelector(".sentL");

gifC.style.visibility = "hidden";
proc.style.visibility = "hidden";
// sentL.style.visibility = "hidden";

gifC.style.opacity = 0;
proc.style.opacity = 0;
// sentL.style.opacity = 0;

function hisry() {
  let val = document.getElementById("sort");

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      document.getElementById("results").innerHTML = t;
    }
  };

  r.open("GET", "bookingHistoryProcess.php?Cid=" + val.value, true);
  r.send();
}

function loadhisry(id) {
  let val = document.getElementById("sort");
  val.value = id;
  // alert(id);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      document.getElementById("results").innerHTML = t;
    }
  };

  r.open("GET", "bookingHistoryProcess.php?Cid=" + id, true);
  r.send();
}

var fm;

function showFeedbackModel(bokid, name, model, valId) {
  // alert(name)
  // alert(bokid)
  document.getElementById("pid").innerHTML = bokid;
  document.getElementById("ptitle").innerHTML = name;
  document.getElementById("ptitlemodel").innerHTML = name + " - " + model;
  // document.getElementById('trid').innerText = bokid;
  document.getElementById("valId").innerText = valId;
  var verificationModal = document.getElementById("veificationModel");
  fm = new bootstrap.Modal(verificationModal);

  fm.show();
}

startCount = 0;

function markStar(count) {
  for (i = 1; i < 6; i++) {
    if (i <= count) {
      document.getElementById("star" + i).style.color = "rgb(237, 205, 21)";
    } else {
      document.getElementById("star" + i).style.color = "black";
    }
  }
  startCount = count;
}

function addfeedback() {
  var bid = document.getElementById("pid").innerHTML;
  var image = document.getElementById("profileimg").files[0];

  if (startCount == 0) {
    alert("Please Select Reating");
  } else {
    var feed = document.getElementById("feed").value;
    // var inid = document.getElementById('trid').innerHTML;
    var valId = document.getElementById("valId").innerHTML;

    var formData = new FormData();
    formData.append("bid", bid);
    formData.append("count", startCount);
    formData.append("feed", feed);
    formData.append("valId", valId);
    formData.append("i", image);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        if (r.responseText == "success") {
          alert("Feedback Added Successfuly Thank You");
          resetPurchaseModal();
          fm.hide();
          // alert(r.responseText);
        } else {
          alert(r.responseText);
        }
      }
    };
    r.open("POST", "addFeedbackProcess.php", true);
    r.send(formData);
  }
}

function resetPurchaseModal() {
  document.getElementById("feed").value = "";
  var image = (document.getElementById("profileimg").value = "");
  startCount = 0;
  document.getElementById("ptitle").innerHTML = "";
  for (i = 1; i < 6; i++) {
    document.getElementById("star" + i).style.color = "black";
  }
}

function deleteFromPHistory(bid, vid) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      if (r.responseText == "success") {
        alert("Product Was Deleted Successfully");
        window.location = "purchaseHistory.php";
      } else {
        alert(r.responseText);
      }
    }
  };
  r.open("GET", "deleteBookingHistory.php?bid=" + bid + "&vid=" + vid, true);
  r.send();
}

function cancelbooking(bid, vid) {
  document.getElementById("custom-dialog").style.display = "block";
  document.getElementById("customAlert").innerText =
    "Do you want to Cancel this your order?";

  // add event listeners to custom buttons
  document.getElementById("custom-yes").addEventListener("click", function () {
    // alert("You clicked Yes");
    document.getElementById("custom-dialog").style.display = "none";

    gifC.style.visibility = "visible";
    proc.style.visibility = "visible";
    let l = 100;
    for (let i = 0; i <= l; i++) {
      gifC.style.opacity = i / l;
      proc.style.opacity = i / l;
      // await delay(1);
    }
    gifC.style.opacity = 1;
    proc.style.opacity = 1;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        if (r.responseText == "success") {
          loadIcon.style.visibility = "hidden";
          proc.style.visibility = "hidden";
          // sentL.style.visibility = "visible";

          let l = 50;
          for (let i = 0; i <= l; i++) {
            // sentL.style.opacity = i / l;
            proc.style.opacity = i / l;
            // await delay(1);
          }

          // await delay(1000);

          l = 100;
          for (let i = l; i >= 0; i--) {
            gifC.style.opacity = i / l;
            proc.style.opacity = i / l;
            // await delay(1);
          }
          gifC.style.opacity = 0;
          // sentL.style.opacity = 0;
          proc.style.opacity = 0;
          gifC.style.visibility = "hidden";
          proc.style.visibility = "hidden";

          alert("your order has been cancelled");
          window.location = "purchaseHistory.php";
        } else {
          alert(r.responseText);
        }
      }
    };
    r.open("GET", "bookingCancel.php?bid=" + bid + "&vid=" + vid, true);
    r.send();
  });
  document.getElementById("custom-no").addEventListener("click", function () {
    // alert("You clicked No");
    document.getElementById("custom-dialog").style.display = "none";

    // alert("Your Profile is Updated.");
    location.reload();
  });
}

// function clearAllPurshase() {
//     var r = new XMLHttpRequest();
//     r.onreadystatechange = function() {
//         if (r.readyState == 4) {
//             if (r.responseText == "success") {
//                 alert("ALL Reocrds Deleted");
//                 window.location = "purchaseHistory.php";
//             } else {
//                 alert(r.responseText);
//             }
//         }
//     }
//     r.open("GET", "deleteAllPurchaseHistroy.php", true);
//     r.send();
// }

function changeImage() {
  var image = document.getElementById("profileimg");
  var view = document.getElementById("prev0");

  image.onchange = function () {
    var file = this.files[0];
    var url = window.URL.createObjectURL(file);
    view.src = url;
  };
}
