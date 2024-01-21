<?php
session_start();
require "connection.php";

$Tid = $_GET["Tid"];


$data = 0;
$nrow = 0;
if ($Tid == "2") {

    $Hresult = Database::search("SELECT * FROM `hotels` WHERE `seller_email` = '" . $_SESSION["user_email"] . "' AND `pay_id` = '2' ORDER BY `id` DESC LIMIT 1");
    $nrow = $Hresult->num_rows;
    if ($nrow == "1") {
        $data = $Hresult->fetch_assoc();
    }
} elseif ($Tid == "3") {

    $Presult = Database::search("SELECT * FROM `photography` WHERE `seller_email` = '" . $_SESSION["user_email"] . "' AND `pay_id` = '2' ORDER BY `id` DESC LIMIT 1");
    $nrow = $Presult->num_rows;
    if ($nrow == "1") {
        $data = $Presult->fetch_assoc();
    }
} elseif ($Tid == "4") {

    $Dresult = Database::search("SELECT * FROM `dj` WHERE `seller_email` = '" . $_SESSION["user_email"] . "' AND `pay_id` = '2' ORDER BY `id` DESC LIMIT 1");
    $nrow = $Dresult->num_rows;
    if ($nrow == "1") {
        $data = $Dresult->fetch_assoc();
    }
}

