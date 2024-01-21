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
    <title>hotels</title>
    <link rel="icon" href="images/LogoW.png" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/hotel-home.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>


    <div class="hotel-home-container">
        <img src="images/ab5.png" alt="" class="ab1">
        <div class="page-title">Hotels</div>

        <div class="search-block">
            <input type="search" class="search-bar" id="hotel_search_txt" placeholder="search by hotel name">
            <img src="images/magnifying-glass.png" alt="" class="search-icon" onclick="basicSearch(0);">
        </div>



        <div class="hotels-container" id="HotelSearchResult">

            <?php

            $hotelrs = Database::search("SELECT `hotels`.`id`,`hotels`.`name`,`hotels`.`districts_id`,`hotel_img_logo`.`image` FROM `hotels` INNER JOIN `hotel_img_logo` ON `hotels`.`id` = `hotel_img_logo`.`hotel_id`  WHERE `hotels`.`status` = '0' AND `hotels`.`pay_id` = '1'");
            $hnum = $hotelrs->num_rows;

            for ($x = 0; $x < $hnum; $x++) {
                $hotelData = $hotelrs->fetch_assoc();
            ?>

                <div class="hotel-item-block" onclick="hotelDetails(<?php echo $hotelData['id'] ?>)">
                    <div class="hotel-item-image-holder">
                        <img class="hotel-item-image" src="images/hotels/<?php echo $hotelData["image"] ?>" alt="">
                    </div>


                    <h3 class="hotel-name"><?php echo $hotelData["name"] ?></h3>

                    <?php

                    $disrs = Database::search("SELECT * FROM `district` WHERE `id` = '" . $hotelData["districts_id"] . "' ");

                    $disData = $disrs->fetch_array();

                    ?>

                    <div class="hotel-location"><i><img src="images/location-pin.png" alt=""></i><?php echo $disData["name"] ?></div>
                </div>


            <?php
            }
            ?>





            <!-- design  -->


            <!-- <div class="hotel-item-block">
                <div class="hotel-item-image-holder">
                    <img class="hotel-item-image" src="images/hotels/hotel2.jpg" alt="">
                </div>
                <h3 class="hotel-name">Hotel</h3>
                <div class="hotel-location"><i><img src="images/location-pin.png" alt=""></i>hotel address

                </div>
            </div>
            <div class="hotel-item-block">
                <div class="hotel-item-image-holder">
                    <img class="hotel-item-image" src="images/hotels/hotel3.jpg" alt="">
                </div>
                <h3 class="hotel-name">Hotel</h3>
                <div class="hotel-location"><i><img src="images/location-pin.png" alt=""></i>hotel address

                </div>
            </div>
            <div class="hotel-item-block">
                <div class="hotel-item-image-holder">
                    <img class="hotel-item-image" src="images/hotels/hotel4.jpg" alt="">
                </div>
                <h3 class="hotel-name">Hotel</h3>
                <div class="hotel-location"><i><img src="images/location-pin.png" alt=""></i>hotel address

                </div>
            </div>
            <div class="hotel-item-block">
                <div class="hotel-item-image-holder">
                    <img class="hotel-item-image" src="images/hotels/hotel5.jpg" alt="">
                </div>
                <h3 class="hotel-name">Hotel</h3>
                <div class="hotel-location"><i><img src="images/location-pin.png" alt=""></i>hotel address

                </div>
            </div>
            <div class="hotel-item-block">
                <div class="hotel-item-image-holder">
                    <img class="hotel-item-image" src="images/hotels/hotel6.jpg" alt="">
                </div>
                <h3 class="hotel-name">Hotel</h3>
                <div class="hotel-location"><i><img src="images/location-pin.png" alt=""></i>hotel address

                </div>
            </div>
            <div class="hotel-item-block">
                <div class="hotel-item-image-holder">
                    <img class="hotel-item-image" src="images/hotels/hotel7.jpg" alt="">
                </div>
                <h3 class="hotel-name">Hotel</h3>
                <div class="hotel-location"><i><img src="images/location-pin.png" alt=""></i>hotel address

                </div>
            </div>
            <div class="hotel-item-block">
                <div class="hotel-item-image-holder">
                    <img class="hotel-item-image" src="images/hotels/hotel8.jpg" alt="">
                </div>
                <h3 class="hotel-name">Hotel</h3>
                <div class="hotel-location"><i><img src="images/location-pin.png" alt=""></i>hotel address

                </div>
            </div>
            <div class="hotel-item-block">
                <div class="hotel-item-image-holder">
                    <img class="hotel-item-image" src="images/hotels/hotel9.jpg" alt="">
                </div>
                <h3 class="hotel-name">Hotel</h3>
                <div class="hotel-location"><i><img src="images/location-pin.png" alt=""></i>hotel address

                </div>
            </div>
            <div class="hotel-item-block">
                <div class="hotel-item-image-holder">
                    <img class="hotel-item-image" src="images/hotels/hotel10.jpg" alt="">
                </div>
                <h3 class="hotel-name">Hotel</h3>
                <div class="hotel-location"><i><img src="images/location-pin.png" alt=""></i>hotel address

                </div>
            </div> -->

        </div>
    </div>


    <?php
    require_once "footer.php";

    ?>

    <!-- <footer class="footer">
        <div class="header-left">
        </div>
        <nav class="header-mid" style=" justify-content: center;">
            Partnerships
        </nav>
        <div class="header-right">
        </div>
    </footer> -->
    <script src="js/common.js"></script>
    <script src="js/hotel-home.js"></script>
</body>

</html>