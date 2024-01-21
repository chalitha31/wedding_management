<?php

require "connection.php";

$weddingDate = $_POST["weddingDate"];
$email = $_POST["email"];
$mobile = $_POST["mobile"];
$extraday = $_POST["extraday"];
$vid = $_POST["vid"];
$price = $_POST["price"];

$d = new DateTime();
$tz = new DateTimezone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d");

$orderDate = $d->format("y-m-d H:i:s");


if (empty($mobile)) {
    echo "please enter your Mobile Number";
} else if (strlen($mobile)  != 10) {
    echo "mobile number should contain 10 charachters";
} else if (preg_match("/07[0,1,2,5,6,7,8,][0-9]+/", $mobile) == 0) {
    echo "Invalid Mobile Number.";
} else if (empty($weddingDate)) {
    echo "please Select Your booking Date";
} else if ($weddingDate <= $date) {
    echo "please Select valid booking Date";
} else if ($extraday < "1" || $extraday == "e") {
    echo "Booking days invalid";
} else {

    $r = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "'  ");
    $n = $r->num_rows;

    if ($n == 1) {
        $order_id = uniqid();

        $checkbookdateall = array();

        for ($m = 0; $m < $extraday; $m++) {

            $checkDate = date('Y-m-d', strtotime($weddingDate . ' +' . $m . ' day'));

            $checkbookdateall[] = $checkDate;
        }


        // $bookdaters = Database::search("SELECT * FROM `vehical_booking` WHERE `booking_date` = '" . $weddingDate . "' ");
        $bookdaters = Database::search("SELECT * FROM `vehical_booking` WHERE `vehical_detils_id` = '" . $vid . "' AND `order_status` = 'confirmed'");

        $num = $bookdaters->num_rows;

        $bookedalldata = array();

        for ($n = 0; $n < $num; $n++) {

            $bokdata = $bookdaters->fetch_assoc();

            $bookin_day = $bokdata["booking_date"];
            $ext_day = $bokdata["extra_date"];

            for ($i = 0; $i < $ext_day; $i++) {

                $nextDate = date('Y-m-d', strtotime($bookin_day . ' +' . $i . ' day'));

                $bookedalldata[] = $nextDate;
            }
        }

        $commonDate = array_intersect($checkbookdateall, $bookedalldata);

        if (!empty($commonDate)) {
            echo "Sorry, Some booking Date Unavailable! please look Booked Days: " . implode(', ', $commonDate);
            // echo "Sorry, booking Date Not available! please look Booked Days.";
        } else {

            Database::iud("INSERT INTO `vehical_booking` (`user_email`,`mobile`,`booking_date`,`extra_date`,`vehical_detils_id`,`order_id`,`order_date`,`pay_id`) VALUES('" . $email . "','" . $mobile . "','" . $weddingDate . "','" . $extraday . "','" . $vid . "','" . $order_id . "','" . $orderDate . "','2')");

            echo "success";
        }

        // foreach ($bookedalldata as $check_date) {

        //     if ($check_date == $weddingDate) {

        //         echo "Sorry, booking Date Not available! please look Booked Days.";
        //     }
        // }


        // if (!in_array($weddingDate, $bookedalldata)) {
        //     Database::iud("INSERT INTO `vehical_booking` (`user_email`,`mobile`,`booking_date`,`extra_date`,`vehical_detils_id`) VALUES('" . $email . "','" . $mobile . "','" . $weddingDate . "','" . $extraday . "','" . $vid . "')");

        //     echo "success";
        // }
    } else {
        echo "You are not valid user!";
    }
}
