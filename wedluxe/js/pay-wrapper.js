let payWrapper = document.querySelector(".pay-wrapper");
let payBlur = document.querySelector(".backdrop-blur");
let payCard = document.querySelector(".pay-card");

let numInput = document.querySelectorAll(".card-num-input");
for (let input of numInput) {
  input.addEventListener("input", () => {
    if (input.value.length > 4) {
      input.value = input.value.slice(0, 4);
    }
  });
}

let exNumInput = document.querySelectorAll(".card-exp-input");
for (let input of exNumInput) {
  input.addEventListener("input", () => {
    if (input.value.length > 2) {
      input.value = input.value.slice(0, 2);
    }
  });
}
let ccvNumInput = document.querySelector(".card-ccv-input");
ccvNumInput.addEventListener("input", () => {
  if (ccvNumInput.value.length > 3) {
    ccvNumInput.value = ccvNumInput.value.slice(0, 3);
  }
});

// payBlur.addEventListener('click', () => { getPayWapper() })

// payCard.style.opacity = 0;
// payCard.style.transform = 'translateY(200%)'
// payWrapper.style.opacity = 0;
// payWrapper.style.transform = 'scale(0)'

// function getPayWapper() {
//     if (payWrapper.style.opacity == 0) {
//         payWrapper.style.opacity = 1
//         payWrapper.style.transform = 'scale(1)'
//         payCard.style.opacity = 1;
//         payCard.style.transform = 'translateY(0%)'
//     } else {
//         payWrapper.style.opacity = 0
//         payWrapper.style.transform = 'scale(0)'
//         payCard.style.opacity = 0;
//         payCard.style.transform = 'translateY(200%)'
//     }
// }

let gifC = document.querySelector(".gif-container");
let loadIcon = document.querySelector("lord-icon");
let proc = document.querySelector(".proc");
let sentL = document.querySelector(".sentL");

gifC.style.visibility = "hidden";
proc.style.visibility = "hidden";
sentL.style.visibility = "hidden";

gifC.style.opacity = 0;
proc.style.opacity = 0;
sentL.style.opacity = 0;

function delay(ms) {
  return new Promise((resolve) => {
    setTimeout(() => {
      resolve("");
    }, ms);
  });
}

async function paying(Tid, Cid, pay) {
  gifC.style.visibility = "visible";
  proc.style.visibility = "visible";
  let l = 100;
  for (let i = 0; i <= l; i++) {
    gifC.style.opacity = i / l;
    proc.style.opacity = i / l;
    await delay(1);
  }
  gifC.style.opacity = 1;
  proc.style.opacity = 1;

  let cartN1 = document.getElementById("cartN1");
  let cartN2 = document.getElementById("cartN2");
  let cartN3 = document.getElementById("cartN3");
  let cartN4 = document.getElementById("cartN4");
  let year = document.getElementById("year");
  let month = document.getElementById("month");
  let cvv = document.getElementById("cvv");

  // alert(year.value + "/" + month.value);

  cartnunber = cartN1.value + cartN2.value + cartN3.value + cartN4.value;

  // alert(cartnunber);
  // alert(cvv.value);

  var formData = new FormData();
  formData.append("cartnunber", cartnunber);
  formData.append("year", year.value);
  formData.append("month", month.value);
  formData.append("cvv", cvv.value);
  formData.append("Tid", Tid);
  formData.append("Cid", Cid);
  formData.append("pay", pay);

  let r = new XMLHttpRequest();

  r.onreadystatechange = async function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "success") {
        loadIcon.style.visibility = "hidden";
        proc.style.visibility = "hidden";
        sentL.style.visibility = "visible";

        let l = 50;
        for (let i = 0; i <= l; i++) {
          sentL.style.opacity = i / l;
          proc.style.opacity = i / l;
          await delay(1);
        }

        await delay(1000);

        l = 100;
        for (let i = l; i >= 0; i--) {
          gifC.style.opacity = i / l;
          proc.style.opacity = i / l;
          await delay(1);
        }
        gifC.style.opacity = 0;
        sentL.style.opacity = 0;
        proc.style.opacity = 0;
        gifC.style.visibility = "hidden";
        proc.style.visibility = "hidden";

        alert("payment successful! payment Details sent your email.");
        window.location = "home.php";
      } else {
        alert(t);
        gifC.style.visibility = "hidden";
        sentL.style.visibility = "hidden";
        proc.style.visibility = "hidden";
        gifC.style.opacity = 0;
        sentL.style.opacity = 0;
        proc.style.opacity = 0;
      }
    }
  };

  r.open("POST", "payProcess.php", true);
  r.send(formData);
}

async function bookingpay(Tid, Bid, pay, tptice) {
  gifC.style.visibility = "visible";
  proc.style.visibility = "visible";
  let l = 100;
  for (let i = 0; i <= l; i++) {
    gifC.style.opacity = i / l;
    proc.style.opacity = i / l;
    await delay(1);
  }
  gifC.style.opacity = 1;
  proc.style.opacity = 1;

  let cartN1 = document.getElementById("cartN1");
  let cartN2 = document.getElementById("cartN2");
  let cartN3 = document.getElementById("cartN3");
  let cartN4 = document.getElementById("cartN4");
  let year = document.getElementById("year");
  let month = document.getElementById("month");
  let cvv = document.getElementById("cvv");

  // alert(year.value + "/" + month.value);

  cartnunber = cartN1.value + cartN2.value + cartN3.value + cartN4.value;

  // alert(cartnunber);
  // alert(cvv.value);

  var formData = new FormData();
  formData.append("cartnunber", cartnunber);
  formData.append("year", year.value);
  formData.append("month", month.value);
  formData.append("cvv", cvv.value);
  formData.append("Tid", Tid);
  formData.append("Bid", Bid);
  formData.append("pay", pay);
  formData.append("tptice", tptice);

  let r = new XMLHttpRequest();

  r.onreadystatechange = async function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "success") {
        loadIcon.style.visibility = "hidden";
        proc.style.visibility = "hidden";
        sentL.style.visibility = "visible";

        let l = 50;
        for (let i = 0; i <= l; i++) {
          sentL.style.opacity = i / l;
          proc.style.opacity = i / l;
          await delay(1);
        }

        await delay(1000);

        l = 100;
        for (let i = l; i >= 0; i--) {
          gifC.style.opacity = i / l;
          proc.style.opacity = i / l;
          await delay(1);
        }
        gifC.style.opacity = 0;
        sentL.style.opacity = 0;
        proc.style.opacity = 0;
        gifC.style.visibility = "hidden";
        proc.style.visibility = "hidden";

        alert("payment successful! payment Details sent your email.");
        window.location = "home.php";

        // window.location = "bookingemail.php?email=" + "chalithachamod3031@gmail.com";
        // window.location = "bookingemailsend.php";
      } else {
        alert(t);
        gifC.style.visibility = "hidden";
        sentL.style.visibility = "hidden";
        proc.style.visibility = "hidden";
        gifC.style.opacity = 0;
        sentL.style.opacity = 0;
        proc.style.opacity = 0;
      }
    }
  };

  r.open("POST", "bookingpayProcess.php", true);
  r.send(formData);
}
