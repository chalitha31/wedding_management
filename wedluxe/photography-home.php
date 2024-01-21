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
    <title>Photography</title>
    <link rel="icon" href="images/LogoW.png" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/photography-home.css">
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

    <div class="photograpy-home-container">
        <img src="images/ab5.png" alt="" class="ab1">
        <div class="page-title">Photography</div>

        <div class="search-block">
            <input type="search" class="search-bar" placeholder="search by photographer name" id="hotel_search_txt">
            <img src="images/magnifying-glass.png" alt="" class="search-icon" onclick="phbasicSearch(0);">
        </div>

        <div class="photograpys-container" id="phSearchResult">

            <?php

            $photogrphyrs = Database::search("SELECT `photography`.`id`,`photography`.`name`,`photography`.`company_name`,`photography__img_logo`.`image` FROM `photography` INNER JOIN `photography__img_logo` ON `photography`.`id` = `photography__img_logo`.`photography_id`  WHERE `photography`.`status` = '0' AND `photography`.`pay_id` = '1'");
            $hnum = $photogrphyrs->num_rows;

            for ($x = 0; $x < $hnum; $x++) {
                $photographyData = $photogrphyrs->fetch_assoc();
            ?>

                <div class="photograpy-item-block" onclick="photographyDetails(<?php echo $photographyData['id'] ?>)">
                    <div class="photograpy-item-image-holder">
                        <img class="photograpy-item-image" src="images/photographers/<?php echo $photographyData["image"] ?>" alt="">
                    </div>
                    <h3 class="photograpy-name"><?php echo $photographyData["name"] ?></h3>
                    <div class="photograpy-company"><i></i><?php echo $photographyData["company_name"] ?></div>
                </div>

            <?php
            }
            ?>

            <!-- <div class="photograpy-item-block">
                <div class="photograpy-item-image-holder">
                    <img class="photograpy-item-image" src="images/photographers/p2.webp" alt="">
                </div>
                <h3 class="photograpy-name">Photographer Name</h3>
                <div class="photograpy-company"><i></i>company name</div>
            </div>
            <div class="photograpy-item-block">
                <div class="photograpy-item-image-holder">
                    <img class="photograpy-item-image" src="images/photographers/p3.webp" alt="">
                </div>
                <h3 class="photograpy-name">Photographer Name</h3>
                <div class="photograpy-company"><i></i>company name</div>
            </div>
            <div class="photograpy-item-block">
                <div class="photograpy-item-image-holder">
                    <img class="photograpy-item-image" src="images/photographers/p4.jpg" alt="">
                </div>
                <h3 class="photograpy-name">Photographer Name</h3>
                <div class="photograpy-company"><i></i>company name</div>
            </div>
            <div class="photograpy-item-block">
                <div class="photograpy-item-image-holder">
                    <img class="photograpy-item-image" src="images/photographers/p5.webp" alt="">
                </div>
                <h3 class="photograpy-name">Photographer Name</h3>
                <div class="photograpy-company"><i></i>company name</div>
            </div>
            <div class="photograpy-item-block">
                <div class="photograpy-item-image-holder">
                    <img class="photograpy-item-image" src="images/photographers/p6.jpg" alt="">
                </div>
                <h3 class="photograpy-name">Photographer Name</h3>
                <div class="photograpy-company"><i></i>company name</div>
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
    <script src="js/photography-home.js"></script>
</body>

</html>