let shareCheckbox = Array.from(document.querySelectorAll('.share-checkbox'))
let contactShareIcon = document.querySelectorAll('.contact-share-icon')
let shareInputLink = document.querySelectorAll('.share-link-input')



for (let index in shareCheckbox) {
    shareCheckbox[index].addEventListener('click', () => { setContacts() })
}

function setContacts() {
    for (let index in shareCheckbox) {
        if (shareCheckbox[index].checked) {
            shareInputLink[index].disabled = false;
            contactShareIcon[index].style.filter = 'opacity(1)'
        } else {
            shareInputLink[index].disabled = true;
            contactShareIcon[index].style.filter = 'opacity(0.2)'
        }
    }
}



let gallImgBoxes = Array.from(document.querySelectorAll('.gal-upload-image-box'));

function loadFile(index, event) {
    let input = event.target;
    let label = input.nextElementSibling;
    let box = input.parentNode;

    box.style.backgroundImage = "url(" + URL.createObjectURL(input.files[0]) + ")";
    label.style.filter = "invert(0.9) opacity(0.5)";
    // console.log(box.style.backgroundImage);
}

function removeGalImg(index) {
    let box = gallImgBoxes[index];
    let input = box.querySelector('.gal-img-upload-input');
    let lable = box.querySelector('.gal-upload-label');

    box.style.backgroundImage = "none";
    lable.style.filter = "invert(0) opacity(1)";
    input.value = "";
}


gallImgBoxes.forEach((box, index) => {
    let closeIcon = box.querySelector('.upload-gal-img-close');
    let uploadInput = box.querySelector('.gal-img-upload-input');

    closeIcon.addEventListener('click', () => {
        removeGalImg(index);
    })

    uploadInput.addEventListener('change', (event) => { loadFile(index, event) })
});


function a() {
    var image1 = document.getElementById("file-1").files[0];
    var image2 = document.getElementById("file-2").files[0];
    var image3 = document.getElementById("file-3").files[0];
    var image4 = document.getElementById("file-4").files[0];
    var image5 = document.getElementById("file-5").files[0];
    var image6 = document.getElementById("file-6").files[0];
    var image7 = document.getElementById("file-7").files[0];
    var image8 = document.getElementById("file-8").files[0];
    var image9 = document.getElementById("file-9").files[0];

    var f = new FormData();
    f.append("img1", image1);
    f.append("img2", image2);
    f.append("img3", image3);
    f.append("img4", image4);
    f.append("img5", image5);
    f.append("img6", image6);
    f.append("img7", image7);
    f.append("img8", image8);
    f.append("img9", image9);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                alert("Images uploaded successfully");
            } else {
                alert("Error uploading images");
                alert(t)
            }
        }
    };
    r.open("POST", "profileEditProcess.php", true);
    r.send(f);
}