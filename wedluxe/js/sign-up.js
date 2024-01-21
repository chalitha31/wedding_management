let sellerTypeContainer = document.querySelector('.seller-type-container');
let sellerLabels = Array.from(document.querySelectorAll('.seller-label'));

let checkbox = document.querySelector('#logseller');

for (let index in sellerLabels) {
    sellerLabels[index].addEventListener('click', () => { setLabelColor(index) });
}

checkbox.addEventListener('click', () => {
    if (checkbox.checked) {
        sellerTypeContainer.style.display = "flex";
        sellerTypeContainer.style.trnasform = "scaleY(1)";
    } else {
        sellerTypeContainer.style.display = "none";
        sellerTypeContainer.style.trnasform = "scaleY(0)";
    }
})

function setLabelColor(index) {
    for (let item of sellerLabels) {
        item.classList.remove('active');
    }

    sellerLabels[index].classList.add('active');
}



// function pageTravel(location) {
//     window.location.href = location;
// }