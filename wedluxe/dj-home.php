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
    <title>Dj </title>
    <link rel="icon" href="images/LogoW.png" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/dj-home.css">
    <link rel="stylesheet" href="css/bootstrap.css">
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

    <div class="dj-home-container">
        <img src="images/ab5.png" alt="" class="ab1">
        <div class="page-title">Dj</div>

        <div class="search-block">
            <input type="search" class="search-bar" placeholder="search by vehicle name" id="dj_search_txt">
            <img src="images/magnifying-glass.png" alt="" class="search-icon" onclick="DjbasicSearch(0);">
        </div>

        <div class="djs-container" id="DjSearchResult">

            <?php

            $hotelrs = Database::search("SELECT `dj`.`id`,`dj`.`name`,`dj`.`company_name`,`dj_img_logo`.`image` FROM `dj` INNER JOIN `dj_img_logo` ON `dj`.`id` = `dj_img_logo`.`dj_id` WHERE `dj`.`status` = '0' AND `dj`.`pay_id` = '1'");
            $hnum = $hotelrs->num_rows;

            for ($x = 0; $x < $hnum; $x++) {
                $DjData = $hotelrs->fetch_assoc();
            ?>

                <div class="dj-item-block" onclick="DjDetails(<?php echo $DjData['id'] ?>)">
                    <div class="dj-item-image-holder">
                        <img class="dj-item-image" src="images/dj/<?php echo $DjData["image"] ?>" alt="">
                    </div>
                    <h3 class="dj-name"><?php echo $DjData["name"] ?></h3>
                    <div class="dj-company"><i></i><?php echo $DjData["company_name"] ?></div>
                </div>

            <?php
            }
            ?>



            <!-- <div class="dj-item-block">
                <div class="dj-item-image-holder">
                    <img class="dj-item-image" src="images/dj/d2.jpg" alt="">
                </div>
                <h3 class="dj-name">Artist Name</h3>
                <div class="dj-company"><i></i>company name</div>
            </div>
            <div class="dj-item-block">
                <div class="dj-item-image-holder">
                    <img class="dj-item-image" src="images/dj/d3.jpg" alt="">
                </div>
                <h3 class="dj-name">Artist Name</h3>
                <div class="dj-company"><i></i>company name</div>
            </div>
            <div class="dj-item-block">
                <div class="dj-item-image-holder">
                    <img class="dj-item-image" src="images/dj/d4.jpg" alt="">
                </div>
                <h3 class="dj-name">Artist Name</h3>
                <div class="dj-company"><i></i>company name</div>
            </div>
            <div class="dj-item-block">
                <div class="dj-item-image-holder">
                    <img class="dj-item-image" src="images/dj/d5.jpg" alt="">
                </div>
                <h3 class="dj-name">Artist Name</h3>
                <div class="dj-company"><i></i>company name</div>
            </div>
            <div class="dj-item-block">
                <div class="dj-item-image-holder">
                    <img class="dj-item-image" src="images/dj/d6.jpg" alt="">
                </div>
                <h3 class="dj-name">Artist Name</h3>
                <div class="dj-company"><i></i>company name</div>
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
    <script src="js/dj-home.js"></script>
</body>

</html>