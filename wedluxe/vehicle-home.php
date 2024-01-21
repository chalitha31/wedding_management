<?php

// require "connection.php";
require "header.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles</title>
    <link rel="icon" href="images/LogoW.png" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/vehicle-home.css">
</head>

<body>
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

    <div class="vehicle-home-container">
        <img src="images/ab5.png" alt="" class="ab1">
        <div class="page-title">Vehicles</div>

        <div class="search-block">
            <input type="search" class="search-bar" placeholder="search by vehicle name" id="hotel_search_txt">
            <img src="images/magnifying-glass.png" alt="" class="search-icon" onclick="VehibasicSearch(0);">
        </div>

        <div class="vehicles-container" id="VehiclSearchResult">

            <?php

            $vehirs = Database::search("SELECT `vehicles_details`.`id`,`vehicles_details`.`model`,`vehicles_details`.`name`,`vehicles`.`company_name`,`vehicles_img_logo`.`image` FROM `vehicles` INNER JOIN `vehicles_details` ON `vehicles`.`id` = `vehicles_details`.`company_id`   INNER JOIN  `vehicles_img_logo` ON `vehicles_details`.`id` = `vehicles_img_logo`.`vehical_details_id`  WHERE `vehicles_details`.`status` = '0' AND `vehicles`.`pay_id` = '1'");
            $hnum = $vehirs->num_rows;

            for ($x = 0; $x < $hnum; $x++) {
                $VehicalData = $vehirs->fetch_assoc();
            ?>


                <div class="vehicle-item-block" onclick="vehicalDetails(<?php echo $VehicalData['id'] ?>)">

                    <?php
                    $VmainImgrs = Database::search("SELECT * FROM `vehicles_img` WHERE `vehical_de_id`='" . $VehicalData['id'] . "'");
                    $vmainImg = $VmainImgrs->fetch_assoc();
                    ?>
                    <div class="vehicle-item-image-holder">
                        <img class="vehicle-item-image" src="images/vehicles/gallary/<?php echo $vmainImg["img"] ?>" alt="">
                    </div>
                    <h3 class="vehicle-name"><?php echo $VehicalData["name"] . "-" . $VehicalData["model"] ?></h3>
                    <div class="vehicle-company"><i></i><?php echo $VehicalData["company_name"] ?></div>
                </div>

            <?php
            }
            ?>


            <!-- <div class="vehicle-item-block">
                <div class="vehicle-item-image-holder">
                    <img class="vehicle-item-image" src="images/vehicles/v2.png" alt="">
                </div>
                <h3 class="vehicle-name">Car Name</h3>
                <div class="vehicle-company"><i></i>company name</div>
            </div>
            <div class="vehicle-item-block">
                <div class="vehicle-item-image-holder">
                    <img class="vehicle-item-image" src="images/vehicles/v3.jpg" alt="">
                </div>
                <h3 class="vehicle-name">Car Name</h3>
                <div class="vehicle-company"><i></i>company name</div>
            </div>
            <div class="vehicle-item-block">
                <div class="vehicle-item-image-holder">
                    <img class="vehicle-item-image" src="images/vehicles/v4.webp" alt="">
                </div>
                <h3 class="vehicle-name">Car Name</h3>
                <div class="vehicle-company"><i></i>company name</div>
            </div>
            <div class="vehicle-item-block">
                <div class="vehicle-item-image-holder">
                    <img class="vehicle-item-image" src="images/vehicles/v5.jpg" alt="">
                </div>
                <h3 class="vehicle-name">Car Name</h3>
                <div class="vehicle-company"><i></i>company name</div>
            </div>
            <div class="vehicle-item-block">
                <div class="vehicle-item-image-holder">
                    <img class="vehicle-item-image" src="images/vehicles/v6.jpeg" alt="">
                </div>
                <h3 class="vehicle-name">Car Name</h3>
                <div class="vehicle-company"><i></i>company name</div>
            </div> -->


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

    <?php
    require_once "footer.php";

    ?>
    <script src="js/common.js"></script>
    <script src="js/vehicle-home.js"></script>
</body>

</html>