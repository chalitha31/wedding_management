<?php
session_start();
require "connection.php";

$Tid = $_POST["tid"];

//////////////////// top section /////////////////

// if (isset($_SESSION["user_email"])) {


if (empty($_FILES["topbackdrop"])) {
    echo "please select Background image";
} elseif (empty($_FILES["toplogo"])) {
    echo "please select logo";
} elseif (empty($_POST["hotelName"])) {
    echo "please enter hotel name";
} elseif (empty($_POST["hotelLocation"])) {
    echo "please enter location";
} elseif ($_POST["distric"] == "0") {
    echo "please select province & distric";
} else {

    $Hotel_last_id = 0;


    if (isset($_FILES["topbackdrop"]) && isset($_FILES["toplogo"]) &&  isset($_POST["hotelName"]) && $_POST["hotelLocation"] &&  isset($_POST["distric"])) {


        $topbackdrop = $_FILES["topbackdrop"];
        $toplogo = $_FILES["toplogo"];
        $hotelName = $_POST["hotelName"];
        $hotelLocation = $_POST["hotelLocation"];
        $regpay = $_POST["regpay"];
        $distric = $_POST["distric"];

        $allowed_image_extension = array("image/jpg", "image/jpeg", "image/png", "image/svg");

        $file_extension1 = $topbackdrop["type"];
        $file_extension2 = $toplogo["type"];



        $uniq_name_Cover = 0;

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


            if ($Tid == "2") {

                $fileName1 = "images//hotels//" . $uniq_name_Cover;
                move_uploaded_file($topbackdrop["tmp_name"], $fileName1);
            } elseif ($Tid == "3") {
                $fileName1 = "images//photographers//" . $uniq_name_Cover;
                move_uploaded_file($topbackdrop["tmp_name"], $fileName1);
            } elseif ($Tid == "4") {
                $fileName1 = "images//dj//" . $uniq_name_Cover;
                move_uploaded_file($topbackdrop["tmp_name"], $fileName1);
            }


            $uniq_name_logo = 0;

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

                if ($Tid == "2") {

                    $fileName2 = "images//hotels//logo//" . $uniq_name_logo;
                    move_uploaded_file($toplogo["tmp_name"], $fileName2);
                } elseif ($Tid == "3") {

                    $fileName2 = "images//photographers//logo//" . $uniq_name_logo;
                    move_uploaded_file($toplogo["tmp_name"], $fileName2);
                } elseif ($Tid == "4") {
                    $fileName2 = "images//dj//logo//" . $uniq_name_logo;
                    move_uploaded_file($toplogo["tmp_name"], $fileName2);
                }


                $d = new DateTime();
                $tz = new DateTimezone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d");

                if ($Tid == "2") {
                    Database::iud("INSERT INTO `hotels` (`name`,`seller_email`,`districts_id`,`location`,`pay_id`,`register_payment`,`register_date`) VALUES ('" . $hotelName . "','" . $_SESSION["user_email"] . "','" . $distric . "','" . $hotelLocation . "','2' ,'" . $regpay . "','" . $date . "')");


                    $Hotel_last_id = Database::$connection->insert_id;

                    Database::iud("INSERT INTO `hotel_img_logo` (`image`,`logo`,`hotel_id`) VALUES ('" . $uniq_name_Cover . "','" . $uniq_name_logo . "','" . $Hotel_last_id . "')");
                } elseif ($Tid == "3") {

                    Database::iud("INSERT INTO `photography` (`name`,`seller_email`,`districts_id`,`company_name`,`pay_id`,`register_payment`,`register_date`) VALUES ('" . $hotelName . "','" . $_SESSION["user_email"] . "','" . $distric . "','" . $hotelLocation . "','2','" . $regpay . "','" . $date . "')");

                    $Hotel_last_id = Database::$connection->insert_id;

                    Database::iud("INSERT INTO `photography__img_logo` (`image`,`logo`,`photography_id`) VALUES ('" . $uniq_name_Cover . "','" . $uniq_name_logo . "','" . $Hotel_last_id . "')");
                } elseif ($Tid == "4") {

                    Database::iud("INSERT INTO `dj` (`name`,`seller_email`,`districts_id`,`company_name`,`pay_id`,`register_payment`,`register_date`) VALUES ('" . $hotelName . "','" . $_SESSION["user_email"] . "','" . $distric . "','" . $hotelLocation . "','2','" . $regpay . "','" . $date . "')");


                    $Hotel_last_id = Database::$connection->insert_id;

                    Database::iud("INSERT INTO `dj_img_logo` (`image`,`logo`,`dj_id`) VALUES ('" . $uniq_name_Cover . "','" . $uniq_name_logo . "','" . $Hotel_last_id . "')");
                }


                //////////////////// top section /////////////////


                //////////////////// package section /////////////////

                if (isset($_FILES['imgArray']) && isset($_POST['titleArray']) && isset($_POST['feaArray']) && isset($_POST['priceArray'])) {
                    $imgArray = $_FILES["imgArray"];
                    $titleArray = $_POST["titleArray"];
                    $feaArray = $_POST["feaArray"];
                    $priceArray = $_POST["priceArray"];

                    // print_r($imgArray);

                    $count = count($imgArray['tmp_name']);

                    // $count = count($titleArray);



                    $allowed_image_extension = array("image/jpg", "image/jpeg", "image/png", "image/svg");

                    for ($i = 0; $i < $count; $i++) {


                        $file_extension = $imgArray["type"][$i];
                        // echo $file_extension;
                        $uniq_name = 0;

                        if (in_array($file_extension, $allowed_image_extension)) {
                            $new_image_extension = $file_extension;

                            if ($file_extension == "image/jpeg") {
                                $new_image_extension = ".jpg";
                            } else if ($file_extension == "image/png") {
                                $new_image_extension = ".png";
                            } else if ($file_extension == "image/jpg") {
                                $new_image_extension = ".jpg";
                            } else if ($file_extension == "image/svg") {
                                $new_image_extension = ".svg";
                            }


                            $uniq_name = uniqid() . $new_image_extension;

                            if ($Tid == "2") {
                                $fileName = "images//hotels//package_img//" . $uniq_name;
                                move_uploaded_file($imgArray["tmp_name"][$i], $fileName);
                            } elseif ($Tid == "3") {
                                $fileName = "images//photographers//package_img//" . $uniq_name;
                                move_uploaded_file($imgArray["tmp_name"][$i], $fileName);
                            } elseif ($Tid == "4") {
                                $fileName = "images//dj//package_img//" . $uniq_name;
                                move_uploaded_file($imgArray["tmp_name"][$i], $fileName);
                            }


                            $pac_type = $titleArray[$i];
                            $price = $priceArray[$i];

                            if ($Tid == "2") {
                                Database::iud("INSERT INTO `packages` (`package_type`,`price`,`preview_image`,`hotel_id`) VALUES('" . $pac_type . "','" . $price . "','" . $uniq_name . "','" . $Hotel_last_id . "')");

                                $last_id = Database::$connection->insert_id;

                                $nestedArray = explode(',', $feaArray[$i]);

                                for ($n = 0; $n < count($nestedArray); $n++) {

                                    $nesterdValue = $nestedArray[$n];
                                    Database::iud("INSERT INTO `package_features` (`package_id`,`title`) VALUES('" . $last_id . "','" . $nesterdValue . "')");
                                }
                                // $value = $nestedArray[$i];


                            } elseif ($Tid == "3") {
                                Database::iud("INSERT INTO `photography_package` (`package_type`,`price`,`preview_image`,`photography_id`) VALUES('" . $pac_type . "','" . $price . "','" . $uniq_name . "','" . $Hotel_last_id . "')");

                                $last_id = Database::$connection->insert_id;

                                $nestedArray = explode(',', $feaArray[$i]);

                                for ($n = 0; $n < count($nestedArray); $n++) {

                                    $nesterdValue = $nestedArray[$n];
                                    Database::iud("INSERT INTO `photography_package_features` (`package_id`,`title`) VALUES('" . $last_id . "','" . $nesterdValue . "')");
                                }
                                // $value = $nestedArray[$i];


                            } elseif ($Tid == "4") {
                                Database::iud("INSERT INTO `dj_package` (`package_type`,`price`,`preview_image`,`dj_id`) VALUES('" . $pac_type . "','" . $price . "','" . $uniq_name . "','" . $Hotel_last_id . "')");

                                $last_id = Database::$connection->insert_id;

                                $nestedArray = explode(',', $feaArray[$i]);

                                for ($n = 0; $n < count($nestedArray); $n++) {

                                    $nesterdValue = $nestedArray[$n];
                                    Database::iud("INSERT INTO `dj_package_features` (`package_id`,`title`) VALUES('" . $last_id . "','" . $nesterdValue . "')");
                                }
                                // $value = $nestedArray[$i];

                            }
                        } else {
                            echo "Please Select a valid cover image";
                        }
                    }
                    // echo "success";
                } else {
                    echo "package Section Error!";
                }

                //////////////////// package section /////////////////



                //////////////////// gallery section /////////////////

                if ($Tid == "2") {

                    $targetDir = "images/hotels/hotel-gallery/";

                    for ($i = 1; $i <= 9; $i++) {

                        // echo $image["type"];

                        if (empty($_FILES["img$i"]) || empty($_FILES["img$i"]["tmp_name"])) {
                            // echo "No image selected";
                            continue; // Skip to the next iteration of the loop
                        } else {
                            $image = $_FILES["img$i"];
                            $allowedImageExtensions = array("image/jpg", "image/jpeg", "image/png", "image/svg");
                            $GfileExtension = $image["type"];

                            if (!in_array($GfileExtension, $allowedImageExtensions)) {
                                echo "Please select a valid image";
                                exit();
                            } else {
                                $GnewImageExtension = "";
                                if ($GfileExtension == "image/jpg") {
                                    $GnewImageExtension = ".jpg";
                                } else if ($GfileExtension == "image/jpeg") {
                                    $GnewImageExtension = ".jpeg";
                                } else if ($GfileExtension == "image/png") {
                                    $GnewImageExtension = ".png";
                                } else if ($GfileExtension == "image/svg") {
                                    $GnewImageExtension = ".svg";
                                }

                                $uniq = uniqid();

                                $GfileName = $targetDir . $uniq . $GnewImageExtension;
                                move_uploaded_file($image["tmp_name"], $GfileName);

                                $imgname = $uniq . $GnewImageExtension;

                                Database::iud("INSERT INTO `gallary` (`image`,`hotel_id`) VALUES('" . $imgname . "','" . $Hotel_last_id . "') ");

                                echo "success";
                            }
                        }
                    }
                } elseif ($Tid == "3") {

                    $targetDir = "images/photographers/photography-gallery/";

                    for ($i = 1; $i <= 9; $i++) {

                        // echo $image["type"];

                        if (empty($_FILES["img$i"]) || empty($_FILES["img$i"]["tmp_name"])) {
                            // echo "No image selected";
                            continue; // Skip to the next iteration of the loop
                        } else {
                            $image = $_FILES["img$i"];
                            $allowedImageExtensions = array("image/jpg", "image/jpeg", "image/png", "image/svg");
                            $GfileExtension = $image["type"];

                            if (!in_array($GfileExtension, $allowedImageExtensions)) {
                                echo "Please select a valid image";
                                exit();
                            } else {
                                $GnewImageExtension = "";
                                if ($GfileExtension == "image/jpg") {
                                    $GnewImageExtension = ".jpg";
                                } else if ($GfileExtension == "image/jpeg") {
                                    $GnewImageExtension = ".jpeg";
                                } else if ($GfileExtension == "image/png") {
                                    $GnewImageExtension = ".png";
                                } else if ($GfileExtension == "image/svg") {
                                    $GnewImageExtension = ".svg";
                                }

                                $uniq = uniqid();

                                $GfileName = $targetDir . $uniq . $GnewImageExtension;
                                move_uploaded_file($image["tmp_name"], $GfileName);

                                $imgname = $uniq . $GnewImageExtension;

                                Database::iud("INSERT INTO `photography_gallary` (`image`,`photography_id`) VALUES('" . $imgname . "','" . $Hotel_last_id . "') ");

                                echo "success";
                            }
                        }
                    }
                }
            } else {
                echo "Please Select a valid cover image";
            }
        } else {
            echo "Please Select a valid logo";
        }
    } else {

        echo "top Section Error!";
    }
}


// } else {
//     echo "Sign in first";
// }

//////////////////// gallery section /////////////////



// print_r($feaArray);
// $nestedArray = explode(',', $feaArray[1]);
// $value = $nestedArray[1];
// echo $value;

// print_r($imgArray);
