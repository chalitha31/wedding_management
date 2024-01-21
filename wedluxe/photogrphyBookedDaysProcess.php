<?php

require "connection.php";

$monthId = $_GET["month_id"];
$pid = $_GET["pid"];

$bdate = new stdClass();
$bdate->dataB = array();

// $btime = new stdClass();
// $btime->dataT = array();


$d = new DateTime();
$tz = new DateTimezone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d");


$monthDuplirs = Database::search("SELECT  `booking_date` FROM `photography_booking` WHERE `packag_id` = '" . $pid . "' AND `order_status` = 'confirmed' GROUP BY `booking_date` HAVING COUNT(booking_date) > 1");
$Dnumr = $monthDuplirs->num_rows;

$Duplidates = array();

while ($duplicate_data = $monthDuplirs->fetch_assoc()) {
    $Duplidates[] = $duplicate_data["booking_date"];
}


$monthrs = Database::search("SELECT DISTINCT  `booking_date` FROM `photography_booking` WHERE `booking_date` > '" . $date . "' AND `packag_id` = '" . $pid . "' AND `order_status` = 'confirmed' ORDER BY `booking_date` ASC");
$numr = $monthrs->num_rows;

if ($numr > 0) {

    for ($x = 0; $x < $numr; $x++) {

        $bookingData = $monthrs->fetch_assoc();

        $timers = Database::search("SELECT   `time_id` FROM `photography_booking` WHERE `booking_date` = '" . $bookingData["booking_date"] . "' AND `packag_id` = '" . $pid . "' AND `order_status` = 'confirmed'");
        $Tnumr = $timers->num_rows;
        $bookingTimeData = $timers->fetch_assoc();

        foreach ($Duplidates as $dup_date) {
            if ($dup_date == $bookingData["booking_date"]) {
                $data2 = new stdClass();
                $data2->bokdate = $bookingData["booking_date"];

                $data2->fday = "Day";
                $data2->fnig = "Night";
                $data2->message = "not available";

                $bdate->dataB[] = $data2;
            }
        }


        if (!in_array($bookingData["booking_date"], $Duplidates)) {

            $data2 = new stdClass();
            $data2->bokdate = $bookingData["booking_date"];

            if ($bookingTimeData["time_id"] == "1") {
                $data2->fday = "";
                $data2->fnig = "Night";
                $data2->message = "available";
            } else if ($bookingTimeData["time_id"] == "2") {
                $data2->fday = "Day";
                $data2->fnig = "";
                $data2->message = "available";
            }
            $bdate->dataB[] = $data2;
        }
    }
    $josn2 = json_encode($bdate);

    echo $josn2;
} else {
    $data2 = new stdClass();
    $data2->bokdate = $date;
    $data2->fday = "Day";
    $data2->fnig = "Night";
    $data2->message = "available";

    $bdate->dataB[] = $data2;

    $josn2 = json_encode($bdate);

    echo $josn2;
}
