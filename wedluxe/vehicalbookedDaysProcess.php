<?php

require "connection.php";

$monthId = $_GET["month_id"];
$vid = $_GET["vid"];

$bdate = new stdClass();
$bdate->dataB = array();


$d = new DateTime();
$tz = new DateTimezone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d");




$monthrs = Database::search("SELECT  `extra_date`,`booking_date` FROM `vehical_booking` WHERE `booking_date` > '" . $date . "'  AND `vehical_detils_id` = '" . $vid . "' AND `order_status` = 'confirmed' ORDER BY `booking_date` ASC");
$numr = $monthrs->num_rows;

if ($numr > 0) {

    for ($x = 0; $x < $numr; $x++) {

        $bookingData = $monthrs->fetch_assoc();

        $bookin_day = $bookingData["booking_date"];
        $ext_day = $bookingData["extra_date"];

        for ($i = 0; $i < $ext_day; $i++) {

            $nextDate = date('Y-m-d', strtotime($bookin_day . ' +' . $i . ' day'));



            $data2 = new stdClass();
            $data2->bokdate = $nextDate;

            $data2->fday = "";
            $data2->fnig = "";
            $data2->message = "Booked";

            $bdate->dataB[] = $data2;
        }
    }
    $josn2 = json_encode($bdate);

    echo $josn2;
} else {
    $data2 = new stdClass();
    $data2->bokdate = $date;
    $data2->fday = "";
    $data2->fnig = "";
    $data2->message = "available";

    $bdate->dataB[] = $data2;

    $josn2 = json_encode($bdate);

    echo $josn2;
}
