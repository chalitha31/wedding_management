let packageContainer = document.querySelector(".package-container");
let uploadBtn = document.querySelector(".upload-button");
let idNum = 2;
for (let i = 0; i < 4; i++) {
  let model = `
    <div class="package-en-container">
        <input type="checkbox" class="package-active-check" id="${idGenerator(
    "enable",
    idNum
  )}" unchecked>
        <label for="${idGenerator(
    "enable",
    idNum
  )}" class="package-enable">enable</label>
    </div>
    <div class="package-name">${idGenerator("Package", idNum)}</div>
    <div class="package-blocker"></div>
    <div class="image-holder">
        <input type="file" accept="image/*" name="image" id="${idGenerator(
    "packImg",
    idNum
  )}" style="display:none;"
            onchange="loadFile(event)">
        <label class="label" for="${idGenerator("packImg", idNum)}">
            <i class="fa-solid fa-cloud-arrow-up upload-pack-img"></i>
        </label>
    </div>
    <input type="text" class="edit-package-title" placeholder="set a title for the package">
    <div class="feIC">
        <input type="text" placeholder="add features of the package" class="feature-input">
        <div class="feature-add-button">ADD</div>
    </div>
    <div class="features-container">
        <div class="feature-box-default">No features added yet</div>
    </div>
    <input type="text" class="input-package-price pop" placeholder="set a Price for the package">
    `;
  createChildElement(packageContainer, "div", "class", "package-model", model);
  idNum++;
}

let packageModels = Array.from(document.querySelectorAll(".package-model"));

let featuresArrays = [[], [], [], [], []];

let featureInputs = Array.from(document.querySelectorAll(".feature-input"));
let featuresAddButton = Array.from(
  document.querySelectorAll(".feature-add-button")
);
let featureContainers = Array.from(
  document.querySelectorAll(".features-container")
);

let featureDefaultBoxes = Array.from(
  document.querySelectorAll(".feature-box-default")
);

let featureBoxesArray = [[], [], [], [], []];
let closeArrays = [[], [], [], [], []];

let totalPackagesPrice = document.querySelector(".total-prices");

for (let index in featuresAddButton) {
  featuresAddButton[index].addEventListener("click", () => {
    addFeatures(index);
  });
}

packagePriceTotal(2500);

function idGenerator(name, idNum) {
  let id = `${name}-${idNum}`;
  return id;
}

function createChildElement(
  parent,
  childType,
  attributeType,
  attValue,
  content
) {
  let childElement = document.createElement(childType);
  childElement.setAttribute(attributeType, attValue);
  childElement.innerHTML = content;
  parent.appendChild(childElement);
}

function addFeatures(index) {
  if (featureInputs[index].value == "") return;

  featuresArrays[index].push(featureInputs[index].value);

  if (featuresArrays[index].length > 0) {
    featureDefaultBoxes[index].textContent = "features";
  }

  for (let item of featureBoxesArray[index]) {
    item.remove();
  }

  for (let feature of featuresArrays[index]) {
    let featureBox = document.createElement("div");
    featureBox.className = "feature-box";

    let featureText = document.createElement("div");
    featureText.className = "feature-text";
    featureText.textContent = feature;

    let featureClose = document.createElement("div");
    featureClose.className = "close-icon";
    featureClose.textContent = "x";

    featureBox.appendChild(featureText);
    featureBox.appendChild(featureClose);
    featureContainers[index].appendChild(featureBox);
  }

  let parentPackage = packageModels[index];
  closeArrays[index] = parentPackage.querySelectorAll(".close-icon");
  featureBoxesArray[index] = parentPackage.querySelectorAll(".feature-box");

  for (let i = 0; i < closeArrays[index].length; i++) {
    closeArrays[index][i].addEventListener("click", () => {
      removeFeatures(index, i);
    });
  }

  featureInputs[index].value = "";
}

function removeFeatures(index, i) {
  featuresArrays[index].splice(i, 1);

  if (featuresArrays[index].length == 0) {
    featureDefaultBoxes[index].textContent = "No features added yet";
  } else {
    featureDefaultBoxes[index].textContent = "features";
  }

  for (let item of featureBoxesArray[index]) {
    item.remove();
  }

  buildFeatureBoxArray(index);

  let parentPackage = packageModels[index];
  closeArrays[index] = parentPackage.querySelectorAll(".close-icon");
  featureBoxesArray[index] = parentPackage.querySelectorAll(".feature-box");

  for (let i = 0; i < closeArrays[index].length; i++) {
    closeArrays[index][i].addEventListener("click", () => {
      removeFeatures(index, i);
    });
  }
}

