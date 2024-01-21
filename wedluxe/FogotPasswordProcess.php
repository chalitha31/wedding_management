<?php

require "connection.php";
require "php_mail/SMTP.php";
require "php_mail/Exception.php";
require "php_mail/PHPMailer.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {
    $email = $_GET["e"];

    if (empty($email)) {
        echo "Please Enter Your valid Email.";
    } else {
        $rs = Database::search("SELECT * FROM `users`  WHERE `email`= '" . $email . "'");
        if ($rs->num_rows == 1) {
            $code = uniqid();

            Database::iud("UPDATE `users` SET `verification_code`='" . $code . "' WHERE `email` = '" . $email . "'");


            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'Wedluxcom@gmail.com';
            $mail->Password = 'your_password';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('Wedluxcom@gmail.com', 'Wedding Management');
            $mail->addReplyTo('Wedluxcom@gmail.com', 'Wedding Management');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Wedding Management Forgot Password Verification Code.';
            $bodyContent = ' <h1 style = "color : green;">Your Verification code is :' . $code . '</h1> ';


            $mail->Body = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }
        } else {

            echo "Email address not found";
        }
    }
} else {
    echo "Please enter your Email address.";
}
