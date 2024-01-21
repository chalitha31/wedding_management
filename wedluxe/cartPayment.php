<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment</title>
    <link rel="icon" href="images/LogoW.png" />
    <link rel="stylesheet" href="css/pay-wrapper.css">
</head>

<body>

    <?php
    session_start();
    require "connection.php";

    $Tid = $_GET["Tid"];

    $data = 0;
    $Alldata = 0;
    $nrow = 0;
    if ($Tid == "2") {

        $Hresult = Database::search("SELECT * FROM `hotels` WHERE `seller_email` = '" . $_SESSION["user_email"] . "' AND `pay_id` = '2' ORDER BY `id` DESC LIMIT 1");
        $nrow = $Hresult->num_rows;
        if ($nrow == "1") {
            $data = $Hresult->fetch_assoc();
            $hotelrs = Database::search("SELECT `packages`.`price`,`hotel_img_logo`.`logo` FROM `packages` INNER JOIN `hotel_img_logo` ON `packages`.`hotel_id` = `hotel_img_logo`.`hotel_id`  WHERE `packages`.`hotel_id` = '" . $data["id"] . "'");
            $Alldata = $hotelrs->fetch_assoc();
        }
    } elseif ($Tid == "3") {

        $Presult = Database::search("SELECT * FROM `photography` WHERE `seller_email` = '" . $_SESSION["user_email"] . "' AND `pay_id` = '2' ORDER BY `id` DESC LIMIT 1");
        $nrow = $Presult->num_rows;
        if ($nrow == "1") {
            $data = $Presult->fetch_assoc();
            $photors = Database::search("SELECT `photography_package`.`price`,`photography__img_logo`.`logo` FROM `photography_package` INNER JOIN `photography__img_logo` ON `photography_package`.`photography_id` = `photography__img_logo`.`photography_id`  WHERE `photography_package`.`photography_id` = '" . $data["id"] . "'");
            $Alldata = $photors->fetch_assoc();
        }
    } elseif ($Tid == "4") {

        $Dresult = Database::search("SELECT * FROM `dj` WHERE `seller_email` = '" . $_SESSION["user_email"] . "' AND `pay_id` = '2' ORDER BY `id` DESC LIMIT 1");
        $nrow = $Dresult->num_rows;
        if ($nrow == "1") {
            $data = $Dresult->fetch_assoc();
            $djrs = Database::search("SELECT `dj_package`.`price`,`dj_img_logo`.`logo` FROM `dj_package` INNER JOIN `dj_img_logo` ON `dj_package`.`dj_id` = `dj_img_logo`.`dj_id`  WHERE `dj_package`.`dj_id` = '" . $data["id"] . "'");
            $Alldata = $djrs->fetch_assoc();
        }
    } elseif ($Tid == "5") {

        $Dresult = Database::search("SELECT * FROM `vehicles` WHERE `seller_email` = '" . $_SESSION["user_email"] . "' AND `pay_id` = '2' ORDER BY `id` DESC LIMIT 1");
        $nrow = $Dresult->num_rows;

        if ($nrow == "1") {
            $data = $Dresult->fetch_assoc();
            $djrs = Database::search("SELECT `vehicles_img_logo`.`logo` FROM `vehicles_details` INNER JOIN `vehicles_img_logo` ON `vehicles_details`.`id` = `vehicles_img_logo`.`vehical_details_id`  WHERE `vehicles_details`.`company_id` = '" . $data["id"] . "'");
            $Alldata = $djrs->fetch_assoc();
        }
    }

    if ($nrow == "1") {

    ?>

        <!-- payment -->

        <div class="gif-container">
            <span class="proc">processing ...</span>
            <!-- <img class="load-gif" src="images/package_img/preloader.gif"> -->
            <!-- <lord-icon src="https://cdn.lordicon.com/xjovhxra.json" trigger="loop" colors="primary:#30c9e8,secondary:#08a88a" style="width:250px;height:250px"></lord-icon> -->
            <lord-icon src="https://cdn.lordicon.com/ridbdkcb.json" trigger="loop" colors="primary:#4be1ec,secondary:#cb5eee" style="width:100px;height:100px">
            </lord-icon>
            <div class="sentL">Sent</div>
        </div>

        <div class="pay-wrapper">
            <div class="backdrop-blur"></div>
            <div class="pay-card">
                <div class="pay-con">
                    <div class="card-logo-holder">
                        <?php
                        if ($Tid == "2") {
                        ?>
                            <img src="images/hotels/logo/<?php echo $Alldata["logo"] ?>" alt="LOGO" class="card-logo-holder-img">
                        <?php
                        } elseif ($Tid == "3") {
                        ?>
                            <img src="images/photographers/logo/<?php echo $Alldata["logo"] ?>" alt="LOGO" class="card-logo-holder-img">
                        <?php
                        } elseif ($Tid == "4") {
                        ?>
                            <img src="images/dj/logo/<?php echo $Alldata["logo"] ?>" alt="LOGO" class="card-logo-holder-img">
                        <?php
                        } elseif ($Tid == "5") {
                        ?>
                            <img src="images/vehicles/logo/<?php echo $Alldata["logo"] ?>" alt="LOGO" class="card-logo-holder-img">
                        <?php
                        }
                        ?>

                    </div>
                    <div class="pay-con-details">
                        <div class="card-seller-name"><?php echo $_SESSION["user_fname"] ?></div>

                        <div class="card-package-price">Price : <span class="pay-price"><?php echo $data["register_payment"] ?></span></div>

                    </div>
                </div>
                <div class="card-con">
                    <div class="card-num-con">
                        <label>Card Number</label>
                        <div class="input-num-con">
                            <input id="cartN1" class="card-num-input" type="number" maxlength="4">
                            <input id="cartN2" class="card-num-input" type="number" maxlength="4">
                            <input id="cartN3" class="card-num-input" type="number" maxlength="4">
                            <input id="cartN4" class="card-num-input" type="number" maxlength="4">
                        </div>
                    </div>

                    <div class="card-con-footer">
                        <div class="card-exp-con">
                            <label>Expiration</label>
                            <div class="card-ex-in-con">
                                <!-- <input class="card-exp-input" type="number"> -->

                                <select id="year">
                                    <option value="0">Year</option>
                                    <?php
                                    $currentYear = date("Y");
                                    $lastyear = $currentYear + 10;

                                    for ($n = $currentYear; $n < $lastyear; $n++) {
                                    ?>

                                        <option value="<?php echo $n ?>"><?php echo $n ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                                <p> / </p>
                                <!-- <input class="card-exp-input" type="number"> -->

                                <select id="month">
                                    <option value="0">mm</option>
                                    <?php

                                    for ($i = 1; $i < 13; $i++) {
                                    ?>

                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>

                                    <?php
                                    }
                                    ?>


                                </select>
                            </div>
                        </div>
                        <div class="card-ccv-con">
                            <label>CCV</label>
                            <input id="cvv" class="card-ccv-input" type="number">
                        </div>
                    </div>
                </div>


                <div class="pay-btn" onclick="paying('<?php echo $Tid ?>','<?php echo $data['id'] ?>','<?php echo $data['register_payment'] ?>')">Pay</div>


            </div>

        </div>

        <!-- payment -->

    <?php
    }
    ?>

    <script src="js/pay-wrapper.js"></script>
    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
</body>

</html>