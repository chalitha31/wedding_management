<?php

require "connection.php";

$e = $_POST["e"];
$np = $_POST["np"];
$rnp = $_POST["rnp"];
$vc = $_POST["vc"];

if (empty($e)) {
    echo "Missing email address.";
} else if (empty($vc)) {
    echo "Please enter your verification code.";
} else if (empty($np)) {
    echo "Please enter your new password.";
} else if (strlen($np) <= 6 || strlen($np) > 20) {
    echo "Password length should be between 6 to 20";
} else if (empty($rnp)) {
    echo "Please re-type your new password.";
} else if ($np != $rnp) {
    echo "You password does not match to your re-pyped password.";
} else {

    $rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $e . "' AND `verification_code`='" . $vc . "'");
    $n = $rs->num_rows;

    if ($n == 1) {

        $hash = hash("sha256", $np);

        Database::iud("UPDATE `users` SET `password`='" . $hash . "' WHERE `email`='" . $e . "'");
        echo "success";
    } else {
        echo "Invalid verification code! Try again Or Resend Verification Code.";
    }
}
