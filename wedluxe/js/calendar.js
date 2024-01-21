"use strict";

// function that creates dummy data for demonstration
function createDummyData() {
    var startDate = new Date();
    // var endDate = new Date('2023-06-21');
    var data = {};
    var currentDate = startDate;
    var month = 11;
    // for (var currentDate = startDate; currentDate <= endDate; currentDate.setDate(currentDate.getDate() + 1)) {

    var year = currentDate.getFullYear();
    // var month = currentDate.getMonth() + 1;
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
        startTime: "",
        endTime: "",
        text: "Some Event Here"
    };

    data[year][month][day].push(event);
    // }

    return data;
}

// creating the dummy static data
var data = createDummyData();

// initializing a new calendar object, that will use an html container to create itself
var calendar = new Calendar(
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
    ]
);

// initializing a new organizer object, that will use an html container to create itself
var organizer = new Organizer(
    "organizerContainer", // id of html container for calendar
    calendar, // defining the calendar that the organizer is related to
    data // giving the organizer the static data that should be displayed
);