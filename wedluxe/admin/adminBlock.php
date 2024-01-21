<?php
require "connection.php";

$email = $_GET["em"];

$inrs = Database::search("SELECT * FROM `admin` WHERE `email` =  '" . $email . "'");

if ($inrs->num_rows == 1) {
    $indata = $inrs->fetch_assoc();

    if ($indata["status"] == '1') {
        Database::iud("UPDATE `admin` SET `status` = '0'  WHERE `email` = '" . $email . "'");
        echo "User Unblocked";
    } else if ($indata["status"] == '0') {
        Database::iud("UPDATE `admin` SET `status` = '1' WHERE `email` = '" . $email . "'");
        echo "User Blocked";
    }
} else {

    echo "no user";
}
