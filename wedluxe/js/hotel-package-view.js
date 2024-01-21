// Package booking // 

function bookNow(pcid, email, price) {



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
                // let cid = '1';
                // alert("package booking successful");
                // window.location = "home.php";
                window.location = "bookingcartpay.php?pay=" + pay.value + "&Cid=" + '0';
                // location.reload(true);
                // alert(t);
            } else {

                alert(t);

            }
        }

    };


    r.open("POST", "hotelbookingProcess.php", true);
    r.send(form);

}

// Package booking //


function wedDate(pid) {

    let weddingDate = document.getElementById("weddingDate");
    let selectedDate = new Date(weddingDate.value);
    let selectedMonth = selectedDate.getMonth() + 1;
    var myDiv = document.getElementById("myDiv");
    // alert(selectedMonth); 

    var newContent = '<div id="organizerContainer"></div>'; // New content to replace the old content

    // Update the inner HTML of the div with the new content
    myDiv.innerHTML = newContent;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {

            let t = r.responseText;


            // document.getElementById("results").innerHTML = t;
            var object2 = JSON.parse(t);
            var dataB = object2.dataB;




            "use strict";

            function createDummyData() {

                var data = {};
                for (var i = 0; i < dataB.length; i++) {
                    // function that creates dummy data for demonstration
                    // console.log(dataB[i]['bokdate'])

                    var startDate = new Date(dataB[i]['bokdate']);
                    // var endDate = new Date('2023-06-21');
                    var currentDate = startDate;
                    // for (var currentDate = startDate; currentDate <= endDate; currentDate.setDate(currentDate.getDate() + 1)) {
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
                    // }



                }

                return data;
            }


            // var count = Object.keys(event).length;
            // alert(count)
            // creating the dummy static data
            var data = createDummyData();

            // initializing a new calendar object, that will use an html container to create itself
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


            // Render the calendar with the new month

            // for (var m = 0; m < count; m++) {

            // initializing a new organizer object, that will use an html container to create itself
            organizer = new Organizer(

                "organizerContainer", // id of html container for calendar
                calendar, // defining the calendar that the organizer is related to
                data // giving the organizer the static data that should be displayed
            );

            // }
            // if (t == "success") {

            // alert("package booking successful");
            // // window.location = "home.php";
            // location.reload(true);

            // } else {

            // alert(t);

            // }  



        }

    };

    r.open("GET", "bookedDaysProcess.php?month_id=" + selectedMonth + "&pid=" + pid, true);
    r.send();
}