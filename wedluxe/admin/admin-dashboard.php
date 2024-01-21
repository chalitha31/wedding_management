<?php

session_start();
require "connection.php";

if (isset($_SESSION["admin_email"])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="icon" href="../images/LogoW.png" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="admin-css/admin-common.css">
        <link rel="stylesheet" href="admin-css/admin-dashboard.css">
    </head>

    <body>
        <header>
            <img src="../images/logo.jpeg" alt="logo" class="logo" onclick="pageTravel('../home.php')">
            <div class="header-right">
                <div class="seller-name">Admin Panel</div>
                <div onclick="signOut();" class="seller-name" style="font-weight: 800; color: darkred;">Sign Out</div>
            </div>
        </header>



        <div class="sidebar">
            <span onclick="pageTravel('admin-dashboard.php')" class="sidebar-active styl1">Dashboard</span>
            <span onclick="pageTravel('admin-booking.php')" class="styl1">Booking</span>
            <span onclick="pageTravel('admin-profile-manage.php')" class="styl1">Profile Manage</span>
            <span onclick="pageTravel('admin-user-seller.php')" class="styl1">User Seller</span>

            <?php
            if ($_SESSION["admintype"] == "1") {
            ?>
                <span onclick="pageTravel('admin-add-admin.php')" class="styl1">Add Admin</span>

            <?php
            } else {
            ?>

                <span style="cursor: not-allowed;">Add Admin</span>
            <?php
            } ?>

            <i class="fa-solid fa-cloud-arrow-up upload-top-img"></i>
            <i class="fa-solid fa-cloud-arrow-up upload-top-img"></i>
            <i class="fa-solid fa-cloud-arrow-up upload-top-img"></i>
            <i class="fa-solid fa-cloud-arrow-up upload-top-img"></i>
            <i class="fa-solid fa-cloud-arrow-up upload-top-img"></i>
        </div>

        <!-- <div class="admin-container"></div> -->

        <?php

        // $today = date("Y-m-d");
        $d = new DateTime();
        $tz = new DateTimezone("Asia/Colombo");
        $d->setTimezone($tz);
        $today = $d->format("Y-m-d");

        $this_month = date("m");
        $this_year = date("Y");

        $dailCost = 0;
        $monthCost = 0;
        $totalCost = 0;

        $DJrs = Database::search("SELECT * FROM `dj`  WHERE `pay_id` = '1'");
        $dnum = $DJrs->num_rows;

        for ($i = 0; $i < $dnum; $i++) {

            $dj_data =  $DJrs->fetch_assoc();

            $rday = $dj_data["register_date"];

            $split_date = explode(" ", $rday);
            $pdate = $split_date[0];


            if ($pdate == $today) {

                $dailCost = $dailCost + $dj_data["register_payment"];
            }

            $split_result = explode("-", $pdate);

            // print_r($split_result);

            $pyear = $split_result[0];
            $pmonth = $split_result[1];


            if ($pyear == $this_year) {

                if ($pmonth == $this_month) {

                    $monthCost = $monthCost + $dj_data["register_payment"];
                }
            }
            $totalCost = $totalCost + $dj_data["register_payment"];
        }

        $hotelrs = Database::search("SELECT * FROM `hotels`   WHERE `pay_id` = '1'");
        $hnum = $hotelrs->num_rows;

        for ($k = 0; $k < $hnum; $k++) {
            $hotel_data =  $hotelrs->fetch_assoc();

            $rday = $hotel_data["register_date"];

            $split_date = explode(" ", $rday);
            $pdate = $split_date[0];

            // print_r($split_date);
            // echo $pdate;

            if ($pdate == $today) {
                $dailCost = $dailCost + $hotel_data["register_payment"];
            }

            $split_result = explode("-", $pdate);

            $pyear = $split_result[0];
            $pmonth = $split_result[1];

            if ($pyear == $this_year) {

                if ($pmonth == $this_month) {

                    $monthCost = $monthCost + $hotel_data["register_payment"];
                }
            }

            $totalCost = $totalCost + $hotel_data["register_payment"];
        }

        $photogrphyrs = Database::search("SELECT * FROM `photography`   WHERE  `pay_id` = '1'");
        $pnum = $photogrphyrs->num_rows;

        for ($m = 0; $m < $pnum; $m++) {
            $pho_data =  $photogrphyrs->fetch_assoc();

            $rday = $pho_data["register_date"];

            $split_date = explode(" ", $rday);
            $pdate = $split_date[0];

            // print_r($split_date);
            // echo $pdate;

            if ($pdate == $today) {
                $dailCost = $dailCost + $pho_data["register_payment"];
            }

            $split_result = explode("-", $pdate);

            $pyear = $split_result[0];
            $pmonth = $split_result[1];

            if ($pyear == $this_year) {

                if ($pmonth == $this_month) {

                    $monthCost = $monthCost + $pho_data["register_payment"];
                }
            }
            $totalCost = $totalCost + $pho_data["register_payment"];
        }

        $vehirs = Database::search("SELECT * FROM `vehicles`  WHERE `pay_id` = '1'");
        $vnum = $vehirs->num_rows;


        for ($m = 0; $m < $vnum; $m++) {
            $veh_data =  $vehirs->fetch_assoc();

            $rday = $veh_data["register_date"];

            $split_date = explode(" ", $rday);
            $pdate = $split_date[0];

            // print_r($split_date);
            // echo $pdate;

            if ($pdate == $today) {
                $dailCost = $dailCost + $veh_data["register_payment"];
            }

            $split_result = explode("-", $pdate);

            $pyear = $split_result[0];
            $pmonth = $split_result[1];

            if ($pyear == $this_year) {

                if ($pmonth == $this_month) {

                    $monthCost = $monthCost + $veh_data["register_payment"];
                }
            }
            $totalCost = $totalCost + $veh_data["register_payment"];
        }


        // booking

        $bookingPaymnetRs = Database::search("SELECT * FROM `booking_payment`");
        $bokkingNum = $bookingPaymnetRs->num_rows;
        if ($bokkingNum > 0) {
            for ($t = 0; $t < $bokkingNum; $t++) {

                $bokkingpayData = $bookingPaymnetRs->fetch_assoc();

                if ($bokkingpayData["total"] > "0") {

                    $Prepaying =  ($bokkingpayData["total"] / 100) * 10;

                    $rday = $bokkingpayData["date"];

                    $split_date = explode(" ", $rday);
                    $pdate = $split_date[0];

                    // print_r($split_date);
                    // echo $pdate;

                    if ($pdate == $today) {
                        $dailCost = $dailCost + $Prepaying;
                    }

                    $split_result = explode("-", $pdate);

                    $pyear = $split_result[0];
                    $pmonth = $split_result[1];

                    if ($pyear == $this_year) {

                        if ($pmonth == $this_month) {

                            $monthCost = $monthCost + $Prepaying;
                        }
                    }
                    $totalCost = $totalCost + $Prepaying;
                } else {

                    $Prepaying =  "1000";

                    $rday = $bokkingpayData["date"];

                    $split_date = explode(" ", $rday);
                    $pdate = $split_date[0];

                    // print_r($split_date);
                    // echo $pdate;

                    if ($pdate == $today) {
                        $dailCost = $dailCost + $Prepaying;
                    }

                    $split_result = explode("-", $pdate);

                    $pyear = $split_result[0];
                    $pmonth = $split_result[1];

                    if ($pyear == $this_year) {

                        if ($pmonth == $this_month) {

                            $monthCost = $monthCost + $Prepaying;
                        }
                    }
                    $totalCost = $totalCost + $Prepaying;
                }
            }
        }


        // booking

        // $dailCost = 0;
        $dmonthSell = 0;
        $hmonthSell = 0;
        $pmonthSell = 0;
        $vmonthSell = 0;
        $dtotalSell = 0;
        $htotalSell = 0;
        $ptotalSell = 0;
        $vtotalSell = 0;


        $DJBrs = Database::search("SELECT * FROM `dj_booking`");
        $dbnum = $DJBrs->num_rows;

        for ($i = 0; $i < $dbnum; $i++) {
            $dj_data =  $DJBrs->fetch_assoc();

            $rday = $dj_data["order_date"];

            $split_date = explode(" ", $rday);
            $pdate = $split_date[0];


            // if ($pdate == $today) {
            //     $dmonthSell = $dmonthSell + 1;
            // }

            $split_result = explode("-", $pdate);

            // print_r($split_result);

            $pyear = $split_result[0];
            $pmonth = $split_result[1];


            if ($pyear == $this_year) {

                if ($pmonth == $this_month) {

                    $dmonthSell = $dmonthSell + 1;
                }
            }
            $dtotalSell = $dtotalSell + 1;
        }

        $hBotelrs = Database::search("SELECT * FROM `hotel_booking` ");
        $hBnum = $hBotelrs->num_rows;

        for ($k = 0; $k < $hBnum; $k++) {
            $hotel_data =  $hBotelrs->fetch_assoc();

            $rday = $hotel_data["order_date"];

            $split_date = explode(" ", $rday);
            $pdate = $split_date[0];

            // print_r($split_date);
            // echo $pdate;

            // if ($pdate == $today) {
            //     $dailCost = $dailCost + $hotel_data["register_payment"];
            // }

            $split_result = explode("-", $pdate);

            $pyear = $split_result[0];
            $pmonth = $split_result[1];

            if ($pyear == $this_year) {

                if ($pmonth == $this_month) {

                    $hmonthSell = $hmonthSell + 1;
                }
            }

            $htotalSell = $htotalSell + 1;
        }

        $pBhotogrphyrs = Database::search("SELECT * FROM `photography_booking` ");
        $pBnum = $pBhotogrphyrs->num_rows;

        for ($m = 0; $m < $pBnum; $m++) {
            $pho_data =  $pBhotogrphyrs->fetch_assoc();

            $rday = $pho_data["order_date"];

            $split_date = explode(" ", $rday);
            $pdate = $split_date[0];

            // print_r($split_date);
            // echo $pdate;

            // if ($pdate == $today) {
            //     $dailCost = $dailCost + $pho_data["register_payment"];
            // }

            $split_result = explode("-", $pdate);

            $pyear = $split_result[0];
            $pmonth = $split_result[1];

            if ($pyear == $this_year) {

                if ($pmonth == $this_month) {

                    $pmonthSell = $pmonthSell + 1;
                }
            }
            $ptotalSell = $ptotalSell + 1;
        }

        $vBehirs = Database::search("SELECT * FROM `vehical_booking`  ");
        $vBnum = $vBehirs->num_rows;


        for ($m = 0; $m < $vBnum; $m++) {
            $veh_data =  $vBehirs->fetch_assoc();

            $rday = $veh_data["order_date"];

            $split_date = explode(" ", $rday);
            $pdate = $split_date[0];

            // print_r($split_date);
            // echo $pdate;

            // if ($pdate == $today) {
            //     $dailCost = $dailCost + $veh_data["register_payment"];
            // }

            $split_result = explode("-", $pdate);

            $pyear = $split_result[0];
            $pmonth = $split_result[1];

            if ($pyear == $this_year) {

                if ($pmonth == $this_month) {

                    $vmonthSell = $vmonthSell + 1;
                }
            }
            $vtotalSell = $vtotalSell + 1;
        }


        ?>





        <div class="admin-container">
            <div class="time-container">
                <span style="display: flex; justify-content: end; width: 97%;" class="" id="current-datetime"> </span>
            </div>
            <div class="page-title">Dashboard</div>

            <div class="dash-block-container">

                <div class="dash-block">
                    <h2>Daily Earnings</h2>
                    <h4>Rs : <span><?php echo $dailCost;
                                    if (!preg_match('/^\d+\.\d+$/', $dailCost)) {
                                        echo ".00";
                                    } ?></span></h4>
                </div>
                <div class="dash-block">
                    <h2>Monthly Earnings</h2>
                    <h4>Rs : <span><?php echo $monthCost;
                                    if (!preg_match('/^\d+\.\d+$/', $monthCost)) {
                                        echo ".00";
                                    } ?></span></h4>
                </div>
                <div class="dash-block">
                    <h2>Total Earnings</h2>
                    <h4>Rs : <span><?php echo $totalCost;
                                    if (!preg_match('/^\d+\.\d+$/', $totalCost)) {
                                        echo ".00";
                                    } ?></span></h4>
                </div>
                <div class="dash-block">
                    <h2>Monthly Sellings</h2>
                    <div class="" style="display: flex; column-gap: 23px;">
                        <div class="" style="display: grid; column-gap: 20px;">
                            <span><b>Dj&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b><span><b><?php echo $dmonthSell ?></b></span></span>
                            <span><b>Hotels :</b> <span><b><?php echo $hmonthSell ?></b></span></span>
                        </div>

                        <div class="" style="display: grid; column-gap: 20px;">
                            <span><b>Vehicles&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </b> <span><b><?php echo $vmonthSell ?></b></span></span>
                            <span><b>Photography :</b> <span><b><?php echo $pmonthSell ?></b></span></span>
                        </div>
                    </div>
                </div>
                <div class="dash-block">
                    <h2>Total Sellings</h2>
                    <div class="" style="display: flex; column-gap: 23px;">
                        <div class="" style="display: grid; column-gap: 20px;">
                            <span><b>Dj&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b><span><b><?php echo $dtotalSell ?></b></span></span>
                            <span><b>Hotels :</b> <span><b><?php echo $htotalSell ?></b></span></span>
                        </div>

                        <div class="" style="display: grid; column-gap: 20px;">
                            <span><b>Vehicles&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </b> <span><b><?php echo $vtotalSell ?></b></span></span>
                            <span><b>Photography :</b> <span><b><?php echo $ptotalSell ?></b></span></span>
                        </div>
                    </div>
                </div>
                <div class="dash-block">
                    <h2>Total Engagement</h2>
                    <div class="" style="display: flex; column-gap: 23px;">
                        <div class="" style="display: grid; column-gap: 20px;">
                            <span><b>Dj&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b><span><b><?php echo $dnum ?></b></span></span>
                            <span><b>Hotels :</b> <span><b><?php echo $hnum ?></b></span></span>
                        </div>

                        <div class="" style="display: grid; column-gap: 20px;">
                            <span><b>Vehicles&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </b> <span><b><?php echo $vnum ?></b></span></span>
                            <span><b>Photography :</b> <span><b><?php echo $pnum ?></b></span></span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="time-container">
                <!-- <div class="total-time">Total Active Time </div>
        <span id="current-time">
        </span> -->
            </div>

            <h3>Most Popular Profiles</h3>

            <div class="top-profile-container">

                <?php

                $hotelbookingrs = Database::search("SELECT packag_id, COUNT(* ) AS pac FROM hotel_booking GROUP BY packag_id ORDER BY pac DESC LIMIT 1");
                $mhpnro = $hotelbookingrs->num_rows;
                if ($mhpnro > 0) {
                    $mosthpac = $hotelbookingrs->fetch_assoc();


                    $mhjrs = Database::search("SELECT * FROM `packages` INNER JOIN `hotels` ON `packages`.`hotel_id` = `hotels`.`id` INNER JOIN `hotel_img_logo` ON `hotels`.`id` = `hotel_img_logo`.`hotel_id` WHERE `packages`.`id` = '" . $mosthpac["packag_id"] . "'");
                    $mhnro = $mhjrs->num_rows;
                    if ($mhnro > 0) {
                        $mosthodata = $mhjrs->fetch_assoc();
                ?>
                        <div class="profile-block">
                            <div class="profile-image-holder">
                                <img src="../images/hotels/<?php echo $mosthodata["image"] ?>" alt="" class="profile-image">
                            </div>
                            <div class="category-name">Hotel</div>
                            <div class="profile-name"><?php echo $mosthodata["name"] ?></div>
                        </div>
                    <?php
                    }
                }

                $mostdpacrs = Database::search("SELECT packag_id, COUNT(* ) AS pac FROM dj_booking GROUP BY packag_id ORDER BY pac DESC LIMIT 1");
                $mdpnro = $mostdpacrs->num_rows;
                if ($mdpnro > 0) {
                    $mostdjpac = $mostdpacrs->fetch_assoc();


                    $mdjrs = Database::search("SELECT * FROM `dj_package` INNER JOIN `dj` ON `dj_package`.`dj_id` = `dj`.`id` INNER JOIN `dj_img_logo` ON `dj`.`id` = `dj_img_logo`.`dj_id` WHERE `dj_package`.`id` = '" . $mostdjpac["packag_id"] . "'");
                    $mdnro = $mdjrs->num_rows;
                    if ($mdnro > 0) {
                        $mostdjdata = $mdjrs->fetch_assoc();
                    ?>
                        <div class="profile-block">
                            <div class="profile-image-holder">
                                <img src="../images/dj/<?php echo $mostdjdata["image"] ?>" alt="" class="profile-image">
                            </div>
                            <div class="category-name">Dj</div>
                            <div class="profile-name"><?php echo $mostdjdata["name"] ?></div>
                        </div>
                    <?php
                    }
                }

                $mostppacrs = Database::search("SELECT packag_id, COUNT(* ) AS pac FROM photography_booking GROUP BY packag_id ORDER BY pac DESC LIMIT 1");
                $mppnro = $mostppacrs->num_rows;
                if ($mppnro > 0) {
                    $mostppac = $mostppacrs->fetch_assoc();


                    $mprs = Database::search("SELECT * FROM `photography_package` INNER JOIN `photography` ON `photography_package`.`photography_id` = `photography`.`id` INNER JOIN `photography__img_logo` ON `photography`.`id` = `photography__img_logo`.`photography_id` WHERE `photography_package`.`id` = '" . $mostppac["packag_id"] . "'");
                    $mpnro = $mprs->num_rows;
                    if ($mpnro > 0) {
                        $mostpdata = $mprs->fetch_assoc();
                    ?>
                        <div class="profile-block">
                            <div class="profile-image-holder">
                                <img src="../images/photographers/<?php echo $mostpdata["image"] ?>" alt="" class="profile-image">
                            </div>
                            <div class="category-name">Photography</div>
                            <div class="profile-name"><?php echo $mostpdata["name"] ?></div>
                        </div>
                    <?php
                    }
                }


                $mostdvacrs = Database::search("SELECT vehical_detils_id, COUNT(* ) AS pac FROM vehical_booking GROUP BY vehical_detils_id ORDER BY pac DESC LIMIT 1");
                $mdvnro = $mostdvacrs->num_rows;
                if ($mdvnro > 0) {
                    $mostvpac = $mostdvacrs->fetch_assoc();


                    $mvrs = Database::search("SELECT * FROM `vehicles_details` INNER JOIN `vehicles_img` ON `vehicles_details`.`id` = `vehicles_img`.`vehical_de_id`  WHERE `vehicles_details`.`id` = '" . $mostvpac["vehical_detils_id"] . "'");
                    $mvnro = $mvrs->num_rows;
                    if ($mvnro > 0) {
                        $mostvdata = $mvrs->fetch_assoc();
                    ?>

                        <div class="profile-block">
                            <div class="profile-image-holder">
                                <img src="../images/vehicles/gallary/<?php echo $mostvdata["img"] ?>" alt="" class="profile-image">
                            </div>
                            <div class="category-name">Vehicle</div>
                            <div class="profile-name"><?php echo $mostvdata["name"] ?></div>
                        </div>
                <?php
                    }
                }
                ?>


            </div>



        </div>


        <script src="admin-js/admin-common.js"></script>
        <script src="admin-js/time.js"></script>
    </body>

    </html>

<?php
} else {
    echo "Please Sign In as A Admin";
}

?>