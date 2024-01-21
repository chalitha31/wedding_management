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
$Cid = $_POST["Cid"];
$Tid = $_POST["Tid"];
$pay = $_POST["pay"];

$currentYear = date("Y");
$currentMonth = date("n");

$cartnunberString = strval($cartnunber);
$cartlength = strlen($cartnunberString);

$cvvString = strval($cvv);
$cvvlength = strlen($cvvString);

// $paymentNo = uniqid();
// $uniqueNumber = uniqid(mt_rand(), false);
// $paymentNo = preg_replace('/[^0-9]/', '', $uniqueNumber);

$uniqueNumber = uniqid(mt_rand(), false);
$paymentNo = substr(preg_replace('/[^0-9]/', '', $uniqueNumber), 0, 6);

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

    if ($Tid == "2") {

        Database::iud("UPDATE `hotels` SET `pay_id` = '1' WHERE `id` = '" . $Cid . "'");

        Database::iud("INSERT INTO  `register_payment` (`seller_type`,`seller_mail`,`card_number`,`card_year`,`card_month`,`category`,`price`,`payment_no`,`date`,`category_id`) 
        VALUES('" . $_SESSION["type"] . "','" . $_SESSION["user_email"] . "','" . $cartnunber . "','" . $year . "','" . $month . "','hotel','" . $pay . "','" . $paymentNo . "','" . $date . "','" . $Cid . "')");
    } elseif ($Tid == "3") {

        Database::iud("UPDATE `photography` SET `pay_id` = '1' WHERE `id` = '" . $Cid . "'");

        Database::iud("INSERT INTO  `register_payment` (`seller_type`,`seller_mail`,`card_number`,`card_year`,`card_month`,`category`,`price`,`payment_no`,`date`,`category_id`) 
        VALUES('" . $_SESSION["type"] . "','" . $_SESSION["user_email"] . "','" . $cartnunber . "','" . $year . "','" . $month . "','photography','" . $pay . "','" . $paymentNo . "','" . $date . "','" . $Cid . "')");
    } elseif ($Tid == "4") {

        Database::iud("UPDATE `dj` SET `pay_id` = '1' WHERE `id` = '" . $Cid . "'");

        Database::iud("INSERT INTO  `register_payment` (`seller_type`,`seller_mail`,`card_number`,`card_year`,`card_month`,`category`,`price`,`payment_no`,`date`,`category_id`) 
        VALUES('" . $_SESSION["type"] . "','" . $_SESSION["user_email"] . "','" . $cartnunber . "','" . $year . "','" . $month . "','dj','" . $pay . "','" . $paymentNo . "','" . $date . "','" . $Cid . "')");
    } elseif ($Tid == "5") {

        Database::iud("UPDATE `vehicles` SET `pay_id` = '1' WHERE `id` = '" . $Cid . "'");

        Database::iud("INSERT INTO  `register_payment` (`seller_type`,`seller_mail`,`card_number`,`card_year`,`card_month`,`category`,`price`,`payment_no`,`date`,`category_id`) 
        VALUES('" . $_SESSION["type"] . "','" . $_SESSION["user_email"] . "','" . $cartnunber . "','" . $year . "','" . $month . "','vehicle','" . $pay . "','" . $paymentNo . "','" . $date . "','" . $Cid . "')");
    }






    $fn = $_SESSION["user_fname"];
    $ln = $_SESSION["user_lname"];
    $em = $_SESSION["user_email"];



    // reference the Dompdf namespace




    // instantiate and use the dompdf class
    $dompdf = new Dompdf(array('enable_remote' => true));

    $BokingPayRs =   Database::search("SELECT * FROM `register_payment`  WHERE  `seller_mail` = '" . $em . "' AND `category_id`= '" . $Cid . "' AND `payment_no` = '" . $paymentNo . "' ORDER BY `id` DESC LIMIT 1");
    $Bpnum = $BokingPayRs->num_rows;
    if ($Bpnum == 1) {

        $bookingdata = $BokingPayRs->fetch_assoc();

        $numpac = ($pay - 2500) / 2500;
        $qtypric = 2500 * $numpac;
        $subt = $bookingdata["price"];
        // $Tid = $bookingdata["category_id"];

        $catTy = 0;
        // $data = 0;
        $Alldata = 0;
        $nrow = 0;
        if ($Tid == "2") {
            $catTy = "Hotel";

            $hotelrs = Database::search("SELECT `hotels`.`name`,`packages`.`price`,`hotel_img_logo`.`logo` FROM `packages` INNER JOIN `hotel_img_logo` ON `packages`.`hotel_id` = `hotel_img_logo`.`hotel_id` INNER JOIN `hotels` ON `packages`.`hotel_id` = `hotels`.`id`  WHERE `hotels`.`id` = '" . $Cid . "' AND `hotels`.`seller_email` = '" . $_SESSION["user_email"] . "' ");
            // $nrow = $hotelrs->num_rows;
            // if ($nrow == "1") {
            $Alldata = $hotelrs->fetch_assoc();
            // }
        } elseif ($Tid == "3") {
            $catTy = "photography";

            $photors = Database::search("SELECT `photography`.`name`,`photography_package`.`price`,`photography__img_logo`.`logo` FROM `photography_package` INNER JOIN `photography__img_logo` ON `photography_package`.`photography_id` = `photography__img_logo`.`photography_id` INNER JOIN `photography` ON `photography_package`.`photography_id` = `photography`.`id`  WHERE `photography`.`id` = '" . $Cid . "' AND `photography`.`seller_email` = '" . $_SESSION["user_email"] . "'");
            // $nrow = $photors->num_rows;
            // if ($nrow == "1") {
            $Alldata = $photors->fetch_assoc();
            // }
        } elseif ($Tid == "4") {
            $catTy = "Dj";

            $djrs = Database::search("SELECT `dj`.`name`,`dj_package`.`price`,`dj_img_logo`.`logo` FROM `dj_package` INNER JOIN `dj_img_logo` ON `dj_package`.`dj_id` = `dj_img_logo`.`dj_id` INNER JOIN `dj` ON `dj_package`.`dj_id` = `dj`.`id` WHERE `dj`.`id` = '" . $Cid . "' AND `dj`.`seller_email` = '" . $_SESSION["user_email"] . "'");
            // $nrow = $djrs->num_rows;
            // if ($nrow == "1") {
            $Alldata = $djrs->fetch_assoc();
            // }
        } elseif ($Tid == "5") {
            $catTy = "vehical";

            $djrs = Database::search("SELECT `vehicles_details`.`name`,`vehicles_img_logo`.`logo` FROM `vehicles_details` INNER JOIN `vehicles_img_logo` ON `vehicles_details`.`id` = `vehicles_img_logo`.`vehical_details_id` INNER JOIN `vehicles` ON `vehicles`.`id` = `vehicles_details`.`company_id` WHERE `vehicles`.`id` = '" . $Cid . "' AND `vehicles`.`seller_email` = '" . $_SESSION["user_email"] . "'");
            // $nrow = $djrs->num_rows;
            // if ($nrow == "1") {
            $Alldata = $djrs->fetch_assoc();
            // }
        }

        // $gtotal = 0;
        // $subt = 0;
        // $Vnote = "";
        // if ($bookingdata["total"] != "0") {
        //     $subt = $bookingdata["total"];
        //     $gtotal = $bookingdata["total"] - $bookingdata["Amount_paid"];
        // } else {
        //     $gtotal = 0;
        //     $Vnote = "Check server configuration: If you're hosting your website on a server, ensure that the server is properly configured to handle and serve the Sinhala font files and the correct character encoding.";
        // }


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
                        <h3>Payment No <span>#' . $bookingdata["payment_no"] . '</span></h3>
                    </div>
    
                </div>
    
                <div>
                    <h2>Dear ' . $fn . " " .  $ln . ',</h2> <br /> <br />
                    <p>Thanks for your payment of<b> LKR ' . $bookingdata["price"] . '.00</b> to Wedluxe Payment services.</p>
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
                    <p><span>Payment Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                        </span>' . $bookingdata["date"] . '</p>
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
                    <td>' . $catTy . " " . $Alldata["name"] . ' Register</td>
                    <td>Rs : 2500.00</td>
                    <td>1</td>
                    <td style="text-align:end;">Rs : 2500.00</td>
                </tr>

                <tr>
                    <td>packages </td>
                    <td>Rs : 2500.00</td>
                    <td>' . $numpac . '</td>
                    <td style="text-align:end;">Rs : ' . $qtypric . '.00</td>
                </tr>
    
               
            </table>
    
    
            
    
            <div class="total-div">
    
                <div class="total-details">
                    <span style="margin-right: 30px; font-size: 23px;" class="onsp">Subtotal</span>&nbsp;&nbsp;
                    <span>Rs : ' . $subt . '.00</span>
                </div>
    
                <br />
    
    
              
    
    
                <div class="total-details">
                    <span style="margin-right: 60px; font-size: 23px;" class="onsp">Discount</span>
                    <span>Rs : 0.00</span>
                </div>
    
    
    
                <div class="total-hr">
                    <hr class="sub-hr" />
                </div>
    
                <br />
                <div class="total-details">
                    <span style="margin-right: 30px; font-size: 28px;" class="onsp">Balance</span>
                    <span><b>Rs : 0.00</b></span>
                </div>
    
                <div class="total-hr">
                    <hr class=" to-hr" />
    
                </div>
    
               
    
            </div>
    
          
    
    
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
    }

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    // $dompdf->stream('payment.pdf');
    $pdffile = $dompdf->output();
    // file_put_contents()








    // $email = "chalithachamod3031@gmail.com";


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
    $mail->Subject = 'Wedluxe ';
    $bodyContent = '<h3> <span style="color:red; font-weight: bold;">Congratulations</span> on successfully completing the registration process and making the payment! Were delighted to inform you that all the information regarding your payment is available in the attached PDF file. Now, it is time to explore your registered item on our website, <span style="color:blue; font-weight: bold;">www.wedluxe.com.</span> Get ready to embark on a journey of elegance and luxury. Let us help make your dreams come true!</h3>';

    $mail->Body = $bodyContent;
    $mail->addStringAttachment($pdffile, 'payment.pdf');

    if (!$mail->send()) {
        echo "Decline email Sending Failed";
    } else {

        echo "success";
    }
}
