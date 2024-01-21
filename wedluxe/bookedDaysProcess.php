<?php

require "connection.php";

$monthId = $_GET["month_id"];
$pid = $_GET["pid"];

$bdate = new stdClass();
$bdate->dataB = array();

// $btime = new stdClass();
// $btime->dataT = array();

// <!-- <tr>
//     <th class="th1">Date</th>
//     <th class="th2">Day</th>
//     <th class="th3">Night</th>
// </tr> -->



$d = new DateTime();
$tz = new DateTimezone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d");


$monthDuplirs = Database::search("SELECT  `wedding_date` FROM `hotel_booking` WHERE `packag_id` = '" . $pid . "' AND `order_status` = 'confirmed' GROUP BY `wedding_date` HAVING COUNT(wedding_date) > 1");
$Dnumr = $monthDuplirs->num_rows;

$Duplidates = array();

while ($duplicate_data = $monthDuplirs->fetch_assoc()) {
    $Duplidates[] = $duplicate_data["wedding_date"];
}

// AND  MONTH(`wedding_date`) =  '" . $monthId . "'
$monthrs = Database::search("SELECT DISTINCT  `wedding_date` FROM `hotel_booking` WHERE `wedding_date` > '" . $date . "'  AND `packag_id` = '" . $pid . "' AND `order_status` = 'confirmed' ORDER BY `wedding_date` ASC");
$numr = $monthrs->num_rows;

if ($numr > 0) {

    for ($x = 0; $x < $numr; $x++) {

        $bookingData = $monthrs->fetch_assoc();

        $timers = Database::search("SELECT   `time_id` FROM `hotel_booking` WHERE `wedding_date` = '" . $bookingData["wedding_date"] . "' AND `packag_id` = '" . $pid . "' AND `order_status` = 'confirmed'");
        $Tnumr = $timers->num_rows;
        $bookingTimeData = $timers->fetch_assoc();



        // <tr>



        foreach ($Duplidates as $dup_date) {
            if ($dup_date == $bookingData["wedding_date"]) {

                $data2 = new stdClass();
                $data2->bokdate = $bookingData["wedding_date"];
                // $data2->code = "123";

                $data2->fday = "Day";
                $data2->fnig = "Night";
                $data2->message = "not available";
                // <td class="td1">echobokkingdate</td>
                // <td style="color: #ff4e4e;" class="td2">not available</td>
                // <td style="color: #ff4e4e;" class="td3">not available</td>
                $bdate->dataB[] = $data2;
            }
        }


        if (!in_array($bookingData["wedding_date"], $Duplidates)) {

            $data2 = new stdClass();
            $data2->bokdate = $bookingData["wedding_date"];
            // $data2->code = "123";

            // <!-- <td class="td1"> echo $bookingData["wedding_date"] </td> -->


            if ($bookingTimeData["time_id"] == "1") {

                $data2->fday = "";
                $data2->fnig = "Night";
                $data2->message = "available";
                // <td style="color: #ff4e4e;" class="td2">not available</td>
                // <td style="color: #7bff00;" class="td3">available</td>


            } else if ($bookingTimeData["time_id"] == "2") {

                $data2->fday = "Day";
                $data2->fnig = "";
                $data2->message = "available";
                // <td style="color: #7bff00;" class="td2">available</td>
                // <td style="color: #ff4e4e;" class="td3">not available</td>



            }
            $bdate->dataB[] = $data2;
        }

        // </tr>



        // $tempDate = $bookingData["wedding_date"];
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
    // <tr>

    //     <td class="td1">Dates are</td>
    //     <td class="td2">not booked</td>
    //     <td class="td3">this month</td>

    // </tr>


}
