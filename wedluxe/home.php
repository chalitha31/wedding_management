<?php
require_once "header.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" href="images/LogoW.png" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>



    <div id="home-page" class="display">
        <img src="images/Logo.png" alt="" class="home-logo">
        <img src="images/hwal.jpg" alt="" class="homi-wall">
        <h1 class="home-caption">create memories that will last a lifetime</h1>
    </div>

    <div id="hotels-page" class="display">
        <div class="page-title">Hotels</div>
        <div class="description-block">
            <div class="card-holder">
                <div class="cards">
                    <img src="images/home-hotels.jpg" alt="" class="card-img">
                </div>
                <div class="cards">
                    <img src="images//package-photo-1.jpg" alt="" class="card-img">
                </div>
                <div class="cards">
                    <img src="images/package-photo-2.jpg" alt="" class="card-img">
                </div>
            </div>
            <div class="description-holder">
                <div class="description">
                    Planning a wedding involves numerous decisions, and one of the most crucial choices is selecting the perfect hotel venue to host your special day. Our website is here to simplify the process, providing you with comprehensive information and tools to assist you in finding the ideal wedding hotel for your celebration.
                </div>
                <button class="hotel-btn page-button btn-left" onclick="pageTravel('hotel-home.php')">View
                    Hotels</button>
            </div>
        </div>
        <img src="images/church.png" alt="" class="watermark wr">
    </div>

    <div id="photograpy-page" class="display">
        <!-- <img src="images/photo-wall.jpg" alt="" class="home-wall"> -->
        <div class="page-title">Photographers</div>
        <div class="description-block block-right">
            <div class="description-holder">
                <div class="description">
                    Choosing the right wedding photographer is a crucial decision in capturing the beautiful moments and emotions of your special day. Our website is designed to make this process easier for you, providing a comprehensive platform to explore and select the perfect wedding photographer who will preserve your memories for a lifetime.
                </div>
                <button class="hotel-btn page-button btn-right" onclick="pageTravel('photography-home.php')">View
                    Photographers</button>
            </div>
            <div class="card-holder">
                <div class="cards">
                    <img src="images/photo-wall.jpg" alt="" class="card-img">
                </div>
                <div class="cards">
                    <img src="images/home-photography.jpeg" alt="" class="card-img">
                </div>
                <div class="cards">
                    <img src="images/photo-2.jpg" alt="" class="card-img">
                </div>
            </div>
        </div>
        <img src="images/camera.png" alt="" class="watermark wl">
    </div>

    <div id="dj-page" class="display">
        <div class="page-title">Dj</div>
        <div class="description-block">
            <div class="card-holder">
                <div class="cards">
                    <img src="images/dj-2.jpg" alt="" class="card-img">
                </div>
                <div class="cards">
                    <img src="images/dj-wall.jpg" alt="" class="card-img">
                </div>
                <div class="cards">
                    <img src="images/home-dj.jpg" alt="" class="card-img">
                </div>
            </div>
            <div class="description-holder">
                <div class="description">
                    When it comes to creating a vibrant and unforgettable atmosphere at your wedding, the right DJ can make all the difference. Our website is here to assist you in finding the perfect DJ who will set the mood, keep the dance floor alive, and ensure that your guests have an incredible time celebrating your special day.
                </div>
                <button class="dj-btn page-button btn-left" onclick="pageTravel('dj-home.php')">View Dj</button>
            </div>
        </div>
        <img src="images/karaoke.png" alt="" class="watermark wr">
    </div>

    <div id="vehicles-page" class="display">
        <!-- <img src="images/vehi-wall.webp" alt="" class="home-wall"> -->
        <div class="page-title">Vehical Dealerships</div>
        <div class="description-block block-right">
            <div class="description-holder">
                <div class="description">
                    Arriving in style on your wedding day is a wonderful way to make a grand entrance and add a touch of elegance to your celebration. Our website is designed to assist you in selecting the perfect wedding vehicle, whether you prefer classic cars, luxurious limousines, vintage carriages, or any other transportation option that suits your style and theme.
                </div>
                <button class="vehicle-btn page-button btn-right" onclick="pageTravel('vehicle-home.php')">View
                    Vehicles</button>
            </div>
            <div class="card-holder">
                <div class="cards">
                    <img src="images/vehicle profile/c11.jpg" alt="" class="card-img">
                </div>
                <div class="cards">
                    <img src="images/vehicle profile/p1.jpg" alt="" class="card-img">
                </div>
                <div class="cards">
                    <img src="images/vehicle profile/c13.jpg" alt="" class="card-img">
                </div>
            </div>
        </div>
        <img src="images/just-married.png" alt="" class="watermark wl">
    </div>
    <div style="display: none;" id="contact-page" class="display">
        <div style="color: black;" class="page-title">Contacts</div>

    </div>

    <div id="about-page" class="display">
        <img src="images/settings.gif" alt="" class="back-gif">
        <div class="contact-details">
            <h1>About Us</h1>
            <p>Welcome to our wedding management website, where we are dedicated to creating unforgettable
                weddings that reflect your unique style and love story. Our team of professionals takes
                care of every detail, ensuring a stress-free and magical experience.
                With our creativity, attention to detail, and trusted network of vendors, we bring your vision
                to life while staying within your budget. Let us guide you through the journey of planning your
                dream wedding and creating cherished memories that will last a lifetime. Contact us today to get started!</p>
        </div>
        <img src="images/leaf.png" alt="" class="leaf">
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
    <script src="js/home.js"></script>
</body>

</html>