if ($nrow == "1") {
?>

    <script>
        alert("Complete the payment beforehand!");
        window.location = "cartPayment.php?Tid=" + <?php echo $Tid ?>;
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
        <link rel="stylesheet" href="css/profile-edit-package.css">
        <!-- <link rel="stylesheet" href="css/pay-wrapper.css"> -->

    </head>


    <body>

        <header>
            <img src="images/logo.jpeg" alt="logo" class="logo" onclick="pageTravel('home.php')">

            <?php
            if ($Tid == "2") {
            ?>
                <div class="">Hotel Registation form</div>
            <?php
            } elseif ($Tid == "3") {
            ?>
                <div class="">Photography Registation form</div>
            <?php
            } elseif ($Tid == "4") {
            ?>
                <div class="">Dj Registation form</div>
            <?php
            }
            ?>



            <div class="header-right">
                <!-- <div class="seller-name"><?php echo $_SESSION["user_fname"]  ?></div>
                <div>Total prices : <span class="total-prices"></span></div> -->

                <div>Total prices : <input style="border: none; width: 70px;" id="regpay" class="total-prices" value="" readonly /></div>
                <div class="seller-name"><?php echo $_SESSION["user_fname"]  ?></div>
            </div>
        </header>


        <div class="hotel-profile-container">

            <div class="profile-background-image">

                <!-- <img src="images/profile-fill/prof-ed-backdrop.png" alt=""> -->
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

                    <div class="major-div">

                        <?php
                        if ($Tid == "2") {
                        ?>
                            <label for="cars">Hotel Name : </label>
                        <?php
                        } elseif ($Tid == "3") {
                        ?>
                            <label for="cars">Photography Name : </label>
                        <?php
                        } elseif ($Tid == "4") {
                        ?>
                            <label for="cars">Dj Name : </label>
                        <?php
                        }
                        ?>
                        <input type="text" id="hotelName" />


                        <?php
                        if ($Tid == "2") {
                        ?>
                            <label class="pop" for="cars">loaction (google map link) : </label>
                        <?php
                        } elseif ($Tid == "3") {
                        ?>
                            <label class="pop" for="cars">Company Name : </label>
                        <?php
                        } elseif ($Tid == "4") {
                        ?>
                            <label class="pop" for="cars">Company Name : </label>
                        <?php
                        }
                        ?>
                        <input class="pop" type="text" id="hotelLocation" />
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
                <div class="page-title">Edit Your Packages</div>
                <h3>5 Maximum Packages</h3>
                <div class="package-container">
                    <div class="package-model">
                        <div class="package-en-container" style="pointer-events: none;">
                            <input type="checkbox" class="package-active-check" id="enable-1" checked>
                            <label for="enable-1" class="package-enable">enable</label>
                        </div>
                        <div class="package-name">Package-1</div>
                        <!-- <i class="fa-solid fa-circle-xmark package-close-icon"></i> -->
                        <div class="image-holder">
                            <input type="file" accept="image/*" name="image" id="logo-id" style="display:none;" onchange="loadFile(event)">
                            <label class="label" for="logo-id">
                                <i class="fa-solid fa-cloud-arrow-up upload-pack-img"></i>
                            </label>
                        </div>
                        <input type="text" class="edit-package-title" placeholder="set a title for the package">
                        <div class="feIC">
                            <input type="text" placeholder="add features of the package" class="feature-input">
                            <div class="feature-add-button">ADD</div>
                        </div>
                        <div class="features-container">
                            <div class="feature-box-default">No features added yet</div>
                        </div>
                        <input type="text" class="input-package-price pop" placeholder="set a Price for the package">
                        <!-- <div class="getF">Save</div> -->
                    </div>
                </div>

            </div>

            <?php
            if ($Tid == "2" || $Tid == "3") {
            ?>

                <!-- Gallery Page -->

                <div class="gallery-page">
                    <h3 class="page-title">Fill Your Gallery</h3>

                    <div class="photos-container">

                        <div class="gal-upload-image-box">
                            <i class="fa-regular fa-circle-xmark upload-gal-img-close"></i>
                            <input class="gal-img-upload-input" type="file" accept="image/*" name="image" id="file-1" style="display:none;">
                            <label class="gal-upload-label" for="file-1">
                                <i class="fa-solid fa-cloud-arrow-up upload-gal-img"></i>
                            </label>
                        </div>
                        <div class="gal-upload-image-box">
                            <i class="fa-regular fa-circle-xmark upload-gal-img-close"></i>
                            <input class="gal-img-upload-input" type="file" accept="image/*" name="image" id="file-2" style="display:none;">
                            <label class="gal-upload-label" for="file-2">
                                <i class="fa-solid fa-cloud-arrow-up upload-gal-img"></i>
                            </label>
                        </div>
                        <div class="gal-upload-image-box">
                            <i class="fa-regular fa-circle-xmark upload-gal-img-close"></i>
                            <input class="gal-img-upload-input" type="file" accept="image/*" name="image" id="file-3" style="display:none;">
                            <label class="gal-upload-label" for="file-3">
                                <i class="fa-solid fa-cloud-arrow-up upload-gal-img"></i>
                            </label>
                        </div>
                        <div class="gal-upload-image-box">
                            <i class="fa-regular fa-circle-xmark upload-gal-img-close"></i>
                            <input class="gal-img-upload-input" type="file" accept="image/*" name="image" id="file-4" style="display:none;">
                            <label class="gal-upload-label" for="file-4">
                                <i class="fa-solid fa-cloud-arrow-up upload-gal-img"></i>
                            </label>
                        </div>
                        <div class="gal-upload-image-box">
                            <i class="fa-regular fa-circle-xmark upload-gal-img-close"></i>
                            <input class="gal-img-upload-input" type="file" accept="image/*" name="image" id="file-5" style="display:none;">
                            <label class="gal-upload-label" for="file-5">
                                <i class="fa-solid fa-cloud-arrow-up upload-gal-img"></i>
                            </label>
                        </div>
                        <div class="gal-upload-image-box">
                            <i class="fa-regular fa-circle-xmark upload-gal-img-close"></i>
                            <input class="gal-img-upload-input" type="file" accept="image/*" name="image" id="file-6" style="display:none;">
                            <label class="gal-upload-label" for="file-6">
                                <i class="fa-solid fa-cloud-arrow-up upload-gal-img"></i>
                            </label>
                        </div>
                        <div class="gal-upload-image-box">
                            <i class="fa-regular fa-circle-xmark upload-gal-img-close"></i>
                            <input class="gal-img-upload-input" type="file" accept="image/*" name="image" id="file-7" style="display:none;">
                            <label class="gal-upload-label" for="file-7">
                                <i class="fa-solid fa-cloud-arrow-up upload-gal-img"></i>
                            </label>
                        </div>
                        <div class="gal-upload-image-box">
                            <i class="fa-regular fa-circle-xmark upload-gal-img-close"></i>
                            <input class="gal-img-upload-input" type="file" accept="image/*" name="image" id="file-8" style="display:none;">
                            <label class="gal-upload-label" for="file-8">
                                <i class="fa-solid fa-cloud-arrow-up upload-gal-img"></i>
                            </label>
                        </div>
                        <div class="gal-upload-image-box">
                            <i class="fa-regular fa-circle-xmark upload-gal-img-close"></i>
                            <input class="gal-img-upload-input" type="file" accept="image/*" name="image" id="file-9" style="display:none;">
                            <label class="gal-upload-label" for="file-9">
                                <i class="fa-solid fa-cloud-arrow-up upload-gal-img"></i>
                            </label>
                        </div>


                    </div>
                </div>
            <?php
            }

            ?>
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

            <div style="display: flex;gap: 10px;" class="">
                <div class="upload-button" data-tid="<?php echo $Tid ?>">Upload</div>

            </div>
        </div>







        <script src="js/common.js"></script>
        <script src="js/profile-edit.js"></script>
        <script src="js/profile-edit-package.js"></script>
        <!-- <script src="js/pay-wrapper.js"></script> -->

    </body>

    </html>
<?php
}
?>