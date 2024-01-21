<?php
session_start();
require "connection.php";
if (isset($_SESSION["user_email"])) {

    $bid = $_GET["bid"];
    $val = $_GET["vid"];




    $purchase_rsn = 0;
    if ($val == "0") {

        $purchase_rs = Database::search("SELECT * FROM `hotel_booking`  WHERE `user_email` = '" . $_SESSION["user_email"] . "' AND `id` = '" . $bid . "'  ");

        $purchase_rsn = $purchase_rs->num_rows;

        if ($purchase_rsn == 1) {
            Database::iud("UPDATE `hotel_booking` SET `hidden` = '1' WHERE `id` = '" . $bid . "' ");

            echo "success";
        } else {
            echo "An Error Occured Please Try refreshing the brower";
        }
    } elseif ($val == "1") {

        $purchase_rs = Database::search("SELECT * FROM `dj_booking`  WHERE `user_email` = '" . $_SESSION["user_email"] . "' AND `id` = '" . $bid . "'  ");

        $purchase_rsn = $purchase_rs->num_rows;

        if ($purchase_rsn == 1) {
            Database::iud("UPDATE `dj_booking` SET `hidden` = '1' WHERE `id` = '" . $bid . "' ");

            echo "success";
        } else {
            echo "An Error Occured Please Try refreshing the brower";
        }
    } elseif ($val == "2") {

        $purchase_rs = Database::search("SELECT * FROM `photography_booking`  WHERE `user_email` = '" . $_SESSION["user_email"] . "' AND `id` = '" . $bid . "'  ");

        $purchase_rsn = $purchase_rs->num_rows;

        if ($purchase_rsn == 1) {
            Database::iud("UPDATE `photography_booking` SET `hidden` = '1' WHERE `id` = '" . $bid . "' ");

            echo "success";
        } else {
            echo "An Error Occured Please Try refreshing the brower";
        }
    } elseif ($val == "3") {

        $purchase_rs = Database::search("SELECT * FROM `vehical_booking`  WHERE `user_email` = '" . $_SESSION["user_email"] . "' AND `id` = '" . $bid . "' ");

        $purchase_rsn = $purchase_rs->num_rows;

        if ($purchase_rsn == 1) {
            Database::iud("UPDATE `vehical_booking` SET `hidden` = '1' WHERE `id` = '" . $bid . "' ");

            echo "success";
        } else {
            echo "An Error Occured Please Try refreshing the brower";
        }
    }
}
