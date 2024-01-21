<?php

require "header.php";

if (isset($_GET['id'])) {
    $vehid = $_GET['id'];
?>



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>vehicle-profile</title>
        <link rel="icon" href="images/LogoW.png" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.rawgit.com/nizarmah/calendar-javascript-lib/master/calendarorganizer.min.css">
        <link rel="stylesheet" href="css/calendar.css">
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/vehicle-profile.css">
    </head>

    <body onload="wedDate('<?php echo $vehid ?>');">
        <!-- <header>
            <div class="header-left">
                <a onclick="pageTravel('home.php')"><img src="images/logo.jpeg" alt="LOGO" class="logo"></a>
            </div>
            <nav class="header-mid">
                <a onclick="pageTravel('hotel-home.php')">Hotels</a>
                <a onclick="pageTravel('photography-home.php')">Photography</a>
                <a onclick="pageTravel('dj-home.php')">Dj</a>
                <a onclick="pageTravel('vehicle-home.php')">Vehicals</a>
            </nav>
            <div class="header-right">
                <div class="user">User</div>
                <div class="sign-text">Sign in</div>
            </div>
            <img src="images/hamburger.png" alt="" class="hamb-menu">
            <div class="nav-dropdown">
                <a onclick="pageTravel('hotel-home.php')">Hotels</a>
                <a onclick="pageTravel('photography-home.php')">Photography</a>
                <a onclick="pageTravel('dj-home.php')">Dj</a>
                <a onclick="pageTravel('vehicle-home.php')">Vehicals</a>
            </div>
        </header> -->

        <div class="hotel-profile-container">

            <?php



            // $vehirs = Database::search("SELECT * FROM `vehicles` INNER JOIN `vehicles_img_logo` ON `vehicles`.`id` = `vehicles_img_logo`.`vehical_details_id` WHERE `hotels`.`id`= '" . $Hotelid . "'");
            $vehirs = Database::search("SELECT * FROM `vehicles` INNER JOIN `vehicles_details` ON `vehicles`.`id` = `vehicles_details`.`company_id` INNER JOIN  `vehicles_img` ON `vehicles_details`.`id` = `vehicles_img`.`vehical_de_id` INNER JOIN  `vehicles_img_logo` ON `vehicles_details`.`id` = `vehicles_img_logo`.`vehical_details_id` INNER JOIN  `vehicles_condition` ON `vehicles_details`.`condition_id` = `vehicles_condition`.`id`  WHERE `vehicles_details`.`id`= '" . $vehid . "'");
            $hnum = $vehirs->num_rows;

            $hotelData = $vehirs->fetch_assoc();

            ?>

            <div class="profile-background-image">
                <img src="images/vehicles/<?php echo $hotelData["image"] ?>" alt="">
                <div class="hotel-major-content">
                    <div class="logo-holder">
                        <img src="images/vehicles/logo/<?php echo $hotelData["logo"] ?>" alt="" class="hotel-logo">
                    </div>
                    <div class="hotel-description">
                        <h1><?php echo $hotelData["company_name"] ?></h1>
                        <h4><?php echo $hotelData["name"] ?></h4>
                    </div>
                </div>
            </div>

            <div class="package-page">
                <img src="images/backdrop-2.png" alt="" class="backdrop">
                <img src="images/backdrop-2.png" alt="" class="backdrop">
                <div class="page-title">Car View</div>
                <div class="package-container">


                    <div class="car-image-holder">
                        <img src="images/vehicles/gallary/<?php echo $hotelData["img"] ?>" alt="" class="pack-car-img">
                    </div>
                    <div class="car-details">
                        <div class="car-name pop"><?php echo $hotelData["name"] ?></div>
                        <h3>Features</h3>
                        <ul>
                            <li>Model : <?php echo $hotelData["model"] ?></li>
                            <li>Color : <?php echo $hotelData["color"] ?></li>
                            <li>Condition : <?php echo $hotelData["condition_name"] ?></li>
                            <li>For one extra day : Rs <?php echo $hotelData["extra_day_price"] ?>.00</li>
                            <!-- <li>Register Date : <?php echo $hotelData["register_date"] ?></li> -->
                            <!-- <li>feature 5</li> -->
                        </ul>
                        <div class="package-price">Price Per Mile <span>Rs : <?php echo $hotelData["Price_Per_Mile"] ?>.00</span></div>
                    </div>
                </div>



                <div class="gallery-page">
                    <h3 class="page-title">More Photos</h3>

                    <div class="photo-viewer-back">
                        <div class="photo-viewer">
                            <img class="photo-view" src="" alt="" srcset="">
                        </div>
                        <div class="photo-view-title"></div>
                    </div>

                    <div class="photos-container">
                        <?php

                        $vehiPhors = Database::search("SELECT * FROM `vehicles_img`  WHERE `vehicles_img`.`vehical_de_id`= '" . $vehid . "'");
                        $vnum = $vehiPhors->num_rows;

                        for ($x = 0; $x < $vnum; $x++) {

                            $vimg = $vehiPhors->fetch_assoc();
                        ?>

                            <div class="photo-block">
                                <img class="photo" src="images/vehicles/gallary/<?php echo $vimg["img"] ?>" alt="">
                                <div class="photo-title"></div>
                            </div>

                        <?php
                        }
                        ?>




                        <!-- <div class="photo-block">
                            <img class="photo" src="images/vehicle profile/c12.jpg" alt="">
                            <div class="photo-title"></div>
                        </div>
                        <div class="photo-block">
                            <img class="photo" src="images/vehicle profile/c13.jpg" alt="">
                            <div class="photo-title"></div>
                        </div> -->
                    </div>
                </div>
            </div>




            <!-- Booking -->


            <div class="booking-area">
                <div class="page-title">Booking Section</div>
                <div class="booking-section-container">
                    <div class="booking-container">

                        <?php

                        if (!isset($_SESSION["user_email"])) {

                        ?>

                            <div class="blocker">
                                <h4>Your'e Not Signed in</h4>
                                <button onclick="blockbutton()" class="blocker-button">sign in</button>
                            </div>
                            <h3 class="booking-area-tag">Booking Area</h3>
                            <span class="full-name">Full Name &nbsp; :<span></span><span></span></span>
                            <span class="E-mail">E-mail &nbsp; &nbsp; &nbsp; &nbsp; : </span>
                            <span class="fill-tag">Enter Your Number</span>
                            <div class="number-change">
                                <input id="number" type="text" placeholder="Phone Number">
                                <!-- <button class="change-button">change</button> -->
                            </div>
                            <span class="fill-tag">Your Booking Date</span>
                            <input type="date" placeholder="Wedding Date" id="weddingDate">



                            <button class="book-button">Book Now</button>

                            <?php


                        } else {

                            $Hresult = Database::search("SELECT * FROM `vehical_booking` WHERE `user_email` = '" . $_SESSION["user_email"] . "' AND `order_status` = 'confirmed' AND `pay_id` = '2' ORDER BY `id` DESC LIMIT 1");
                            $nrow = $Hresult->num_rows;
                            if ($nrow == "1") {
                                $data = $Hresult->fetch_assoc();
                                $Prepakage = Database::search("SELECT * FROM `vehicles_details` WHERE `id` = '" . $data["vehical_detils_id"] . "'");
                                $pn = $Prepakage->num_rows;
                                if ($pn == "1") {
                                    $PrepacData = $Prepakage->fetch_assoc();

                                    $Prepaying =  "4000";
                                    $cid = "3";

                            ?>
                                    <div class="blocker">
                                        <h3>Please complete the previous payment </h3>
                                        <h4>OR</h4>
                                        <h4 style="text-align: center;">go to your <span onclick="gobookhis();" style="color: blue; cursor: pointer;"><u>booking history</u></span> and cancel the booking,</h4>
                                        <button onclick="paybutton('<?php echo $Prepaying ?>','<?php echo $cid ?>')" class="blocker-button ">pay</button>
                                    </div>

                                    <h3 class="booking-area-tag">Booking Area</h3>
                                    <span class="full-name">Full Name &nbsp; :<span></span><span></span></span>
                                    <span class="E-mail">E-mail &nbsp; &nbsp; &nbsp; &nbsp; : </span>
                                    <span class="fill-tag">Enter Your Number</span>
                                    <div class="number-change">
                                        <input id="number" type="text" placeholder="Phone Number">
                                        <!-- <button class="change-button">change</button> -->
                                    </div>
                                    <span class="fill-tag">Your Booking Date</span>
                                    <input type="date" placeholder="Wedding Date" id="weddingDate">



                                    <button class="book-button">Book Now</button>

                                <?php
                                }
                            } else {
                                ?>


                                <h3 class="booking-area-tag">Booking Area</h3>
                                <span class="full-name">Full Name &nbsp; : <span><?php echo $_SESSION["user_fname"] . " " . $_SESSION["user_lname"] ?></span></span>
                                <span class="E-mail">E-mail &nbsp; &nbsp; &nbsp; &nbsp; : <?php echo $_SESSION["user_email"] ?></span>
                                <span class="fill-tag clk">Enter Your Number</span>
                                <div class="number-change clk">
                                    <input id="number" type="text" placeholder="Phone Number">
                                    <!-- <button class="change-button">change</button> -->
                                </div>
                                <span class="fill-tag">Your Booking Date</span>
                                <input type="date" placeholder="Wedding Date" id="weddingDate">


                                <span class="fill-tag">Booking days</span>
                                <input id="extraday" type="number" placeholder="Phone Number" min="1" value="1">

                                <!-- <div class="noteDiv"> -->
                                <!-- <span class="fill-tag">Amount paying(Rs:)</span>
                                <input type="text" class="payinput" id="pay"> -->
                                <span style="font-size: 11px;" class="note"><b>Note : </b> A minimum of <b>Rs : 1000.00 </b> will be charged for the vehicle.</span>
                                <!-- </div> -->

                                <button onclick="bookNow('<?php echo $vehid ?>','<?php echo $_SESSION['user_email'] ?>');" class="book-button clk">Book Now</button>


                        <?php
                            }
                        }

                        ?>

                    </div>


                    <div class="booked-days-container">
                        <h3 class="booked-days-table-tag">Booked Days</h3>
                        <div class="month-container"><!-- <span class="left-arrow">&lt;</span> --><!-- <span class="right-arrow">&gt;</span>--></div>

                        <div class="calander-body">
                            <div id="calendarContainer"></div>
                            <div id="myDiv" class="eventscroll">
                                <div id="organizerContainer"></div>
                            </div>
                        </div>

                    </div>



                </div>

            </div>


            <!-- customer page -->

            <!-- Alert -->
            <div id="custom-dialog" style="display: none;">
                <div id="customAlert" style="text-align: center;" class="message ">Do you want to continue?</div>
                <div class="buttons">
                    <button id="custom-no">No</button>
                    <button id="custom-yes">Yes</button>
                </div>
            </div>
            <!-- Alert -->

            <div class="review-page">
                <img src="images/backdrop-3.jpg" alt="" class="backdrop">
                <img src="images/backdrop-3.jpg" alt="" class="backdrop">
                <h1 class="page-title">customer's review</h1>
                <div class="box-container">

                    <?php

                    $result = Database::search("SELECT * FROM `feedback` WHERE `booking_table_id` = '3' AND `bok_id` = '" . $vehid . "' AND `status` = '0'");
                    $result_num = $result->num_rows;
                    if ($result_num >= 1) {
                        for ($i = 0; $i < $result_num; $i++) {
                            $feedData = $result->fetch_assoc();

                            // $bokcheckrs = Database::search("SELECT * FROM `packages` WHERE `id` IN (SELECT `packag_id` FROM `hotel_booking` WHERE `id` = '" . $feedData["bok_id"] . "') ");
                            // $Bokresult_num = $bokcheckrs->num_rows;

                            // if ($Bokresult_num >= 1) {

                            //     for ($i = 0; $i < $Bokresult_num; $i++) {
                            //         $ChexkBokData = $bokcheckrs->fetch_assoc();

                            $user_rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $feedData["user_email"] . "' ");
                            $user_data = $user_rs->fetch_assoc();
                    ?>

                            <div class="box" id="removefeedback<?php echo $feedData["id"] ?>">
                                <img src="images/review/quote-img.png" alt="" class="quote" />
                                <?php
                                if (isset($_SESSION["user_email"])) {
                                    if ($_SESSION["user_email"] == $feedData["user_email"]) {
                                ?>

                                        <i onclick="removefeedback('<?php echo $feedData['id'] ?>')" class="fa-regular fa-circle-xmark upload-gal-img-close"></i>


                                    <?php
                                    }
                                }
                                $profileImg = Database::search("SELECT * FROM `feedback_img` WHERE `feedback_user`= '" . $feedData["user_email"] . "' ");
                                $pn = $profileImg->num_rows;
                                if ($pn == 1) {
                                    $p = $profileImg->fetch_assoc();
                                    ?>
                                    <img class="user" src="images/review/<?php echo $p["image"] ?>" />
                                <?php

                                } else {
                                ?>

                                    <img src="images/review/profile.jpeg" alt="" class="user" />


                                <?php
                                }
                                ?>
                                <h3><?php echo $user_data["fname"] . " " . $user_data["lname"] ?></h3>
                                <div class="stars">
                                    <!-- <i class="fas fa-star"></i> -->

                                    <?php

                                    for ($m = 1; $m < 6; $m++) {
                                        if ($m <= $feedData["star"]) {
                                    ?>
                                            <i class="fas fa-star"></i>
                                        <?php
                                        } else {
                                        ?>
                                            <i class="fas fa-star" style="color: gray;"></i>
                                    <?php
                                        }
                                    }

                                    ?>

                                </div>
                                <p>
                                    <?php echo $feedData["feed"] ?>
                                </p>
                                <p style="text-align: end; padding: 0px;"><b><?php echo $feedData["date"] ?></b></p>
                            </div>

                            <?php
                            // }
                            // } else {
                            ?>
                            <!-- <div class="col-12 text-center pt-4">
                                    <span class="fs-3">No FeedBacks</span>
                                </div> -->
                        <?php
                            // }
                        }
                    } else {
                        ?>
                        <div class="col-12 text-center pt-4">
                            <span class="fs-3">No FeedBacks</span>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>

            <!-- contact page -->
            <div class="contact-page">
                <div class="page-title">Contact Us</div>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                    <a href="#" class="fab fa-pinterest"></a>
                </div>

            </div>
            <!-- <footer class="footer">
                <div class="header-left">
                </div>
                <nav class="header-mid" style=" justify-content: center;">
                    Partnerships
                </nav>
                <div class="header-right">
                </div>
            </footer> -->
        </div>

        <script src="js/calendarorganizer.js"></script>
        <script src="js/vehical-profile.js"></script>
        <script src="js/package-view.js"></script>
        <script src="js/gallery.js"></script>
        <script src="js/common.js"></script>

    </body>

    </html>

<?php
} else {

    echo "error";
}

?>