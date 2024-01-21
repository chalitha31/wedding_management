<?php

// require "connection.php";
require "header.php";

if (isset($_GET['pid'])) {
    $packageid = $_GET['pid'];


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Photographer Package View</title>
        <link rel="icon" href="images/LogoW.png" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.rawgit.com/nizarmah/calendar-javascript-lib/master/calendarorganizer.min.css">
        <link rel="stylesheet" href="css/calendar.css">
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/photography-package-view.css">
    </head>

    <body onload="photoDate('<?php echo $packageid ?>');">
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

        <div class="package-view-page">
            <img src="images/ab4.png" alt="" class="backdrop">
            <img src="images/ab4.png" alt="" class="backdrop">

            <?php
            $pakage = Database::search("SELECT * FROM `photography_package` WHERE `id` = '" . $packageid . "'");
            $n = $pakage->num_rows;
            $pacData = $pakage->fetch_assoc();
            ?>


            <div class="page-title"><?php echo $pacData["package_type"] ?> Package</div>

            <div class="package-area">
                <div class="package-container">
                    <div class="package-img-holder">
                        <img src="images/photographers/package_img/<?php echo $pacData["preview_image"] ?>" alt="" class="package-img">
                    </div>
                    <div class="package-description">
                        <h3>Features</h3>
                        <ul class="package-features-box">
                            <?php

                            $resultset = Database::search("SELECT * FROM `photography_package_features` WHERE `package_id` = '" . $packageid . "'  ");
                            $norows = $resultset->num_rows;

                            for ($y = 0; $y < $norows; $y++) {
                                $features = $resultset->fetch_assoc();

                            ?>

                                <li><?php echo $features["title"] ?></li>

                            <?php

                            }

                            ?>

                        </ul>
                    </div>
                    <div class="package-price">Price : <span><?php echo $pacData["price"] ?></span></div>
                </div>
            </div>


            <div class="booking-area">
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
                        <span class="fill-tag">Your Wedding Date</span>
                        <input type="date" placeholder="Wedding Date" id="weddingDate">

                        <p class="time-tag clasher">Select Function Time</p>

                        <div class="radio-container ">
                            <div class="radio-item clasher">
                                <input type="radio" id="day" name="event-time" value="HTML">
                                <label for="day">Day</label>
                            </div>
                            <div class="radio-item clasher">
                                <input type="radio" id="night" name="event-time" value="HTML">
                                <label for="night">Night</label>
                            </div>
                        </div>
                        <button class="book-button">Book Now</button>


                        <?php


                    } else {

                        $paying =  ($pacData["price"] / 100) * 10;
                        $Hresult = Database::search("SELECT * FROM `photography_booking` WHERE `user_email` = '" . $_SESSION["user_email"] . "' AND `order_status` = 'confirmed' AND `pay_id` = '2' ORDER BY `id` DESC LIMIT 1");
                        $nrow = $Hresult->num_rows;
                        if ($nrow == "1") {
                            $data = $Hresult->fetch_assoc();
                            $Prepakage = Database::search("SELECT * FROM `photography_package` WHERE `id` = '" . $data["packag_id"] . "'");
                            $pn = $Prepakage->num_rows;
                            if ($pn == "1") {
                                $PrepacData = $Prepakage->fetch_assoc();

                                $Prepaying =  ($PrepacData["price"] / 100) * 10;
                                $cid = "2";

                        ?>
                                <div class="blocker">
                                    <h3 style="color: black;">Please complete the previous payment </h3>
                                    <h4 style="color: black;">OR</h4>
                                    <h4 style="text-align: center; color: black;">go to your <span onclick="gobookhis();" style="color: blue; cursor: pointer;"><u>booking history</u></span> and cancel the booking,</h4>
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
                                <span class="fill-tag">Your Wedding Date</span>
                                <input type="date" placeholder="Wedding Date" id="weddingDate">

                                <p class="time-tag">Select Function Time</p>

                                <div class="radio-container">
                                    <div class="radio-item">
                                        <input type="radio" id="day" name="event-time" value="HTML">
                                        <label for="day">Day</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" id="night" name="event-time" value="HTML">
                                        <label for="night">Night</label>
                                    </div>
                                </div>
                                <button class="book-button">Book Now</button>

                            <?php
                            }
                        } else {
                            ?>

                            <h3 class="booking-area-tag">Booking Area</h3>
                            <span class="full-name">Full Name &nbsp; : <span><?php echo $_SESSION["user_fname"] . " " . $_SESSION["user_lname"] ?></span></span>
                            <span class="E-mail">E-mail &nbsp; &nbsp; &nbsp; &nbsp; : <?php echo $_SESSION["user_email"] ?></span>
                            <span class="fill-tag">Enter Your Number</span>
                            <div class="number-change">
                                <input id="number" type="text" placeholder="Phone Number">
                                <!-- <button class="change-button">change</button> -->
                            </div>
                            <span class="fill-tag">Your Booking Date</span>
                            <input type="date" placeholder="Wedding Date" id="weddingDate">

                            <p class="time-tag pop">Select Function Time</p>

                            <div class="radio-container">
                                <div class="radio-item pop">
                                    <input type="radio" id="day" name="event-time" value="HTML">
                                    <label for="day">Day</label>
                                </div>
                                <div class="radio-item pop">
                                    <input type="radio" id="night" name="event-time" value="HTML">
                                    <label for="night">Night</label>
                                </div>
                            </div>

                            <div class="noteDiv">
                                <span class="fill-tag">Amount paying(Rs:)</span>
                                <input type="text" class="payinput" id="pay">
                                <span style="color: white;" class="note"><b>Note : </b> Pay more than 10% of the amount due.<b> (minimum Rs : <?php echo $paying ?>) </b> </span>
                            </div>
                            <button class="book-button" onclick="photobookNow('<?php echo $packageid ?>','<?php echo $_SESSION['user_email'] ?>','<?php echo $pacData['price'] ?>');">Book Now</button>

                    <?php
                        }
                    }

                    ?>


                </div>


                <div class="booked-days-container clk">
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
        <footer class="footer">
            <div class="header-left">
            </div>
            <nav class="header-mid" style=" justify-content: center;">
                Partnerships
            </nav>
            <div class="header-right">
            </div>
        </footer>

        <script src="js/calendarorganizer.js"></script>
        <script src="js/package-view.js"></script>
        <script src="js/photography-package-view.js"></script>
        <script src="js/common.js"></script>
    </body>

    </html>


<?php

} else {
    echo "error";
}

?>