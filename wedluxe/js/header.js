function delay(ms) {
    return new Promise(resolve => {
        setTimeout(() => { resolve('') }, ms);
    })
}

let hambMenu = document.querySelector('.hamb-menu');
let navDrop = document.querySelector('.nav-dropdown');
let headerMid = document.querySelector('.header-mid');
let header = document.querySelector('header');

let signbtn = document.querySelector('.sign-text');
let forgotbtn = document.querySelector('.fog');

let signForm = document.querySelector('.header-sign-form');
let forgotForm = document.querySelector('.forget-form-container');

let formClose = document.querySelector('.form-close');
let forgotFormClose = document.querySelector('.forgot-form-close');

signForm.style.opacity = 0;
forgotForm.style.opacity = 0;



signbtn.addEventListener('click', () => { signMenu(signForm) })
forgotbtn.addEventListener('click', () => { signMenu(forgotForm) })
formClose.addEventListener('click', () => { signMenu(signForm) })
forgotFormClose.addEventListener('click', () => { signMenu(forgotForm) })

async function signMenu(element) {
    let steps = 30;
    let navOp = 0;
    if (element == forgotForm) {
        navOp = 1;
        for (let i = 0; i < steps; i++) {
            signForm.style.opacity = `${navOp}`;
            navOp -= 1 / steps;
            await delay(1);
        }
        signForm.style.opacity = 0;
        signForm.style.display = 'none';
    }
    if (element.style.opacity == 0) {
        element.style.display = 'flex';
        console.log(2)
        for (let i = 0; i < steps; i++) {
            // element.style.height = `${navHeight}px`;
            element.style.opacity = `${navOp}`;
            navOp += 1 / steps;
            await delay(1);
        }
        element.style.opacity = 1;
    } else if (element.style.opacity == 1) {
        console.log(2)
        navOp = 1;
        for (let i = 0; i < steps; i++) {
            element.style.opacity = `${navOp}`;
            navOp -= 1 / steps;
            await delay(1);
        }
        element.style.opacity = 0;
        element.style.display = 'none';
    }
}



async function formTravel(startPoint, endPoint, element, steps, startX, endX, direction) {
    let p;
    let opRatio = 1 / steps;

    // if (element.style.left == `${startPoint}%` || element.style.top == `${startPoint}%`) {
    if (element.style.opacity == 0) {
        let baseOp = 0;
        for (let i = 0; i <= steps; i++) {
            p = (((startPoint - endPoint) * (i - endX) * (i - endX)) / ((startX - endX) * (startX - endX))) + endPoint;
            element.style.opacity = baseOp;
            baseOp += opRatio;
            if (direction == "horizontal")
                element.style.transform = `translate(-50%, -150%)`;
            if (direction == "verticle")
                element.style.transform = `translate(-50%, ${p}%)`;
            await delay(1);
        }
        // if (direction == "horizontal")
        // element.style.left = endPoint + '%';
        // if (direction == "verticle")
        // element.style.top = endPoint + '%';

        // console.log(element.style.transform)
        element.style.opacity = 1;

    } else if (element.style.opacity == 2) {
        let baseOp = 1;
        for (let i = 0; i <= steps; i++) {
            p = (((startPoint - endPoint) * (i - endX) * (i - endX)) / ((startX - endX) * (startX - endX))) + endPoint
            element.style.opacity = baseOp;
            baseOp = baseOp - opRatio;
            if (direction == "horizontal")
                element.style.left = p + '%';
            if (direction == "verticle")
                element.style.top = p + '%';
            await delay(1);
        }
        // if (direction == "horizontal")
        // element.style.left = startPoint + '%';
        // if (direction == "verticle")
        // element.style.top = startPoint + '%';

        element.style.opacity = 0;
    }
}




function pageTravel(location) {
    window.location.href = location;

}

// navDrop.style.backgroundColor = "red";
// navDrop.style.display = "none";
navDrop.style.height = "0px";
navDrop.style.opacity = 0;



hambMenu.addEventListener('click', () => { navMenu() })

async function navMenu() {
    let steps = 10;
    let navExpH = 350;
    let navHeight = 0;
    let navOp = 0;
    if (navDrop.style.opacity == 0) {
        console.log(2)
        for (let i = 0; i < steps; i++) {
            navDrop.style.height = `${navHeight}px`;
            navDrop.style.opacity = `${navOp}`;
            navHeight += navExpH / steps;
            navOp += 1 / steps;
            await delay(1);
        }
        navDrop.style.opacity = 1;
    } else {
        console.log(2)
        for (let i = 0; i < steps; i++) {
            navDrop.style.height = `${navHeight}px`;
            navDrop.style.opacity = `${navOp}`;
            navHeight -= navExpH / steps;
            navOp -= 1 / steps;
            await delay(1);
        }
        navDrop.style.opacity = 0;
    }
}



window.addEventListener('load', (e) => {
    let paddingDefVal = 100;
    if (window.innerWidth < 950) {
        let paddingVal = paddingDefVal - (950 - window.innerWidth) / 7
        hambMenu.style.display = "block"
        headerMid.style.display = "none"
        header.style.padding = `0px ${paddingVal}px`;
    } else {
        hambMenu.style.display = "none"
        headerMid.style.display = "flex"
        header.style.padding = `0px ${paddingDefVal}px`;
    }
})
window.addEventListener('resize', (e) => {
    let paddingDefVal = 100;
    if (window.innerWidth < 950) {
        let paddingVal = paddingDefVal - (950 - window.innerWidth) / 7
        hambMenu.style.display = "block"
        headerMid.style.display = "none"
        header.style.padding = `0px ${paddingVal}px`;
    } else {
        hambMenu.style.display = "none"
        headerMid.style.display = "flex"
        header.style.padding = `0px ${paddingDefVal}px`;

    }
})

// document.querySelector('.blocker-button').addEventListener('click', () => { signMenu(signForm) });

function blockbutton() {

    signMenu(signForm);
}

function bokksignin() {

    alert("Please Sign In First!");
}