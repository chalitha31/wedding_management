<?php

session_start();
require "connection.php";


if (isset($_SESSION["admin_email"])) {
    $id = $_GET["id"];
    $Vid = $_GET["valId"];
    // echo $id;
    if ($Vid == "2") {
        $rs = Database::search("SELECT * FROM `hotels` WHERE `id` = '" . $id . "'");

        if ($rs->num_rows == 1) {
            $data = $rs->fetch_assoc();
            if ($data["status"] == '1') {
                Database::iud("UPDATE `hotels` SET `status` = '0'  WHERE `id` = '" . $id . "'");
                echo "User Unblocked";
            } else if ($data["status"] == '0') {
                Database::iud("UPDATE `hotels` SET `status` = '1' WHERE `id` = '" . $id . "'");
                echo "User Blocked";
            }
        } else {
            echo "Error Please Try Again";
        }
    } elseif ($Vid == "3") {
        $rs = Database::search("SELECT * FROM `dj` WHERE `id` = '" . $id . "' ");

        if ($rs->num_rows == 1) {
            $data = $rs->fetch_assoc();
            if ($data["status"] == '1') {
                Database::iud("UPDATE `dj` SET `status` = '0'  WHERE `id` = '" . $id . "'");
                echo "User Unblocked";
            } else if ($data["status"] == '0') {
                Database::iud("UPDATE `dj` SET `status` = '1' WHERE `id` = '" . $id . "'");
                echo "User Blocked";
            }
        } else {
            echo "Error Please Try Again";
        }
    } elseif ($Vid == "4") {
        $rs = Database::search("SELECT * FROM `photography` WHERE `id` = '" . $id . "'");

        if ($rs->num_rows == 1) {
            $data = $rs->fetch_assoc();
            if ($data["status"] == '1') {
                Database::iud("UPDATE `photography` SET `status` = '0'  WHERE `id` = '" . $id . "'");
                echo "User Unblocked";
            } else if ($data["status"] == '0') {
                Database::iud("UPDATE `photography` SET `status` = '1' WHERE `id` = '" . $id . "'");
                echo "User Blocked";
            }
        } else {
            echo "Error Please Try Again";
        }
    } elseif ($Vid == "5") {
        $rs = Database::search("SELECT * FROM `vehicles_details` WHERE `id` = '" . $id . "'");

        if ($rs->num_rows == 1) {
            $data = $rs->fetch_assoc();
            if ($data["status"] == '1') {
                Database::iud("UPDATE `vehicles_details` SET `status` = '0'  WHERE `id` = '" . $id . "'");
                echo "User Unblocked";
            } else if ($data["status"] == '0') {
                Database::iud("UPDATE `vehicles_details` SET `status` = '1' WHERE `id` = '" . $id . "'");
                echo "User Blocked";
            }
        } else {
            echo "Error Please Try Again";
        }
    }
} else {
    echo "Please Sign In as A Admin";
}
