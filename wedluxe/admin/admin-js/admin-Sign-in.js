let gifC = document.querySelector('.gif-container');
let loadIcon = document.querySelector('lord-icon');
let sentL = document.querySelector('.sentL');

gifC.style.visibility = 'hidden';
sentL.style.visibility = 'hidden';
// loadIcon.style.visibility = 'hidden';

function delay(ms) {
    return new Promise(resolve => {
        setTimeout(() => { resolve('') }, ms);
    })
}

gifC.style.opacity = 0;
sentL.style.opacity = 0;
// loadIcon.style.opacity = 0;

async function adminVerification() {

    gifC.style.visibility = 'visible';
    let l = 100;
    for (let i = 0; i <= l; i++) {
        gifC.style.opacity = i / l;
        await delay(1);
    }
    gifC.style.opacity = 1;

    let email = document.getElementById("email");
    let otpinput = document.getElementById("otpinput");
    let sendlogin = document.getElementById("sendlogin");

    var f = new FormData();

    f.append("e", email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = async function() {

        if (r.readyState == 4) {
            let t = r.responseText;

            if (t == "Success") {

                loadIcon.style.visibility = 'hidden';
                sentL.style.visibility = 'visible';

                let l = 50;
                for (let i = 0; i <= l; i++) {
                    sentL.style.opacity = i / l;
                    await delay(1);
                }

                await delay(1000);

                l = 100;
                for (let i = l; i >= 0; i--) {
                    gifC.style.opacity = i / l;
                    await delay(1);
                }
                gifC.style.opacity = 0;
                sentL.style.opacity = 0;
                gifC.style.visibility = 'hidden';


                // alert("your verification code sent successfully. please check your email or gmail!");
                // adminpwfield.classList.remove('adminpwBl');
                // adminpwfield.classList.add('adminpwNoBl');
                otpinput.removeAttribute('disabled');
                email.setAttribute('readonly', true);
                otpinput.focus();
                sendlogin.innerHTML = 'Sign In';

                sendlogin.addEventListener("click", verify);
                sendlogin.onclick = null

            } else {

                alert(t);
                gifC.style.visibility = 'hidden';
                sentL.style.visibility = 'hidden';
                gifC.style.opacity = 0;
                sentL.style.opacity = 0;

            }
        }
    }

    r.open("POST", "adiminVerification.php", true);
    r.send(f);
}


function verify() {
    let otpinput = document.getElementById("otpinput");
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            let t = r.responseText;

            if (t == "success") {

                window.location = "admin-dashboard.php";

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "verifyProcess.php?id=" + otpinput.value, true);
    r.send();
}