function buildFeatureBoxArray(index) {
  for (let feature of featuresArrays[index]) {
    let featureBox = document.createElement("div");
    featureBox.className = "feature-box";

    let featureText = document.createElement("div");
    featureText.className = "feature-text";
    featureText.textContent = feature;

    let featureClose = document.createElement("div");
    featureClose.className = "close-icon";
    featureClose.textContent = "x";

    featureBox.appendChild(featureText);
    featureBox.appendChild(featureClose);
    featureContainers[index].appendChild(featureBox);
  }
}

function loadFile(event) {
  let input = event.target;
  let label = input.nextElementSibling;
  let box = input.parentNode;

  box.style.backgroundImage =
    "url(" + URL.createObjectURL(input.files[0]) + ")";
  label.style.filter = "invert(0) opacity(0.5)";
}

let packActBtns = Array.from(
  document.querySelectorAll(".package-active-check")
);

for (let i = 2; i < packageModels.length; i++) {
  packageModels[i].style.display = "none";
}

for (let index in packActBtns) {
  let label = packActBtns[index].nextElementSibling;
  if (packActBtns[index].checked) {
    label.textContent = "Enabled";
    label.style.color = "green";
  } else {
    label.textContent = "Disabled";
    label.style.color = "red";
  }

  packActBtns[index].addEventListener("input", (event) => {
    checkboxInputValidatio(index, event);
  });
}

function packageEnDis(event) {
  let checkbox = event.target;
  let label = checkbox.nextElementSibling;
  let parent = checkbox.parentNode.parentNode;
  let blocker = parent.querySelector(".package-blocker");

  if (checkbox.checked) {
    label.textContent = "Enabled";
    label.style.color = "green";
    blocker.style.display = "none";
  } else {
    label.textContent = "Disabled";
    label.style.color = "red";
    blocker.style.display = "flex";
  }
}

function packagePriceTotal(pricePerPackage) {
  let cboxs = Array.from(document.querySelectorAll(".package-active-check"));
  let count = 0;
  for (let box of cboxs) {
    if (box.checked) count++;
  }
  totalPackagesPrice.value = count * pricePerPackage + 2500;
}

function checkboxInputValidatio(ind, event) {
  let index = +ind;
  let valid = true;
  let beforePass = true;
  let afterPass = true;
  for (let i = index - 1; i >= 0; i--) {
    if (packActBtns[i].checked == false) beforePass = false;
  }
  for (let i = index + 1; i < packActBtns.length; i++) {
    if (packActBtns[i].checked == true) afterPass = false;
  }

  if (!beforePass) {
    packActBtns[index].checked = false;
  }
  if (!afterPass) {
    packActBtns[index].checked = true;
  }

  valid = beforePass && afterPass;
  if (!valid) return;

  packageEnDis(event);

  for (let i = 0; i < packageModels.length; i++) {
    packageModels[i].style.display = "flex";
  }

  for (let i = index + 2; i < packageModels.length; i++) {
    packageModels[i].style.display = "none";
  }

  for (let i = packageModels.length - 2; i >= 0; i--) {
    if (packActBtns[i].checked == false && packActBtns[i + 1].checked == false)
      packageModels[i + 1].style.display = "none";
  }
  packagePriceTotal(2500);
}

function formValidationCheck(index) {
  let packageValid = true;
  let packageModel = packageModels[index];

  let packageImg = packageModel.querySelector(".image-holder");
  let packageTitle = packageModel.querySelector(".edit-package-title");
  let feaArray = featuresArrays[index];
  let feaText = packageModel.querySelector(".feature-box-default");
  let packagePrice = packageModel.querySelector(".input-package-price");

  if (packageImg.style.backgroundImage == "") {
    packageImg.style.border = "1px solid red";
    packageValid = false;
    // return false;
  } else packageImg.style.border = "1px solid #4f4f4f";

  if (packageTitle.value == "") {
    packageTitle.style.border = "1px solid red";
    packageValid = false;
    // return false;
  } else packageTitle.style.border = "1px solid #4f4f4f";

  if (feaArray.length == 0) {
    feaText.style.color = "red";
    packageValid = false;
  } else feaText.style.color = "black";

  let price = packagePrice.value;

  if (price == "" || !numberValidation(price)) {
    packagePrice.style.border = "1px solid red";
    packageValid = false;
  } else packagePrice.style.border = "1px solid #4f4f4f";

  return packageValid;
}

function formValiReColor(index) {
  let packageModel = packageModels[index];

  let packageImg = packageModel.querySelector(".image-holder");
  let packageTitle = packageModel.querySelector(".edit-package-title");
  let feaArray = featuresArrays[index];
  let feaText = packageModel.querySelector(".feature-box-default");
  let packagePrice = packageModel.querySelector(".input-package-price");

  packageImg.style.border = "1px solid #4f4f4f";
  packageTitle.style.border = "1px solid #4f4f4f";
  feaText.style.color = "black";
  packagePrice.style.border = "1px solid #4f4f4f";
}

