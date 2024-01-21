<?php
session_start();
require "connection.php";
if (isset($_SESSION["user_email"])) {
    $bid = $_POST["bid"];
    $count = $_POST["count"];
    $feed = $_POST["feed"];
    // $inid = $_GET["inid"];
    $valId = $_POST["valId"];

    if ($count == 0) {
        echo "Please Select a Rate Star Count";
    } else if ($count > 5 || $count < 1) {
        echo "PLease Enter A valid Star Count";
    } else if (empty($feed)) {
        echo "Please Enter A FeedBack Descirption";
    } else {
        // $rs = Database::search("SELECT *  FROM `product`  WHERE `id` = '" . $id . "' ");
        // $rsn = $rs->num_rows;
        // if ($rsn == 1) {


        if (isset($_FILES["i"])) {

            // echo "sdd";

            // echo "Choose a profile picture if you want.";
            // $img = $_GET["i"];

            // $file_name = "resources//profiles//" . $img;


            $img = $_FILES["i"];



            $allowd_image_extention = array("image/jpg", "image/jpeg", "image/png", "image/svg");
            $fileex = $img["type"];


            if (!in_array($fileex, $allowd_image_extention)) {

                echo "Please Select A Valid Image";
            } else {

                $newimageextention;
                if ($fileex == "image/jpg") {
                    $newimageextention = ".jpg";
                } else if ($fileex = "image/jpeg") {
                    $newimageextention = ".jpeg";
                } else if ($fileex = "image/png") {
                    $newimageextention = ".png";
                } else if ($fileex = "image/svg") {
                    $newimageextention = ".svg";
                }

                $unID =  uniqid();

                $file_name = "images//review//" . $unID . $newimageextention;

                move_uploaded_file($img["tmp_name"], $file_name);

                $databseImg =  $unID . $newimageextention;

                $profilers = Database::search("SELECT * FROM `feedback_img`  WHERE `feedback_user`='" . $_SESSION["user_email"] . "' ");
                $in = $profilers->num_rows;

                if ($in == 1) {

                    Database::iud("UPDATE `feedback_img` SET `image` = '" . $databseImg . "' WHERE  `feedback_user`='" . $_SESSION["user_email"] . "' ");
                } else {

                    Database::iud("INSERT INTO `feedback_img`(`image`,`feedback_user`) VALUES('" . $databseImg . "','" . $_SESSION["user_email"] . "') ");
                }
            }
        }



        $result =  Database::search("SELECT * FROM `feedback` WHERE  `bok_id` ='" . $bid . "' AND  `user_email` = '" . $_SESSION["user_email"] . "'");
        $result_num = $result->num_rows;
        if ($result_num <= 9) {
            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("y-m-d H:i:s");
            Database::iud("INSERT INTO `feedback`(`user_email`,`bok_id`,`feed`,`date`,`star`,`booking_table_id`) VALUES('" . $_SESSION["user_email"] . "','" . $bid . "','" . $feed . "','" . $date . "','" . $count . "','" . $valId . "') ");
            echo "success";
        } else {
            echo "You Can Add Only One FeedBack Per Purchase";
        }
        // } else {
        //     echo "An Error Occured Please Try Refreshing You Browser";
        // }
    }
}
