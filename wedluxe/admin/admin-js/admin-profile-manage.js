// let blkBtns = Array.from(document.querySelectorAll('.block-btn'));
// let payedTd = Array.from(document.querySelectorAll('.prof-payed-td'));


// function buttonColorSet() {

//     for (let btn of blkBtns) {
//         if (btn.textContent == 'unblock') {

//             btn.style.backgroundColor = 'rgb(255, 106, 106)';
//         } else {
//             btn.style.backgroundColor = 'rgb(255, 206, 206)';
//         }
//     }
//     for (let btn of payedTd) {
//         if (btn.textContent == 'No') {
//             btn.style.color = 'red';
//         } else btn.style.color = 'black';
//     }
// }

// buttonColorSet();



// for (let btn of blkBtns) {
//     btn.addEventListener('click', () => {
//         buttonColorSet();
//     })
// }



function bookhisry() {
    let val = document.getElementById("type-select");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText
                // alert(t);

            document.getElementById("results").innerHTML = t;

        }
    };

    r.open("GET", "profileManageProcess.php?Cid=" + val.value, true);
    r.send();
}

window.onload = function() {
    let val = document.getElementById("type-select");
    // let val = 2;
    // alert(val.value);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText
                // alert(t);

            document.getElementById("results").innerHTML = t;

        }
    };

    r.open("GET", "profileManageProcess.php?Cid=" + val.value, true);
    r.send();
}


function profileBlock(id, val) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            // alert(r.responseText);
            if (r.responseText == "User Unblocked") {
                document.getElementById("btn" + id).className = "block";
                document.getElementById("btn" + id).innerHTML = "Block";
            } else if (r.responseText == "User Blocked") {
                document.getElementById("btn" + id).className = "unblock";
                document.getElementById("btn" + id).innerHTML = "unblock";
            }
        }
    };
    r.open("GET", "profileBlock.php?id=" + id + "&valId=" + val, true);
    r.send();
}