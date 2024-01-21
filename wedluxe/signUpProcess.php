<?php

require "connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$Repassword = $_POST["Repassword"];
$condition = $_POST["condition"];



if (empty($fname)) {
    echo "Please enter your first name";
    exit();
} else if (strlen($fname) > 30) {
    echo "first name must be less than 30 characters";
    exit();
} else if (empty($lname)) {
    echo "Please enter your last name";
    exit();
} else if (strlen($lname) > 30) {
    echo "last name must be less than 30 characters";
    exit();
} else if (empty($email)) {
    echo "Please enter your email";
    exit();
} else if (strlen($email) >= 100) {
    echo "Email must be less than 100 characters";
    exit();
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email Address";
    exit();
} else if (empty($password)) {
    echo "Please enter your password";
    exit();
} else if (strlen($password) <= 5 || strlen($password) >= 20) {
    echo "password length should be between 6 to 20";
    exit();
} else if (empty($Repassword)) {
    echo "Please enter your ReType-password";
    exit();
} else if ($password != $Repassword) {
    echo  "Password & Retype-password does not match";
    exit();
} else {


    $hash = hash("sha256", $password);


    $resultset = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "' ");
    $n = $resultset->num_rows;

    if ($n > 0) {

        echo "already used in this email. try again.";
        exit();
    } else {

        $d = new DateTime();
        $tz = new DateTimezone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i;s");

        Database::iud("INSERT INTO `users` (`fname`,`lname`,`email`,`password`,`register_date`,`user_type_id`) VALUES('" . $fname . "','" . $lname . "','" . $email . "','" . $hash . "','" . $date . "','" . $condition . "')");

        echo "success";
        exit();
    }
}
