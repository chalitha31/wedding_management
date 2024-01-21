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
        <title>Admin Booking</title>
        <link rel="icon" href="../images/LogoW.png" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="admin-css/admin-common.css">
        <link rel="stylesheet" href="admin-css/admin-booking.css">
    </head>

    <body>
        <header>
            <img src="../images/logo.jpeg" alt="logo" class="logo" onclick="pageTravel('../home.php')">
            <div class="header-right">
                <div class="seller-name">Admin Panel</div>
            </div>
        </header>

        <div class="sidebar">
            <span onclick="pageTravel('admin-dashboard.php')" class=" styl1">Dashboard</span>
            <span onclick="pageTravel('admin-booking.php')" class="sidebar-active styl1">Booking</span>
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

        <div class="admin-container">
            <div class="time-container">
                <span style="display: flex; justify-content: end; width: 97%;" class="" id="current-datetime"> </span>
            </div>
            <div class="page-title">Booking Section</div>

            <div class="selector-container">
                <label for="type-select">Select Type</label>
                <select name="" id="type-select" class="type-selector" onchange="bookhisry()">
                    <option value="0">Hotels</option>
                    <option value="1">Dj</option>
                    <option value="2">Photography</option>
                    <option value="3">Vehicles</option>
                </select>
            </div>


            <table id="results">




            </table>


        </div>

        <script src="admin-js/admin-common.js"></script>
        <script src="admin-js/admin-booking.js"></script>
        <script src="admin-js/time.js"></script>
    </body>

    </html>
<?php
} else {
    echo "Please Sign In as A Admin";
}

?>