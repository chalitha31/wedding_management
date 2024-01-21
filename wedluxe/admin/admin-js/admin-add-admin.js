// let blkBtns = Array.from(document.querySelectorAll('.block-btn'));


// function buttonColorSet() {

//     for (let btn of blkBtns) {
//         if (btn.textContent == 'unblock') {
//             btn.style.backgroundColor = 'rgb(255, 106, 106)';
//         } else {
//             btn.style.backgroundColor = 'rgb(255, 206, 206)';
//         }
//     }
// }

// buttonColorSet();



// for (let btn of blkBtns) {
//     btn.addEventListener('click', () => {
//         buttonColorSet();
//     })
// }

function addadmin() {

    let fName = document.getElementById("fName");
    let lName = document.getElementById("lName");
    let aEmail = document.getElementById("aEmail");

    let formData = new FormData();

    formData.append("fname", fName.value);
    formData.append("lname", lName.value);
    formData.append("email", aEmail.value);

    let r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {

            if (r.responseText == "success") {
                alert("Successfully added a new moderator");
                location.reload();
            } else {
                alert(r.responseText);
            }

        }


    }

    r.open("POST", "addadminProcess.php", true);
    r.send(formData);
}


function blockAdmin(email) {

    let r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            // alert(r.responseText)
            if (r.responseText == "User Unblocked") {
                document.getElementById("bt" + email).className = "block-btn block";
                document.getElementById("bt" + email).innerHTML = "Block";
            } else if (r.responseText == "User Blocked") {
                document.getElementById("bt" + email).className = "block-btn unblock";
                document.getElementById("bt" + email).innerHTML = "unblock";
            }

        }
    }

    r.open("GET", "adminBlock.php?em=" + email, true);
    r.send();

}