<?php

require "connection.php";
// require "header.php";

if (isset($_GET['id'])) {
    $Hotelid = $_GET['id'];
?>





    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>hotel-profile</title>
        <link rel="icon" href="../images/LogoW.png" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/common.css">
        <link rel="stylesheet" href="../css/hotel-profile.css">
    </head>

    <body>
        <header>
            <img src="../images/logo.jpeg" alt="logo" class="logo" onclick="pageTravel('admin-dashboard.php')">
            <div class="header-right">
                <div class="seller-name">Admin Panel</div>
            </div>
        </header>

        <div class="hotel-profile-container">

            <?php

            $hotelrs = Database::search("SELECT `hotels`.`id`,`hotels`.`name`,`hotels`.`location`,`hotels`.`districts_id`,`hotel_img_logo`.`image`,`hotel_img_logo`.`logo` FROM `hotels` INNER JOIN `hotel_img_logo` ON `hotels`.`id` = `hotel_img_logo`.`hotel_id` WHERE `hotels`.`id`= '" . $Hotelid . "'");
            $hnum = $hotelrs->num_rows;

            $hotelData = $hotelrs->fetch_assoc();

            ?>

            <div class="profile-background-image">
                <img src="../images/hotels/<?php echo $hotelData["image"] ?>" alt="">
                <div class="hotel-major-content">
                    <div class="logo-holder">
                        <img src="../images/hotels/logo/<?php echo $hotelData["logo"] ?>" alt="" class="hotel-logo">
                    </div>
                    <div class="hotel-description">
                        <h1><?php echo $hotelData["name"] ?></h1>
                        <h4>location : <a style="color: aliceblue;" href <?php echo $hotelData["location"] ?>> <?php echo $hotelData["location"] ?></a></h4>
                    </div>
                </div>
            </div>

            <div class="package-page">
                <img src="../images/backdrop-2.png" alt="" class="backdrop">
                <img src="../images/backdrop-2.png" alt="" class="backdrop">
                <div class="page-title">Our Packages</div>
                <div class="package-container">

                    <?php

                    $rs = Database::search("SELECT * FROM `packages` WHERE `hotel_id` = '" . $Hotelid . "'  AND `status` = '0'  ORDER BY  `price` ASC ");
                    $n = $rs->num_rows;

                    for ($x = 0; $x < $n; $x++) {
                        $pac = $rs->fetch_assoc();

                    ?>

                        <div class="package hotel-packages">
                            <div class="package-title "><?php echo $pac["package_type"] ?></div>
                            <div class="package-image-holder">
                                <img src="../images/hotels/package_img/<?php echo $pac["preview_image"] ?>" alt="" class="package-image">
                            </div>
                            <h3>Best Features</h3>
                            <ul>

                                <?php

                                $resultset = Database::search("SELECT * FROM `package_features` WHERE `package_id` = '" . $pac["id"] . "'   ");
                                $norows = $resultset->num_rows;

                                for ($y = 0; $y < $norows; $y++) {
                                    $features = $resultset->fetch_assoc();

                                ?>

                                    <li class="uppercase"><?php echo $features["title"] ?></li>

                                <?php

                                }

                                ?>



                            </ul>
                            <div class="package-price">Price <span>Rs : <?php echo $pac["price"] ?></span></div>
                        </div>

                    <?php

                    }
                    ?>

                    <!-- <div class="package hotel-packages">
                        <div class="package-title platinum">PLATINUM</div>
                        <div class="package-image-holder">
                            <img src="images/package-photo-2.jpg" alt="" class="package-image">
                        </div>
                        <h3>Best Features</h3>
                        <ul>
                            <li>feature 1</li>
                            <li>feature 2</li>
                            <li>feature 3</li>
                            <li>feature 4</li>
                            <li>feature 5</li>
                        </ul>
                        <div class="package-price">Price <span>Rs : 50000</span></div>
                    </div>
                    <div class="package hotel-packages">
                        <div class="package-title gold">GOLD</div>
                        <div class="package-image-holder">
                            <img src="images/package-photo-3.jpg" alt="" class="package-image">
                        </div>
                        <h3>Best Features</h3>
                        <ul>
                            <li>feature 1</li>
                            <li>feature 2</li>
                            <li>feature 3</li>
                            <li>feature 4</li>
                            <li>feature 5</li>
                        </ul>
                        <div class="package-price">Price <span>Rs : 50000</span></div>
                    </div> -->

                </div>
            </div>

            <div class="gallery-page">
                <h3 class="page-title">Gallery</h3>

                <div class="photo-viewer-back">
                    <div class="photo-viewer">
                        <img class="photo-view" src="" alt="" srcset="">
                    </div>
                    <div class="photo-view-title">No Title</div>
                </div>

                <div class="photos-container">

                    <?php

                    $resultset = Database::search("SELECT * FROM `gallary` WHERE `hotel_id` = '" . $Hotelid . "'");
                    $norows = $resultset->num_rows;

                    for ($i = 0; $i < $norows; $i++) {

                        $rowData = $resultset->fetch_assoc();
                    ?>

                        <div class="photo-block">
                            <img class="photo" src="../images/hotels/hotel-gallery/<?php echo $rowData["image"] ?>" alt="">
                            <div class="photo-title"></div>
                        </div>

                    <?php
                    }

                    ?>

                    <!-- <div class="photo-block">
                        <img class="photo" src="images/hotel-gallery/Beach_Club_Models_11.webp" alt="">
                        <div class="photo-title">No Tile 2</div>
                    </div>
                    <div class="photo-block">
                        <img class="photo" src="images/hotel-gallery/Beach_Models_3.webp" alt="">
                        <div class="photo-title">No Tile 2</div>
                    </div>
                    <div class="photo-block">
                        <img class="photo" src="images/hotel-gallery/Main_Pool_4.webp" alt="">
                        <div class="photo-title">No Tile 2</div>
                    </div>
                    <div class="photo-block">
                        <img class="photo" src="images/hotel-gallery/Photo_Aug_19__8_50_50_AM.webp" alt="">
                        <div class="photo-title">No Tile 2</div>
                    </div>
                    <div class="photo-block">
                        <img class="photo" src="images/hotel-gallery/south-beach-retreat-collection-two-bedroom.png" alt="">
                        <div class="photo-title">No Tile 2</div>
                    </div>
                    <div class="photo-block">
                        <img class="photo" src="images/hotel-gallery/southbeach_bewellat1.webp" alt="">
                        <div class="photo-title">No Tile 2</div>
                    </div> -->

                </div>
            </div>

            <!-- customer page -->

            <div class="review-page">
                <img src="../images/backdrop-3.jpg" alt="" class="backdrop">
                <img src="../images/backdrop-3.jpg" alt="" class="backdrop">
                <h1 class="page-title">customer's review</h1>
                <div class="box-container">

                    <?php

                    $result = Database::search("SELECT * FROM `feedback` WHERE `booking_table_id` = '0' AND `bok_id` = '" . $Hotelid . "'");
                    $result_num = $result->num_rows;
                    if ($result_num >= 1) {
                        for ($i = 0; $i < $result_num; $i++) {
                            $feedData = $result->fetch_assoc();

                            // $bokcheckrs = Database::search("SELECT * FROM `packages` WHERE `id` IN (SELECT `packag_id` FROM `hotel_booking` WHERE `id` = '" . $feedData["bok_id"] . "') ");
                            // $Bokresult_num = $bokcheckrs->num_rows;

                            // if ($Bokresult_num >= 1) {

                            // for ($i = 0; $i < $Bokresult_num; $i++) {
                            // $ChexkBokData = $bokcheckrs->fetch_assoc();

                            $user_rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $feedData["user_email"] . "' ");
                            $user_data = $user_rs->fetch_assoc();
                    ?>

                            <div class="box">
                                <img src="../images/review/quote-img.png" alt="" class="quote" />
                                <?php
                                $profileImg = Database::search("SELECT * FROM `feedback_img` WHERE `feedback_user`= '" . $feedData["user_email"] . "' ");
                                $pn = $profileImg->num_rows;
                                if ($pn == 1) {
                                    $p = $profileImg->fetch_assoc();
                                ?>
                                    <img class="user" src="../images/review/<?php echo $p["image"] ?>" />
                                <?php

                                } else {
                                ?>

                                    <img src="../images/review/pic-1.png" alt="" class="user" />


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
                            //     
                            ?>
                            <!-- // <div class="col-12 text-center pt-4">
                                // <span class="fs-3">No FeedBacks</span>
                                // </div> -->
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

                    <!-- <div class="box">
                        <img src="images/review/quote-img.png" alt="" class="quote" />
                        <img src="images/review/pic-2.png" alt="" class="user" />
                        <h3>john deo</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure saepe
                            ab, vitae pariatur magni, quas culpa at, laudantium et repudiandae
                            sed nobis consectetur earum aliquid assumenda minima ipsa debitis
                            corrupti.
                        </p>
                    </div>

                    <div class="box">
                        <img src="images/review/quote-img.png" alt="" class="quote" />
                        <img src="images/review/pic-3.png" alt="" class="user" />
                        <h3>john deo</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure saepe
                            ab, vitae pariatur magni, quas culpa at, laudantium et repudiandae
                            sed nobis consectetur earum aliquid assumenda minima ipsa debitis
                            corrupti.
                        </p>
                    </div> -->

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
            <footer class="footer">
                <div class="header-left">
                </div>
                <nav class="header-mid" style=" justify-content: center;">
                    Partnerships
                </nav>
                <div class="header-right">
                </div>
            </footer>
        </div>
        <!-- <script>
            let packs = document.querySelectorAll('.hotel-packages');
            for (let item of packs) {
                item.addEventListener('click', () => {
                    pageTravel('hotel-package-view.php')
                });
            }
        </script> -->
        <script src="../js/gallery.js"></script>
        <script src="../js/common.js"></script>
        <script src="../js/hotel-profile.js"></script>
    </body>

    </html>


<?php
} else {

    echo "error";
}

?>