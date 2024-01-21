<?php

require "connection.php";

$weddingDate = $_POST["weddingDate"];
$pcid = $_POST["pcid"];
$email = $_POST["email"];
$mobile = $_POST["mobile"];
$condition = $_POST["condition"];
$pay = $_POST["pay"];
$price = $_POST["price"];

$minpay =  ($price / 100) * 10;

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
    echo "please Select Your Wedding Date";
} else if ($weddingDate <= $date) {
    echo "please Select valid Wedding Date";
} else if ($condition == "0") {
    echo "please Select Function Time";
} else if (empty($pay)) {
    echo "please Enter amount paid?";
} else if (!preg_match('/^[0-9]+$/', $pay)) {
    echo "Invalid amount paid";
} else if ($pay <= $minpay) {
    echo   "Invalid amount paid minimum RS :" . " " . $minpay;
} else if ($pay > $price) {
    echo   "your package price is RS :" . " " . $price;
} else {

    $r = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "'  ");
    $n = $r->num_rows;

    if ($n == 1) {
        $order_id = uniqid();

        $bookdaters = Database::search("SELECT * FROM `photography_booking` WHERE `Booking_date` = '" . $weddingDate . "' AND `packag_id` = '" . $pcid . "' AND `order_status` = 'confirmed' ");

        $num = $bookdaters->num_rows;

        if ($num > 0) {

            $found = false;

            for ($x = 0; $x < $num; $x++) {

                $bokdata = $bookdaters->fetch_assoc();

                if ($bokdata["time_id"] == $condition) {
                    $found = true;
                    break;
                    // echo "Sorry, Function Date or Time  Not available! please look Booked Days.";
                }
            }

            if ($found) {
                echo "Sorry, Function Date or Time Not available! please look Booked Days.";
                $found = false;
            } else {
                Database::iud("INSERT INTO `photography_booking` (`user_email`,`mobile`,`booking_date`,`time_id`,`packag_id`,`order_id`,`order_date`,`pay_id`) VALUES('" . $email . "','" . $mobile . "','" . $weddingDate . "','" . $condition . "','" . $pcid . "','" . $order_id . "','" . $orderDate . "','2')");

                echo "success";
            }
        } else {


            Database::iud("INSERT INTO `photography_booking` (`user_email`,`mobile`,`booking_date`,`time_id`,`packag_id`,`order_id`,`order_date`,`pay_id`) VALUES('" . $email . "','" . $mobile . "','" . $weddingDate . "','" . $condition . "','" . $pcid . "','" . $order_id . "','" . $orderDate . "','2')");

            echo "success";
        }
    } else {
        echo "You are not valid user!";
    }
}
