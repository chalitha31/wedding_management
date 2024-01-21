let holderBack = document.querySelector(".join-form");
let formHolder = document.querySelector(".form-container");
let blockerButton = document.querySelector(".blocker-button");
let closeButton = document.querySelector(".close-tag");

let packViewMin = 9;

function delay(ms) {
  return new Promise((resolve) => {
    setTimeout(() => {
      resolve("");
    }, ms);
  });
}

// holderBack.style.opacity = 0;
// holderBack.style.visibility = "hidden";
// formHolder.style.top = "-50%"

// blockerButton.addEventListener('click', () => { formAppear() });
// closeButton.addEventListener('click', () => { formAppear() });

async function formAppear() {
  let t, v, l, m, p;
  if (formHolder.style.top == "-50%") {
    holderBack.style.visibility = "visible";

    t = 0;
    v = -50;
    l = 100;
    m = 50;
    for (let i = 0; i <= 100; i++) {
      p = ((v - m) * (i - l) * (i - l)) / ((t - l) * (t - l)) + m;
      if (p >= 0) holderBack.style.opacity = p / 50;
      formHolder.style.top = p + "%";

      await delay(1);
    }
  } else {
    let op = 1;
    t = 0;
    v = 50;
    l = 80;
    m = 80;
    for (let i = 0; i <= 100; i++) {
      p = ((v - m) * (i - l) * (i - l)) / ((t - l) * (t - l)) + m;
      if (p >= 0) holderBack.style.opacity = op;
      formHolder.style.top = p + "%";
      op -= 1 / l;
      await delay(1);
    }
    holderBack.style.visibility = "hidden";
    formHolder.style.top = "-50%";
  }
}
let packViewMax = 20;
for (let i = 0; i <= 100; i++) {
  packageView('.pop', packViewMin, packViewMax);
  packageView('.clk', packViewMin, packViewMax);
}
setColorToTable();

function packageView(cls, mn, dy) {
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
      if (terms >= 1) {
        for (let i = 0; i < terms; i++) {
          if (index < terms && protocolPass) {
            if (cls == '.pop')
              secChannel[index].style.display = "none";
            if (cls == '.clk')
              secChannel[index].style.pointerEvents = "none";
          }
          index = Math.floor(Math.random() * terms);
        }
      }
    }
  };
  xhr.send();
}

function setColorToTable() {
  let tableDataArray = document.querySelectorAll("td");
  for (let item of tableDataArray) {
    if (item.textContent == "available") item.style.color = "#7bff00";
    else if (item.textContent == "not available") item.style.color = "#ff4e4e";
  }
}

// document.querySelector('.blocker-button').addEventListener('click', () => { signMenu(signForm) });
