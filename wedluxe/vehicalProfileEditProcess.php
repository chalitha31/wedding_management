<?php
session_start();
require "connection.php";

// $Tid = $_POST["tid"];

//////////////////// top section /////////////////

// if (isset($_SESSION["user_email"])) {




if (empty($_FILES["topbackdrop"])) {
    echo "please select Background image";
} elseif (empty($_FILES["toplogo"])) {
    echo "please select logo";
} elseif (empty($_POST["hotelLocation"])) {
    echo "please enter location";
} elseif ($_POST["distric"] == "0") {
    echo "please select province & distric";
} else {

    $Hotel_last_id = 0;
    // $alredyData = 0;
    $uniq_name_Cover = 0;
    $uniq_name_logo = 0;

    if (isset($_FILES["topbackdrop"]) && isset($_FILES["toplogo"])  && $_POST["hotelLocation"] &&  isset($_POST["distric"])) {



        $topbackdrop = $_FILES["topbackdrop"];
        $toplogo = $_FILES["toplogo"];
        // $hotelName = $_POST["hotelName"];
        $hotelLocation = $_POST["hotelLocation"];
        $regpay = $_POST["regpay"];
        $distric = $_POST["distric"];;


        $allowed_image_extension = array("image/jpg", "image/jpeg", "image/png", "image/svg");

        $file_extension1 = $topbackdrop["type"];
        $file_extension2 = $toplogo["type"];





        if (in_array($file_extension1, $allowed_image_extension)) {

            $newimageextension1 = $file_extension1;
            if ($file_extension1 == "image/jpg") {
                $newimageextension1 = ".jpg";
            } else if ($file_extension1 == "image/png") {
                $newimageextension1 = ".png";
            } else if ($file_extension1 == "image/svg") {
                $newimageextension1 = ".svg";
            } else if ($file_extension1 == "image/jpeg") {
                $newimageextension1 = ".jpeg";
            }

            $uniq_name_Cover = uniqid() . $newimageextension1;




            $fileName1 = "images//vehicles//" . $uniq_name_Cover;
            move_uploaded_file($topbackdrop["tmp_name"], $fileName1);
        } else {
            echo "Please Select a valid cover image";
        }



        if (in_array($file_extension2, $allowed_image_extension)) {

            $newimageextension2 = $file_extension2;
            if ($file_extension2 == "image/jpg") {
                $newimageextension2 = ".jpg";
            } else if ($file_extension2 == "image/png") {
                $newimageextension2 = ".png";
            } else if ($file_extension2 == "image/svg") {
                $newimageextension2 = ".svg";
            } else if ($file_extension2 == "image/jpeg") {
                $newimageextension2 = ".jpeg";
            }

            $uniq_name_logo = uniqid() . $newimageextension2;

            $fileName2 = "images//vehicles//logo//" . $uniq_name_logo;
            move_uploaded_file($toplogo["tmp_name"], $fileName2);
        } else {
            echo "Please Select a valid logo";
        }

        // $result = Database::search("SELECT * FROM `vehicles` WHERE `name` = '" . $hotelName . "' AND `seller_email` = '" . $_SESSION["user_email"] . "' AND `company_name` = '" . $hotelLocation . "'");
        // $numrs = $result->num_rows;

        // if ($numrs == "1") {

        //     $alredyData = $result->fetch_assoc();
        // } else {

        $d = new DateTime();
        $tz = new DateTimezone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d");

        Database::iud("INSERT INTO `vehicles` (`seller_email`,`districts_id`,`company_name`,`pay_id`,`register_payment`,`register_date`) VALUES ('" . $_SESSION["user_email"] . "','" . $distric . "','" . $hotelLocation . "','2','" . $regpay . "','" . $date . "')");

        $Hotel_last_id = Database::$connection->insert_id;

        // }
    } else {

        echo "top Section Error!";
    }

    //////////////////// top section /////////////////


    //////////////////// package section /////////////////



    $dataArray = json_decode($_POST["dataArray"], true);
    $arrayCount = count($dataArray);
    // // print_r($dataArray);
    $allowed_image_extension = array("image/jpg", "image/jpeg", "image/png", "image/svg");

    $imgArray = $_FILES["imgArray"];


    $count = count($imgArray['type']);

    for ($i = 0; $i < $count; $i++) {

        // echo $_FILES["imgArray"]['name'][$i];
        // echo $_FILES["OtherimgArray1"]['name'][$i];
        // echo $_FILES["OtherimgArray2"]['name'][$i];



        $color = $dataArray[$i]['color'];
        $brand = $dataArray[$i]['brand'];
        $model = $dataArray[$i]['model'];
        $condition = $dataArray[$i]['condition'];
        $priceMile = $dataArray[$i]['priceMile'];
        $priceDay = $dataArray[$i]['priceDay'];
        $liNo = $dataArray[$i]['liNo'];
        $veNo = $dataArray[$i]['veNo'];
        $reDate = $dataArray[$i]['reDate'];




        Database::iud("INSERT INTO `vehicles_details` (`name`,`model`,`license_no`,`register_date`,`condition_id`,`color`,`Price_Per_Mile`,`extra_day_price`,`vehical_number`,`company_id`) 
        VALUES('" . $brand . "','" . $model . "','" . $liNo . "','" . $reDate . "','" . $condition . "','" . $color . "','" . $priceMile . "','" . $priceDay . "','" . $veNo . "','" . $Hotel_last_id . "')");

        $vehicalDe_last_id = Database::$connection->insert_id;

        Database::iud("INSERT INTO `vehicles_img_logo` (`image`,`logo`,`vehical_details_id`) VALUES ('" . $uniq_name_Cover . "','" . $uniq_name_logo . "','" . $vehicalDe_last_id . "')");


        $carImgProf = $_FILES["imgArray"];
        $file_extension = $carImgProf['type'][$i];
        // echo $file_extension;
        // $ImgProfuniq_name = 0;

        if (in_array($file_extension, $allowed_image_extension)) {
            $new_image_extension = $file_extension;

            if ($file_extension == "image/jpeg") {
                $new_image_extension = ".jpeg";
            } else if ($file_extension == "image/jpg") {
                $new_image_extension = ".jpg";
            } else if ($file_extension == "image/png") {
                $new_image_extension = ".png";
            } else if ($file_extension == "image/svg") {
                $new_image_extension = ".svg";
            }


            $ImgProfuniq_name = uniqid() . $new_image_extension;


            $ProffileName = "images//vehicles//gallary//" . $ImgProfuniq_name;
            move_uploaded_file($carImgProf["tmp_name"][$i], $ProffileName);

            Database::iud("INSERT INTO `vehicles_img` (`img`,`vehical_de_id`) VALUES('" . $ImgProfuniq_name . "','" . $vehicalDe_last_id . "')");
        }

        $OtherimgArray1 = $_FILES["OtherimgArray1"];
        $file_extensionI1 = $OtherimgArray1['type'][$i];

        if (in_array($file_extensionI1, $allowed_image_extension)) {
            $new_image_extensionI1 = $file_extensionI1;

            if ($file_extensionI1 == "image/jpeg") {
                $new_image_extensionI1 = ".jpeg";
            } else if ($file_extensionI1 == "image/jpg") {
                $new_image_extensionI1 = ".jpg";
            } else if ($file_extensionI1 == "image/png") {
                $new_image_extensionI1 = ".png";
            } else if ($file_extensionI1 == "image/svg") {
                $new_image_extensionI1 = ".svg";
            }


            $carI1uniq_name = uniqid() . $new_image_extensionI1;


            $carI1fileName = "images//vehicles//gallary//" . $carI1uniq_name;
            move_uploaded_file($OtherimgArray1["tmp_name"][$i], $carI1fileName);

            Database::iud("INSERT INTO `vehicles_img` (`img`,`vehical_de_id`) VALUES('" . $carI1uniq_name . "','" . $vehicalDe_last_id . "')");
        }

        $OtherimgArray2 = $_FILES["OtherimgArray2"];
        $file_extensionI2 = $OtherimgArray2['type'][$i];

        if (in_array($file_extensionI2, $allowed_image_extension)) {
            $new_image_extensionI2 = $file_extensionI2;

            if ($file_extensionI2 == "image/jpeg") {
                $new_image_extensionI2 = ".jpg";
            } else if ($file_extensionI2 == "image/png") {
                $new_image_extensionI2 = ".png";
            } else if ($file_extensionI2 == "image/svg") {
                $new_image_extensionI2 = ".svg";
            }


            $carI2uniq_name = uniqid() . $new_image_extensionI2;


            $carI2fileName = "images//vehicles//gallary//" . $carI2uniq_name;
            move_uploaded_file($OtherimgArray2["tmp_name"][$i], $carI2fileName);
            Database::iud("INSERT INTO `vehicles_img` (`img`,`vehical_de_id`) VALUES('" . $carI2uniq_name . "','" . $vehicalDe_last_id . "')");
        }
    }
    // }


    echo "success";
}