uploadBtn.addEventListener("click", () => {
  let passValidation = true;
  let seconVerify = true;
  for (let index in packageModels) {
    if (packActBtns[index].checked) {
      seconVerify = formValidationCheck(index);
      if (!seconVerify) passValidation = false;
    } else formValiReColor(index);
  }

  if (passValidation) {
    exportValues();
  }
  // getPayWapper()
});

function numberValidation(input) {
  let nmbrArray = "1234567890";
  for (let i = 0; i < input.length; i++) {
    let check = false;
    for (let j = 0; j < nmbrArray.length; j++) {
      if (input[i] == nmbrArray[j]) check = true;
    }
    if (!check) return false;
  }
  return true;
}

function exportValues() {
  let imgArray = [];
  let titleArray = [];
  let feaArray = [];
  let priceArray = [];

  for (let index in packageModels) {
    let packageModel = packageModels[index];
    if (packActBtns[index].checked) {
      // imgArray.push(packageModel.querySelector('.image-holder').style.backgroundImage)
      let fileInput = packageModel.querySelector(
        '.image-holder input[type="file"]'
      );
      if (fileInput.files.length > 0) {
        let file = fileInput.files[0];
        // let fileName = file.name;
        imgArray.push(file);
      }

      titleArray.push(packageModel.querySelector(".edit-package-title").value);
      priceArray.push(packageModel.querySelector(".input-package-price").value);
    }
  }

  for (let array of featuresArrays) {
    if (array.length != 0) {
      feaArray.push(array);
    }
  }

  // console.log('images', imgArray);
  // console.log('titles', titleArray);
  // console.log('features', feaArray);
  // console.log('prices', priceArray);

  let topbackdrop = document.getElementById("top-backdrop");
  let toplogo = document.getElementById("top-logo");
  let hotelName = document.getElementById("hotelName");
  let hotelLocation = document.getElementById("hotelLocation");
  let regpay = document.getElementById("regpay");
  let distric = document.getElementById("dist_Reg");
  let tid = uploadBtn.getAttribute("data-tid");

  if (tid == "2" || tid == "3") {
    var image1 = document.getElementById("file-1").files[0];
    var image2 = document.getElementById("file-2").files[0];
    var image3 = document.getElementById("file-3").files[0];
    var image4 = document.getElementById("file-4").files[0];
    var image5 = document.getElementById("file-5").files[0];
    var image6 = document.getElementById("file-6").files[0];
    var image7 = document.getElementById("file-7").files[0];
    var image8 = document.getElementById("file-8").files[0];
    var image9 = document.getElementById("file-9").files[0];
  }

  let formData = new FormData();

  formData.append("topbackdrop", topbackdrop.files[0]);
  formData.append("toplogo", toplogo.files[0]);
  formData.append("hotelName", hotelName.value);
  formData.append("hotelLocation", hotelLocation.value);
  formData.append("regpay", regpay.value);
  formData.append("distric", distric.value);
  formData.append("tid", tid);

  if (tid == "2" || tid == "3") {
    formData.append("img1", image1);
    formData.append("img2", image2);
    formData.append("img3", image3);
    formData.append("img4", image4);
    formData.append("img5", image5);
    formData.append("img6", image6);
    formData.append("img7", image7);
    formData.append("img8", image8);
    formData.append("img9", image9);
  }

  for (let i = 0; i < imgArray.length; i++) {
    formData.append("imgArray[]", imgArray[i]);
  }

  for (let k = 0; k < titleArray.length; k++) {
    formData.append("titleArray[]", titleArray[k]);
  }

  for (let m = 0; m < feaArray.length; m++) {
    formData.append("feaArray[]", feaArray[m]);
  }

  for (let n = 0; n < imgArray.length; n++) {
    formData.append("priceArray[]", priceArray[n]);
  }

  // for (let s = 1; s <= 9; s++) {
  //     let gimage = document.getElementById("file-" + s).files[0];

  //     formData.append("gimg" + s, gimage);
  // }

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      if (r.responseText == "success") {
        // location.reload();
        // getPayWapper()
        window.location = "cartPayment.php?Tid=" + tid;
      } else {
        alert(r.responseText);
      }
    }
  };

  r.open("POST", "profileEditProcess.php", true);
  r.send(formData);
}

function load_district() {
  let provi = document.getElementById("provi_Reg").value;

  let r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      document.getElementById("dist_Reg").innerHTML = t;
    }
  };

  r.open("GET", "loadDistrict.php?p=" + provi, true);
  r.send();
}
