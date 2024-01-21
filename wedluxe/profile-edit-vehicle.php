<?php
session_start();
require "connection.php";

$data = 0;
$nrow = 0;


$vehirs = Database::search("SELECT * FROM `vehicles` INNER JOIN `vehicles_details` ON `vehicles`.`id` = `vehicles_details`.`company_id`   WHERE `vehicles`.`seller_email` = '" . $_SESSION["user_email"] . "' AND `vehicles`.`pay_id` = '2' ORDER BY `vehicles`.`id` DESC LIMIT 1");
$nrow = $vehirs->num_rows;
if ($nrow == "1") {
    // $data = $vehirs->fetch_assoc();
?>

    <script>
        alert("Complete the payment beforehand!");
        window.location = "cartPayment.php?Tid=5";
    </script>

<?php
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile-Edit</title>
        <link rel="icon" href="images/LogoW.png" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/profile-edit.css">
        <link rel="stylesheet" href="css/profile-edit-package-vehicle.css">
    </head>

    <body>

        <header>
            <img src="images/logo.jpeg" alt="logo" class="logo" onclick="pageTravel('home.php')">
            <div class="">vehical Registation form</div>
            <div class="header-right">
                <div>Total prices : <input style="border: none; width: 70px;" id="regpay" class="total-prices" value="" readonly /></div>
                <div class="seller-name"><?php echo $_SESSION["user_fname"]  ?></div>
            </div>
        </header>


        <div class="hotel-profile-container">

            <div class="profile-background-image">

                <input class="top-img-upload-input" type="file" accept="image/*" name="image" id="top-backdrop" style="display:none;">
                <label class="top-upload-label" for="top-backdrop">
                    <i class="fa-solid fa-cloud-arrow-up upload-top-img"></i>
                    <h5>Upload Background Image</h5>
                </label>

                <div class="hotel-major-content">
                    <div class="logo-holder">
                        <input class="top-logo-upload-input" type="file" accept="image/*" name="image" id="top-logo" style="display:none;">
                        <label class="top-logo-label" for="top-logo">
                            <i class="fa-solid fa-cloud-arrow-up upload-top-img"></i>
                            <h5>Upload Logo</h5>
                        </label>

                    </div>

                    <div class="major-divs">
                        <!-- <label for="cars">vehicle Name</label>
                        <input type="text" id="hotelName" /> -->
                        <label for="cars">Company Name&nbsp;:&nbsp;</label>
                        <input type="text" id="hotelLocation" />
                    </div>

                    <div class="hotel-description">

                        <div class="selecting-box">
                            <label for="cars">Choose Province&nbsp;:&nbsp;</label>
                            <select id="provi_Reg" onchange="load_district();">
                                <option value="0">Select Province</option>
                                <?php

                                $pall = Database::search("SELECT * FROM `province` ");
                                $num1 = $pall->num_rows;
                                for ($x = 1; $x <= $num1; $x++) {
                                    $row1 = $pall->fetch_assoc();
                                ?>
                                    <option value="<?php echo $row1["id"]; ?>"><?php echo $row1["name"] ?></option>
                                <?php
                                }

                                ?>
                            </select>
                        </div>

                        <div class="selecting-box">
                            <label for="cars">Choose District&nbsp;:&nbsp;</label>
                            <select id="dist_Reg">
                                <option value="0">Select District</option>
                                <?php
                                $Dall = Database::search("SELECT * FROM `district`  ");
                                $dnum1 = $Dall->num_rows;
                                for ($x = 1; $x <= $dnum1; $x++) {
                                    $drow1 = $Dall->fetch_assoc();
                                ?>
                                    <option value="<?php echo $drow1["id"]; ?>"><?php echo $drow1["name"] ?></option>
                                <?php
                                }

                                ?>
                            </select>
                        </div>

                    </div>
                </div>

            </div>

            <div class="package-page">
                <div class="page-title">Add Your Vehicles</div>
                <h3>5 Maximum Vehicles</h3>
                <div class="package-container">
                    <div class="package-model">
                        <div class="package-en-container" style="pointer-events: none;">
                            <input type="checkbox" class="package-active-check" id="enable-1" checked>
                            <label for="enable-1" class="package-enable">enable</label>
                        </div>
                        <div class="package-name">Vehicle-1</div>
                        <h6>Car profile Photo</h6>
                        <div class="image-holder carImgProf">
                            <input type="file" accept="image/*" name="image" id="logo-id" style="display:none;" onchange="loadFile(event)">
                            <label class="label" for="logo-id">
                                <i class="fa-solid fa-cloud-arrow-up upload-pack-img"></i>
                            </label>
                        </div>
                        <input type="text" class="edit-package-title vb" placeholder="Brand name (ex:-BMW)">
                        <input type="text" class="edit-package-title vm" placeholder="Model name (ex:-7Series) ">
                        <input type="text" class="edit-package-title vc" placeholder="Color (ex:-White) ">
                        <div class="condition-con">
                            <label for="Condition">Condition:</label>
                            <select id="Condition" class="edit-package-title vcon">
                                <option value="">select</option>
                                <option value="1">AC</option>
                                <option value="2">Non AC</option>
                            </select>
                        </div>
                        <input type="text" class="edit-package-title number-inputs vpm" placeholder="Price per Mile (ex:-200) ">
                        <input type="text" class="edit-package-title number-inputs vpd" placeholder="Extra Day Price (ex:-5000) ">
                        <input type="text" class="edit-package-title vln" placeholder="License No (ex:-123456) ">
                        <input type="text" class="edit-package-title vvn" placeholder="Vehicle No (ex:-FKU-6969) ">
                        <h6>Register Date</h6>
                        <input type="date" class="edit-package-title vrd" placeholder="Register Date (ex:-2023/05/25) ">
                        <h6>Add two more photos</h6>
                        <div class="more-img-con">
                            <div class="image-holder carImg1">
                                <input type="file" accept="image/*" name="image" id="more-img1" style="display:none;" onchange="loadFile(event)">
                                <label class="label" for="more-img1">
                                    <i class="fa-solid fa-cloud-arrow-up upload-pack-img"></i>
                                </label>
                            </div>
                            <div class="image-holder carImg2">
                                <input type="file" accept="image/*" name="image" id="more-img2" style="display:none;" onchange="loadFile(event)">
                                <label class="label" for="more-img2">
                                    <i class="fa-solid fa-cloud-arrow-up upload-pack-img"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>




            </div>


            <!-- contact page -->
            <div style="display: none;" class="contact-page">
                <div class="page-title">Socials Details (Select check box & Paste your links here)</div>
                <div class="share">
                    <div class="share-items">
                        <input class="share-checkbox" type="checkbox">
                        <i class="fab fa-facebook-f contact-share-icon"></i>
                        <input class="share-link-input" type="text" placeholder="paste link" disabled>
                    </div>
                    <div class="share-items">
                        <input class="share-checkbox" type="checkbox">
                        <i class="fab fa-twitter contact-share-icon"></i>
                        <input class="share-link-input" type="text" placeholder="paste link" disabled>
                    </div>
                    <div class="share-items">
                        <input class="share-checkbox" type="checkbox">
                        <i class="fab fa-instagram contact-share-icon"></i>
                        <input class="share-link-input" type="text" placeholder="paste link" disabled>
                    </div>
                    <div class="share-items">
                        <input class="share-checkbox" type="checkbox">
                        <i class="fab fa-linkedin contact-share-icon"></i>
                        <input class="share-link-input" type="text" placeholder="paste link" disabled>
                    </div>
                    <div class="share-items">
                        <input class="share-checkbox" type="checkbox">
                        <i class="fab fa-pinterest contact-share-icon"></i>
                        <input class="share-link-input" type="text" placeholder="paste link" disabled>
                    </div>
                </div>

            </div>

            <div class="upload-button">Upload</div>
        </div>

        <script src="js/common.js"></script>
        <script src="js/profile-edit.js"></script>
        <script src="js/profile-edit-package-vehicle.js"></script>
    </body>

    </html>

<?php
}
?>