<?php
session_start();
require "connection.php";

require "php_mail/Exception.php";
require "php_mail/PHPMailer.php";
require "php_mail/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_SESSION["user_email"])) {

    $bid = $_GET["bid"];
    $val = $_GET["vid"];

    $fn = $_SESSION["user_fname"];
    $ln = $_SESSION["user_lname"];
    $em = $_SESSION["user_email"];

    $bokkingdatee = 0;
    $packageName = 0;
    $Alldata = 0;

    $purchase_rsn = 0;

    $BokingPayRs =   Database::search("SELECT * FROM `booking_payment`  WHERE  `user_email` = '" . $em . "' AND `category_id` = '" . $val . "' ORDER BY `id` DESC LIMIT 1");
    $Bpnum = $BokingPayRs->num_rows;

    if ($Bpnum == 1) {
        $bookingdata = $BokingPayRs->fetch_assoc();


        if ($val == "0") {

            $purchase_rs = Database::search("SELECT * FROM `hotel_booking`  WHERE `user_email` = '" . $_SESSION["user_email"] . "' AND `id` = '" . $bid . "'  ");

            $purchase_rsn = $purchase_rs->num_rows;

            if ($purchase_rsn == 1) {

                $data = $purchase_rs->fetch_assoc();
                $hotelrs = Database::search("SELECT `hotels`.`seller_email`,`hotels`.`name`,`packages`.`package_type`,`packages`.`price`,`hotel_img_logo`.`logo` FROM `packages` INNER JOIN `hotel_img_logo` ON `packages`.`hotel_id` = `hotel_img_logo`.`hotel_id` INNER JOIN `hotels` ON `packages`.`hotel_id` = `hotels`.`id`  WHERE `packages`.`id` = '" . $data["packag_id"] . "'");
                $Alldata = $hotelrs->fetch_assoc();
                $bokkingdatee = $data["wedding_date"];
                $packageName = $Alldata["package_type"];

                Database::iud("UPDATE `hotel_booking` SET `order_status` = 'cancel' WHERE `id` = '" . $bid . "' ");

                // echo "success";
            } else {
                echo "An Error Occured Please Try refreshing the brower";
            }
        } elseif ($val == "1") {

            $purchase_rs = Database::search("SELECT * FROM `dj_booking`  WHERE `user_email` = '" . $_SESSION["user_email"] . "' AND `id` = '" . $bid . "'  ");

            $purchase_rsn = $purchase_rs->num_rows;

            if ($purchase_rsn == 1) {

                $data = $purchase_rs->fetch_assoc();
                $djrs = Database::search("SELECT `dj`.`seller_email`,`dj`.`name`,`dj_package`.`package_type`,`dj_package`.`price`,`dj_img_logo`.`logo` FROM `dj_package` INNER JOIN `dj_img_logo` ON `dj_package`.`dj_id` = `dj_img_logo`.`dj_id` INNER JOIN `dj` ON `dj_package`.`dj_id` = `dj`.`id` WHERE `dj_package`.`id` = '" . $data["packag_id"] . "'");
                $Alldata = $djrs->fetch_assoc();
                $bokkingdatee = $data["booking_date"];
                $packageName = $Alldata["package_type"];

                Database::iud("UPDATE `dj_booking` SET `order_status` = 'cancel' WHERE `id` = '" . $bid . "' ");

                // echo "success";
            } else {
                echo "An Error Occured Please Try refreshing the brower";
            }
        } elseif ($val == "2") {

            $purchase_rs = Database::search("SELECT * FROM `photography_booking`  WHERE `user_email` = '" . $_SESSION["user_email"] . "' AND `id` = '" . $bid . "'  ");

            $purchase_rsn = $purchase_rs->num_rows;

            if ($purchase_rsn == 1) {

                $data = $purchase_rs->fetch_assoc();
                $photors = Database::search("SELECT `photography`.`seller_email`,`photography`.`name`,`photography_package`.`package_type`,`photography_package`.`price`,`photography__img_logo`.`logo` FROM `photography_package` INNER JOIN `photography__img_logo` ON `photography_package`.`photography_id` = `photography__img_logo`.`photography_id` INNER JOIN `photography` ON `photography_package`.`photography_id` = `photography`.`id`  WHERE `photography_package`.`id` = '" . $data["packag_id"] . "'");
                $Alldata = $photors->fetch_assoc();
                $bokkingdatee = $data["booking_date"];
                $packageName = $Alldata["package_type"];

                Database::iud("UPDATE `photography_booking` SET `order_status` = 'cancel' WHERE `id` = '" . $bid . "' ");

                // echo "success";
            } else {
                echo "An Error Occured Please Try refreshing the brower";
            }
        } elseif ($val == "3") {

            $purchase_rs = Database::search("SELECT * FROM `vehical_booking`  WHERE `user_email` = '" . $_SESSION["user_email"] . "' AND `id` = '" . $bid . "' ");

            $purchase_rsn = $purchase_rs->num_rows;

            if ($purchase_rsn == 1) {

                $data = $purchase_rs->fetch_assoc();
                $djrs = Database::search("SELECT `vehicles`.`seller_email`,`vehicles_details`.`model`,`vehicles_details`.`name`,`vehicles_img_logo`.`logo` FROM `vehicles_details` INNER JOIN `vehicles_img_logo` ON `vehicles_details`.`id` = `vehicles_img_logo`.`vehical_details_id` INNER JOIN `vehicles` ON `vehicles_details`.`company_id` = `vehicles`.`id`  WHERE `vehicles_details`.`id` = '" . $data["vehical_detils_id"] . "'");
                $Alldata = $djrs->fetch_assoc();
                $bokkingdatee = $data["booking_date"];
                $packageName = $Alldata["model"];

                Database::iud("UPDATE `vehical_booking` SET `order_status` = 'cancel' WHERE `id` = '" . $bid . "' ");

                // echo "success";
            } else {
                echo "An Error Occured Please Try refreshing the brower";
            }
        }


        // $gtotal = 0;
        $tt = 0;
        // $subt = 0;
        $fnTime = 0;
        $ExtraDays = 0;
        $Vnote = "";




        if ($val == "3") {

            // $gtotal = 0;
            $ExtraDays = "Days";
            $Vnote = "Rather than providing a fixed price upfront, we calculate the total amount at the end of your journey, ensuring fairness and transparency in pricing. With no hidden fees or surprises, you can enjoy your trip worry-free, knowing that you will only pay for what you actually used..";
            // $subt = $bookingdata["Amount_paid"];
            $tt = "It depends on the distance traveled and the number of days";
            $fnTime = $data["extra_date"] . " " . "Days";
        } else {

            // $subt = $bookingdata["total"];
            $tt = "Rs : " . "" . $bookingdata["total"] . "." . "00";
            // $gtotal = $bookingdata["total"] - $bookingdata["Amount_paid"];
            $ExtraDays = "Time";
            if ($data["time_id"] == 1) {

                $fnTime = "Day";
            } else {
                $fnTime = "Night";
            }
        }

        $Semail = $Alldata["seller_email"];

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
        $mail->addAddress($Semail);
        $mail->isHTML(true);
        $mail->Subject = 'Wedluxe';
        $bodyContent = '
    <h1 style="margin-bottom: 10px; color: red;">Booking Cancelled!</h1>
    <br/>
    <table style="width: 600px; border-collapse: collapse; margin: 0; padding: 0; background-color: rgb(228, 228, 228); border-top: 2px solid grey; border-bottom: 2px solid grey;">
        <tr  style="padding: 8px;">
            <td style="font-weight: 600; font-size: 16px;">Name</td>
            <td style="font-weight: 400; width:50px;">:</td>
            <td style="font-weight: 400;">' . $fn . " " . $ln . '</td>
        </tr>
        <tr  style="padding: 8px;">
            <td style="font-weight: 600; font-size: 16px;">Email</td>
            <td style="font-weight: 400;  width:50px;">:</td>
            <td style="font-weight: 400;">' . $em . '</td>
        </tr>
        <tr  style="padding: 8px;">
            <td style="font-weight: 600; font-size: 16px;">Number</td>
            <td style="font-weight: 400;  width:50px;">:</td>
            <td style="font-weight: 400;">' . $data["mobile"] . '</td>
        </tr>
        <tr  style="padding: 8px;">
            <td style="font-weight: 600; font-size: 16px;">Booking Date</td>
            <td style="font-weight: 400;  width:50px;">:</td>
            <td style="font-weight: 400;">' . $bokkingdatee . '</td>
        </tr>
        <tr  style="padding: 8px;">
            <td style="font-weight: 600; font-size: 16px;">' . $ExtraDays . '</td>
            <td style="font-weight: 400;  width:50px;">:</td>
            <td style="font-weight: 400;">' . $fnTime . '</td>
        </tr>
        <tr  style="padding: 8px;">
            <td style="font-weight: 600; font-size: 16px;">Profile</td>
            <td style="font-weight: 400;  width:50px;">:</td>
            <td style="font-weight: 400;">' . $Alldata["name"] . '</td>
        </tr >
        <tr  style="padding: 8px;">
            <td style="font-weight: 600; font-size: 16px;">Package Name</td>
            <td style="font-weight: 400;  width:50px;">:</td>
            <td style="font-weight: 400;">' . $packageName . '</td>
        </tr>
        <tr  style="padding: 8px;">
            <td style="font-weight: 600; font-size: 16px;">Package Price </td>
            <td style="font-weight: 400;  width:50px;">:</td>
            <td style="font-weight: 400;">' . $tt . '</td>
        </tr>
        <tr  style="padding: 8px;">
           <td style="font-weight: 600; font-size: 16px;">Advance Payment </td>
           <td style="font-weight: 400;  width:50px;">:</td>
           <td style="font-weight: 400;">Rs : ' . $bookingdata["Amount_paid"] . '.00</td>
        </tr>
        <tr  style="padding: 8px;">
            <td style="font-weight: 600; font-size: 16px;">Order ID</td>
            <td style="font-weight: 400;  width:50px;">:</td>
            <td style="font-weight: 400;">' . $data["order_id"] . '</td>
        </tr>
        <tr  style="padding: 8px;">
            <td style="font-weight: 600; font-size: 16px;">Order Date</td>
            <td style="font-weight: 400;  width:50px;">:</td>
            <td style="font-weight: 400;">' . $data["order_date"] . '</td>
        </tr>
    </table>

    <br/>
<p style="font-size: 50px;">special note : <span style="font-size: 40px;  color: red; font-weight: 600;">Sorry, customer has canceled this order!</span></p>
    <br/>

    <div style="display: flex; ">
    <div style="display: flex;  align-items: start; font-size: 30px; font-weight: 600;  color: rgb(58, 58, 58);">WEDLUXE</div>
    <div style="display: flex;  align-items: start; font-size: 15px; font-weight: 600;  color: blue;">www.wedluxe.com</div>
    <img src="https://www.linkpicture.com/q/LogoWedi.png">
     </div>


';

        $mail->Body = $bodyContent;

        if (!$mail->send()) {
            echo "Decline seller email Sending Failed";
        } else {

            echo "success";
        }
    }
}
