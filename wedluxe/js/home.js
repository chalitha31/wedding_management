let homeCaption = document.querySelector(".home-caption");
let homeLogo = document.querySelector(".home-logo");

function delay(ms) {
  return new Promise((resolve) => {
    setTimeout(() => {
      resolve("");
    }, ms);
  });
}

homeLogo.style.opacity = 0;
homeCaption.style.opacity = 0;
homeCaption.style.transform = `translateY(-100px)`;

let pass = true;

window.addEventListener("load", () => {
  if (pass) rise();
});

async function rise() {
  pass = false;
  let valRate = 0;
  for (let i = 0; i < 100; i++) {
    homeLogo.style.opacity = valRate / 100;
    valRate += 1;
    await delay(1);
  }
  valRate = 0;
  for (let i = 0; i < 100; i++) {
    let tv = -100 + valRate;
    // console.log(tv)
    homeCaption.style.opacity = valRate / 100;
    homeCaption.style.transform = `translateY(${tv}px)`;
    valRate += 1;
    await delay(1);
  }
}
