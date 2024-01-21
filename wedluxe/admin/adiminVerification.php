<?php

require "connection.php";
require "../php_mail/Exception.php";
require "../php_mail/PHPMailer.php";
require "../php_mail/SMTP.php";


use PHPMailer\PHPMailer\PHPMailer;


if (!isset($_POST["e"])) {
    echo "Please Enter Your Email";
} else if (!filter_var($_POST["e"], FILTER_VALIDATE_EMAIL)) {
    echo "Please Enter a Valid Email";
} else {

    $email = $_POST["e"];

    $rs = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $email . "' ");

    if ($rs->num_rows == 1) {
        $aData = $rs->fetch_assoc();

        if ($aData["status"] == '0') {


            $code = uniqid();
            Database::iud("UPDATE `admin` SET `otp` = '" . $code . "' WHERE `email` = '" . $email . "' ");

            // email code
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'Wedluxcom@gmail.com';
            $mail->Password = 'your_password';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('your_password', 'Wedding Management');
            $mail->addReplyTo('your_password', 'Wedding Management');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Admin Verification Code';
            $bodyContent = '<h1 style="color:red;"><b>Your verification code is : </b>' . $code . '</h1>';

            $mail->Body = $bodyContent;

            if (!$mail->send()) {
                echo "Decline seller email Sending Failed";
            } else {

                echo "Success";
            }
        } else {
            echo "Sorry! You have been blocked by admin";
        }
    } else {
        echo "You are not a valid user";
    }
}
