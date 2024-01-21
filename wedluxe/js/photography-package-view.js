// let hotelPackageTitles = document.querySelectorAll('.package-title');


// let index = hotelPackageTitles.length - 1;

// let classArray = ['gold', 'platinum', 'bronze']
// let colorIndex = 0;

// for (i = index; i >= 0; i--) {
//     hotelPackageTitles[i].classList.add(classArray[colorIndex]) ;
//     colorIndex++;
// }



// Package booking // 

function photobookNow(pcid, email, price) {



    let weddingDate = document.getElementById("weddingDate");
    let pay = document.getElementById("pay");
    let mobile = document.getElementById("number");

    let condition = 0;

    if (document.getElementById("day").checked) {

        condition = 1;

    } else if (document.getElementById("night").checked) {

        condition = 2;
    }

    var form = new FormData();

    form.append("weddingDate", weddingDate.value);
    form.append("pcid", pcid);
    form.append("email", email);
    form.append("mobile", mobile.value);
    form.append("condition", condition);
    form.append("pay", pay.value);
    form.append("price", price);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {

            let t = r.responseText;

            if (t == "success") {

                window.location = "bookingcartpay.php?pay=" + pay.value + "&Cid=" + '2';

            } else {

                alert(t);

            }
        }

    };


    r.open("POST", "photogrphybookingProcess.php", true);
    r.send(form);

}

// Package booking //


function photoDate(pid) {

    let weddingDate = document.getElementById("weddingDate");
    let selectedDate = new Date(weddingDate.value);
    let selectedMonth = selectedDate.getMonth() + 1;
    var myDiv = document.getElementById("myDiv");
    // alert(selectedMonth); 

    var newContent = '<div id="organizerContainer"></div>';

    myDiv.innerHTML = newContent;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {

            var t = r.responseText;



            var object2 = JSON.parse(t);

            var dataB = object2.dataB;


            "use strict";

            function createDummyData() {

                var data = {};
                for (var i = 0; i < dataB.length; i++) {

                    var startDate = new Date(dataB[i]['bokdate']);

                    var currentDate = startDate;

                    var year = currentDate.getFullYear();
                    var month = currentDate.getMonth() + 1;
                    var day = currentDate.getDate();

                    if (!data[year]) {
                        data[year] = {};
                    }
                    if (!data[year][month]) {
                        data[year][month] = {};
                    }
                    if (!data[year][month][day]) {
                        data[year][month][day] = [];
                    }

                    var event = {

                        startTime: dataB[i]['fday'],
                        endTime: dataB[i]['fnig'],
                        text: dataB[i]['message']

                    };

                    data[year][month][day].push(event);


                }

                return data;
            }



            var data = createDummyData();


            calendar = new Calendar(
                "calendarContainer", // id of html container for calendar
                "small", // size of calendar, can be small | medium | large
                [
                    "Monday", // left most day of calendar labels
                    3 // maximum length of the calendar labels
                ], [
                    "#E91E63", // primary color
                    "#C2185B", // primary dark color
                    "#FFFFFF", // text color
                    "#F8BBD0" // text dark color
                ], { // Following is optional

                    placeholder: "<h3 style='text-align:center; margin-top:10px'>&nbsp; Day - Night &nbsp;&nbsp; available </h3>"
                }
            );



            // initializing a new organizer object, that will use an html container to create itself
            organizer = new Organizer(

                "organizerContainer", // id of html container for calendar
                calendar, // defining the calendar that the organizer is related to
                data // giving the organizer the static data that should be displayed
            );



        }

    };

    r.open("GET", "photogrphyBookedDaysProcess.php?month_id=" + selectedMonth + "&pid=" + pid, true);
    r.send();
}

// document.querySelector('.blocker-button').addEventListener('click', () => { signMenu(signForm) });