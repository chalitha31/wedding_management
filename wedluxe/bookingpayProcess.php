<?php
session_start();
require "connection.php";

require 'composer/vendor/autoload.php';

require "php_mail/Exception.php";
require "php_mail/PHPMailer.php";
require "php_mail/SMTP.php";


use PHPMailer\PHPMailer\PHPMailer;
use Dompdf\Dompdf;

$cartnunber = $_POST["cartnunber"];
$year = $_POST["year"];
$month = $_POST["month"];
$cvv = $_POST["cvv"];
$Bid = $_POST["Bid"];
$Tid = $_POST["Tid"];
$pay = $_POST["pay"];
$tptice = $_POST["tptice"];

$currentYear = date("Y");
$currentMonth = date("n");

$cartnunberString = strval($cartnunber);
$cartlength = strlen($cartnunberString);

$cvvString = strval($cvv);
$cvvlength = strlen($cvvString);


$uniqueNumber = uniqid(mt_rand(), false);
$paymentNo = substr(preg_replace('/[^0-9]/', '', $uniqueNumber), 0, 6);
// $paymentNo = uniqid();

$d = new DateTime();
$tz = new DateTimezone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i;s");

if (empty($cartnunber)) {
    echo "Please enter Your cart Number";
} elseif ($cartlength < "16") {
    echo "invalid cart number";
} elseif ($year == "0") {
    echo "please select year";
} elseif ($month == "0") {
    echo "please select month";
} elseif ($year == $currentYear && $month < $currentMonth + 1) {
    echo "invalid month";
} elseif (empty($cvv)) {
    echo "please enter cvv";
} elseif ($cvvlength < "3") {
    echo "invalid cvv";
} else {

    if ($Tid == "0") {

        Database::iud("UPDATE `hotel_booking` SET `pay_id` = '1' WHERE `id` = '" . $Bid . "'");
    } elseif ($Tid == "2") {

        Database::iud("UPDATE `photography_booking` SET `pay_id` = '1' WHERE `id` = '" . $Bid . "'");
    } elseif ($Tid == "1") {

        Database::iud("UPDATE `dj_booking` SET `pay_id` = '1' WHERE `id` = '" . $Bid . "'");
    } elseif ($Tid == "3") {

        Database::iud("UPDATE `vehical_booking` SET `pay_id` = '1' WHERE `id` = '" . $Bid . "'");
    }

    Database::iud("INSERT INTO  `booking_payment` (`booking_id`,`user_email`,`card_num`,`card_year`,`card-month`,`category_id`,`Amount_paid`,`paymentNo`,`date`,`total`) 
    VALUES('" . $Bid . "','" . $_SESSION["user_email"] . "','" . $cartnunber . "','" . $year . "','" . $month . "','" . $Tid . "','" . $pay . "','" . $paymentNo . "','" . $date . "','" . $tptice . "')");

    // $numpac = ($pay - 2500) / 2500;




    $fn = $_SESSION["user_fname"];
    $ln = $_SESSION["user_lname"];
    $em = $_SESSION["user_email"];

    // $d = new DateTime();
    // $tz = new DateTimezone("Asia/Colombo");
    // $d->setTimezone($tz);
    // $date = $d->format("Y-m-d H:i:s");


    // reference the Dompdf namespace


    // instantiate and use the dompdf class
    $dompdf = new Dompdf(array('enable_remote' => true));

    $BokingPayRs =   Database::search("SELECT * FROM `booking_payment`  WHERE  `user_email` = '" . $em . "' ORDER BY `id` DESC LIMIT 1");
    $Bpnum = $BokingPayRs->num_rows;
    if ($Bpnum == 1) {

        $bookingdata = $BokingPayRs->fetch_assoc();

        $Tid = $bookingdata["category_id"];

        $catTy = 0;
        $data = 0;
        $Alldata = 0;
        $nrow = 0;
        $bokkingdatee = 0;
        $packageName = 0;
        if ($Tid == "0") {
            $catTy = "Hotel";
            $Hresult =   Database::search("SELECT * FROM `hotel_booking`  WHERE  `user_email` = '" . $_SESSION["user_email"] . "' AND `id` = '" . $bookingdata["booking_id"] . "'  AND `pay_id` = '1' ORDER BY `id` DESC LIMIT 1");
            $nrow = $Hresult->num_rows;
            if ($nrow == "1") {
                $data = $Hresult->fetch_assoc();
                $hotelrs = Database::search("SELECT `hotels`.`seller_email`,`hotels`.`name`,`packages`.`package_type`,`packages`.`price`,`hotel_img_logo`.`logo` FROM `packages` INNER JOIN `hotel_img_logo` ON `packages`.`hotel_id` = `hotel_img_logo`.`hotel_id` INNER JOIN `hotels` ON `packages`.`hotel_id` = `hotels`.`id`  WHERE `packages`.`id` = '" . $data["packag_id"] . "'");
                $Alldata = $hotelrs->fetch_assoc();

                $bokkingdatee = $data["wedding_date"];
                $packageName = $Alldata["package_type"];
            }
        } elseif ($Tid == "2") {
            $catTy = "photography";
            $Presult =  Database::search("SELECT * FROM `photography_booking` WHERE  `user_email` = '" . $_SESSION["user_email"] . "' AND `id` = '" . $bookingdata["booking_id"] . "' AND `pay_id` = '1' ORDER BY `id` DESC LIMIT 1");
            $nrow = $Presult->num_rows;
            if ($nrow == "1") {
                $data = $Presult->fetch_assoc();
                $photors = Database::search("SELECT `photography`.`seller_email`,`photography`.`name`,`photography_package`.`package_type`,`photography_package`.`price`,`photography__img_logo`.`logo` FROM `photography_package` INNER JOIN `photography__img_logo` ON `photography_package`.`photography_id` = `photography__img_logo`.`photography_id` INNER JOIN `photography` ON `photography_package`.`photography_id` = `photography`.`id`  WHERE `photography_package`.`id` = '" . $data["packag_id"] . "'");
                $Alldata = $photors->fetch_assoc();
                $bokkingdatee = $data["booking_date"];
                $packageName = $Alldata["package_type"];
            }
        } elseif ($Tid == "1") {
            $catTy = "Dj";
            $Dresult   = Database::search("SELECT * FROM `dj_booking` WHERE  `user_email` = '" . $_SESSION["user_email"] . "' AND `id` = '" . $bookingdata["booking_id"] . "' AND `pay_id` = '1' ORDER BY `id` DESC LIMIT 1");
            $nrow = $Dresult->num_rows;
            if ($nrow == "1") {
                $data = $Dresult->fetch_assoc();
                $djrs = Database::search("SELECT `dj`.`seller_email`,`dj`.`name`,`dj_package`.`package_type`,`dj_package`.`price`,`dj_img_logo`.`logo` FROM `dj_package` INNER JOIN `dj_img_logo` ON `dj_package`.`dj_id` = `dj_img_logo`.`dj_id` INNER JOIN `dj` ON `dj_package`.`dj_id` = `dj`.`id` WHERE `dj_package`.`id` = '" . $data["packag_id"] . "'");
                $Alldata = $djrs->fetch_assoc();
                $bokkingdatee = $data["booking_date"];
                $packageName = $Alldata["package_type"];
            }
        } elseif ($Tid == "3") {
            $catTy = "vehical";
            $Dresult =  Database::search("SELECT * FROM `vehical_booking` WHERE `user_email` = '" . $_SESSION["user_email"] . "' AND `id` = '" . $bookingdata["booking_id"] . "' AND `pay_id` = '1' ORDER BY `id` DESC LIMIT 1");
            $nrow = $Dresult->num_rows;

            if ($nrow == "1") {
                $data = $Dresult->fetch_assoc();
                $djrs = Database::search("SELECT `vehicles`.`seller_email`,`vehicles_details`.`model`,`vehicles_details`.`name`,`vehicles_img_logo`.`logo` FROM `vehicles_details` INNER JOIN `vehicles_img_logo` ON `vehicles_details`.`id` = `vehicles_img_logo`.`vehical_details_id` INNER JOIN `vehicles` ON `vehicles_details`.`company_id` = `vehicles`.`id`  WHERE `vehicles_details`.`id` = '" . $data["vehical_detils_id"] . "'");
                $Alldata = $djrs->fetch_assoc();
                $bokkingdatee = $data["booking_date"];
                $packageName = $Alldata["model"];
            }
        }

        $gtotal = 0;
        $tt = 0;
        $subt = 0;
        $fnTime = 0;
        $ExtraDays = 0;
        $Vnote = "";
        if ($bookingdata["total"] != "0") {
            $subt = $bookingdata["total"];
            $tt = "Rs : " . "" . $bookingdata["total"] . "." . "00";
            $gtotal = $bookingdata["total"] - $bookingdata["Amount_paid"];
            $ExtraDays = "Time";
            if ($data["time_id"] == 1) {

                $fnTime = "Day";
            } else {
                $fnTime = "Night";
            }
        } else {
            $gtotal = 0;
            $ExtraDays = "Days";
            $Vnote = "Rather than providing a fixed price upfront, we calculate the total amount at the end of your journey, ensuring fairness and transparency in pricing. With no hidden fees or surprises, you can enjoy your trip worry-free, knowing that you will only pay for what you actually used..";
            $subt = $bookingdata["Amount_paid"];
            $tt = "It depends on the distance traveled and the number of days";
            $fnTime = $data["extra_date"] . " " . "Days";
        }


        $dompdf->loadHtml('

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/wedluxe/css/email.css">
</head>

<body>

    <div class="main-div">
        <div class="hed-div">

            <div class="title-div">

                <div class="head-main-details">
                    <h2>WEDLUXE PAYMENT SERVICES</h2>
                    <a>www.wedluxe.com</a>
                </div>

                <div class="head-details">
                    <h2>' . $date . '</h2>
                    <h3>Payment No <span>#' . $bookingdata["paymentNo"] . '</span></h3>
                </div>

            </div>

            <div>
                <h2>Dear ' . $fn . " " .  $ln . ',</h2> <br /> <br />
                <p>Thanks for your payment of<b> LKR ' . $bookingdata["Amount_paid"] . '.00</b> to Wedluxe Payment services.</p>
            </div>

            <hr class="hr" />

            <div class="billing-details">
                <h2><b>Billing Details,</b></h2>
                <br />
                <p><span>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        : </span>' . $fn . " " .  $ln . '</p>
                <p><span>Email
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        : </span> ' . $em . '</p>
                <p><span>Order No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                    </span>' . $data["order_id"] . '</p>
                <p><span>Payment method &nbsp;: </span>Visa</p>
            </div>

        </div>
        <br />
        <table>
            <tr style="border-bottom: 2px solid gray;border-top: 2px solid gray;">
                <th style="width:50%">Description</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th style="text-align:end;">Amount</th>
            </tr>

            <tr>
                <td>' . $catTy . " " . $Alldata["name"] . ' Booking</td>
                <td>Rs : ' . $subt . '.00</td>
                <td>1</td>
                <td style="text-align:end;">Rs : ' . $subt . '.00</td>
            </tr>

           
        </table>


        

        <div class="total-div">

            <div class="total-details">
                <span style="margin-right: 30px; font-size: 23px;" class="onsp">Subtotal</span>&nbsp;&nbsp;
                <span> ' . $tt . '</span>
            </div>

            <br />


            <div class="total-details">
                <span style="margin-right: 30px; font-size: 23px;" class="onsp">Advance</span>&nbsp;&nbsp;
                <span>Rs : ' . $bookingdata["Amount_paid"] . '.00</span>
            </div>

            <br />


            <div class="total-details">
                <span style="margin-right: 60px; font-size: 23px;" class="onsp">Discount</span>
                <span>Rs : 00.00</span>
            </div>



            <div class="total-hr">
                <hr class="sub-hr" />
            </div>

            <br />
            <div class="total-details">
                <span style="margin-right: 30px; font-size: 28px;" class="onsp">Balance</span>
                <span><b>Rs : ' . $gtotal . '.00</b></span>
            </div>

            <div class="total-hr">
                <hr class=" to-hr" />

            </div>

          

        </div>

        <h5 style="margin-top:20px;">' . $Vnote . '</h5>


        <div>
            <p style="margin-top:35px;">Please notify us within <b>5 days</b> for payment related issues.</p>
            <hr class="hrlst" />
        </div>

        <footer>
            <img class="logo-img" src="http://localhost/wedluxe/images/Logo.jpg" type="image">
            <br /> <span>WEDLUXE</span>
        </footer>


    </div>



</body>

</html>');


        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        // $dompdf->stream('payment.pdf');
        $pdffile = $dompdf->output();
        // file_put_contents()


        $Semail = $Alldata["seller_email"];


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
        $mail->addAddress($em);
        $mail->isHTML(true);
        $mail->Subject = 'Wedluxe';
        $bodyContent = '<h2>Dear ' . $fn . " " .  $ln . ', </h2>';
        $bodyContent .= '<p> Thank you for completing the advanced payment for your booking at <b> ' . $catTy . " " . $Alldata["name"] . '</b>. We appreciate your promptness in finalizing the payment and are delighted to confirm your reservation. </p>';
        $bodyContent .= '<h4>Here is a summary of your payment:  </h4>';
        $bodyContent .= '<span>Booking reference number <span style=" font-weight: bold; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;' . $data["order_id"] . '</span> </span> <br/>';
        $bodyContent .= '<span>Date of booking <span style=" font-weight: bold; "> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;' . $bokkingdatee . '</span></span> <br/>';
        $bodyContent .= '<span>Reserved time slot <span style=" font-weight: bold; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;' . $fnTime . '</span></span> <br/>';
        if ($gtotal == 0) {
            $bodyContent .= '<span>Total price <span style=" font-weight: bold; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;' . $Vnote . '</span> </span> <br/>';
        } else {

            $bodyContent .= '<span>Total price <span style=" font-weight: bold; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;Rs ' . $subt . '.00</span></span> <br/>';
        }
        $bodyContent .= '<span>Total amount paid <span style=" font-weight: bold; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;Rs ' . $bookingdata["Amount_paid"] . '.00 </span></span> <br/>';
        $bodyContent .= '<span> Payment method <span style=" font-weight: bold; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;Visa</span></span>';
        $bodyContent .= '<p>We have successfully received your payment of <b> Rs : ' . $bookingdata["Amount_paid"] . '.00 </b> through Visa. Your booking is now confirmed, and we have reserved the venue exclusively for your event. </p>';
        $bodyContent .= '<p>We understand that receiving this confirmation brings peace of mind and allows you to proceed with other preparations. We assure you that our dedicated events team is eagerly anticipating your special day and will be on hand to ensure a seamless and unforgettable experience. </p>';
        $bodyContent .= '<p>If you have any questions or require any further assistance, Please contact our team at <b>0116524858</b> or <b>wedlixe@gmail.com</b>. </p>';
        $bodyContent .= '<p>Once again, thank you for choosing <b>' . $catTy . " " . $Alldata["name"] . '</b>. We are honored to be part of your celebration and look forward to creating beautiful memories together. </p>';
        // $bodyContent .= '<span><b>Warm regards, </b> </span><br/>';
        // $bodyContent .= '<a>www.wedluxe.com</a><br/>';
        // $bodyContent .= '<h3>wedluxe</h3>';
        $bodyContent .= '<br/><div style="display: flex; ">
        <div style="display: flex;  align-items: start; font-size: 30px; font-weight: 600;  color: rgb(58, 58, 58);">WEDLUXE</div>
        <div style="display: flex;  align-items: start; font-size: 15px; font-weight: 600;  color: blue;">www.wedluxe.com</div>
        <img src="https://www.linkpicture.com/q/LogoWedi.png">
         </div>';

        $mail->Body = $bodyContent;
        $mail->addStringAttachment($pdffile, 'payment.pdf');

        if (!$mail->send()) {
            echo "Decline user booking email Sending Failed";
        }


        $Smail = new PHPMailer;
        $Smail->IsSMTP();
        $Smail->Host = 'smtp.gmail.com';
        $Smail->SMTPAuth = true;
        $Smail->Username = 'Wedluxcom@gmail.com';
        $Smail->Password = 'your_password';
        $Smail->SMTPSecure = 'ssl';
        $Smail->Port = 465;
        $Smail->setFrom('your_password', 'Wedding Management');
        $Smail->addReplyTo('your_password', 'Wedding Management');
        $Smail->addAddress($Semail);
        $Smail->isHTML(true);
        $Smail->Subject = 'Wedluxe';
        $bodyContent = '
        <h2 style="margin-bottom: 10px;">Booking Message</h2>
        <br/>
        <table style="width: 600px; border-collapse: collapse; margin: 0; padding: 0; background-color: rgb(228, 228, 228); border-top: 2px solid grey; border-bottom: 2px solid grey;">
            <tr  style="padding: 8px;">
                <td style="font-weight: 600; font-size: 16px;">Name</td>
                <td style="font-weight: 400; width:50px;">:</td>
                <td style="font-weight: 400;">' . $fn . " " .  $ln . '</td>
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
<p>special note : <span>We charge 10% of your package price. It is obtained by advance payment.</span></p>
        <br/>
  
        <div style="display: flex; ">
        <div style="display: flex;  align-items: start; font-size: 30px; font-weight: 600;  color: rgb(58, 58, 58);">WEDLUXE</div>
        <div style="display: flex;  align-items: start; font-size: 15px; font-weight: 600;  color: blue;">www.wedluxe.com</div>
        <img src="https://www.linkpicture.com/q/LogoWedi.png">
         </div>
   

';

        $Smail->Body = $bodyContent;

        if (!$Smail->send()) {
            echo "Decline seller email Sending Failed";
        } else {

            echo "success";
        }

        // echo "success";
    }
}
