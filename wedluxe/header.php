<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>he</title> -->
    <link rel="icon" href="images/LogoW.png" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header>
        <div class="header-left">
            <a onclick="pageTravel('home.php')"><img src="images/Logo.png" alt="LOGO" class="logo"></a>
        </div>

        <?php
        session_start();
        require "connection.php";
        $currentPage = basename($_SERVER['PHP_SELF']);
        // echo $currentPage;
        ?>

        <nav class="header-mid">
            <!-- <a class="navs" onclick="pageTravel('hotel-home.php')">Hotels</a>
            <a class="navs" onclick="pageTravel('photography-home.php')">Photography</a>
            <a class="navs" onclick="pageTravel('dj-home.php')">Dj</a>
            <a class="navs" onclick="pageTravel('vehicle-home.php')">Vehicals</a> -->
            <a class="navs <?php if ($currentPage === 'hotel-home.php' || $currentPage === 'hotel-profile.php' || $currentPage === 'hotel-package-view.php') echo 'active'; ?>" onclick="pageTravel('hotel-home.php')">Hotels</a>
            <a class="navs <?php if ($currentPage === 'photography-home.php' || $currentPage === 'photography-profile.php' || $currentPage === 'photography-package-view.php') echo 'active'; ?>" onclick="pageTravel('photography-home.php')">Photography</a>
            <a class="navs <?php if ($currentPage === 'dj-home.php' || $currentPage === 'dj-profile.php' || $currentPage === 'dj-package-view.php') echo 'active'; ?>" onclick="pageTravel('dj-home.php')">Dj</a>
            <a class="navs <?php if ($currentPage === 'vehicle-home.php' || $currentPage === 'vehicle-profile.php') echo 'active'; ?>" onclick="pageTravel('vehicle-home.php')">Vehicles</a>


            <?php if ($currentPage === 'home.php') {
            ?>
                <!-- <a class="navs" href="#contact-page">Contact</a> -->
                <a class="navs" href="#about-page">About</a>

            <?php
            }
            ?>

            <?php
            if (isset($_SESSION["user_email"])) {
            ?>

                <a class="navs <?php if ($currentPage === 'purchaseHistory.php') echo 'active'; ?>" onclick="pageTravel('purchaseHistory.php')">Bookings</a>

            <?php
            } else {
            ?>

                <a class="navs " onclick="bokksignin();">Bookings</a>
            <?php
            }
            ?>

            <!-- <a class="" id="s" onclick="pageTravel('hotel-home.php')">Hotels</a>
            <a class="" id="s" onclick="pageTravel('photography-home.php')">Photography</a>
            <a class="" id="s" onclick="pageTravel('dj-home.php')">Dj</a>
            <a class="" id="s" onclick="pageTravel('vehicle-home.php')">Vehicals</a> -->
        </nav>

        <?php


        if (isset($_SESSION["user_email"])) {

            if ($_SESSION["type"] == "1") {
        ?>

                <div class="header-right">
                    <a class="user"><?php echo $_SESSION["user_fname"] ?></a>
                    <div onclick="signOut();" class="sign-text">Sign Out</div>
                </div>

            <?php
            } elseif ($_SESSION["type"] == "5") {


            ?>

                <div class="header-right">
                    <a onclick="pageTravel('profile-edit-vehicle.php')" style=" cursor: pointer; text-decoration: none;" class="user"><?php echo $_SESSION["user_fname"] ?></a>
                    <div onclick="signOut();" class="sign-text">Sign Out</div>
                </div>

            <?php

            } else {
                $typId = $_SESSION["type"];
            ?>

                <div class="header-right">
                    <a onclick="pageTravel('profile-edit.php?Tid=<?php echo $typId ?>')" style=" cursor: pointer; text-decoration: none;" class="user"><?php echo $_SESSION["user_fname"] ?></a>
                    <div onclick="signOut();" class="sign-text">Sign Out</div>
                </div>

            <?php
            }
            ?>



        <?php
        } else {
        ?>



            <div class="header-right">
                <!-- <div class="user">User</div> -->
                <div class="sign-text">Sign in</div>
            </div>

        <?php
        }
        ?>


        <img src="images/hamburger.png" alt="" class="hamb-menu">
        <div class="nav-dropdown">
            <a onclick="pageTravel('hotel-home.php')">Hotels</a>
            <a onclick="pageTravel('photography-home.php')">Photography</a>
            <a onclick="pageTravel('dj-home.php')">Dj</a>
            <a onclick="pageTravel('vehicle-home.php')">Vehicals</a>
            <a onclick="pageTravel('purchaseHistory.php')">Bookings</a>
        </div>

        <!-- Remember Me -->

        <?php

        $email = "";
        $password = "";

        if (isset($_COOKIE["email"])) {
            $email = $_COOKIE["email"];
        }

        if (isset($_COOKIE["password"])) {
            $password = $_COOKIE["password"];
        }

        ?>

        <!-- Remember Me -->


        <div class="form-container header-sign-form">
            <div class="close-tag form-close"><i class="fa-regular fa-circle-xmark"></i></div>
            <div class="form-lable">Client Logging</div>

            <div class="">
                <span style="color: red;" class="" id="errorView"></span>
            </div>

            <div class="form-mail-container input-container">
                <div class="input-lable mail-lable">E-mail</div>
                <input type="email" id="email" value="<?php echo $email ?>">
            </div>
            <div class="form-mail-container input-container">
                <div class="input-lable password-lable">Password</div>
                <input type="password" id="pw" value="<?php echo $password ?>">
            </div>

            <div class="click-box">
                <div class="rem-box">
                    <input type="checkbox" name="" id="rememberMe" value="1">
                    <label for="rememberMe">remember me</label>
                </div>
                <div class="fog">Forgot Password?</div>
            </div>
            <button onclick="login();" class="form-join-button">Sign in</button>
            <div class="form-footer">
                <a onclick="pageTravel('sign-up.php')" class="register-click">Register here</a>
                <a onclick="pageTravel('admin/admin-Sign-in.php')" class="admin-click"><i class="fa-sharp fa-solid fa-star"></i>Admin</a>
            </div>

        </div>




        <div class="forget-form-container">


            <div class="close-tag forgot-form-close"><i class="fa-regular fa-circle-xmark"></i></div>
            <div class="form-lable">Reset Pasword</div>
            <span style="color: red;" id="VerrorView"></span>
            <div class="form-mail-container input-container">
                <div class="input-lable mail-lable">E-mail</div>
                <input type="email" id="Vemail">
            </div>




            <button onclick="forgotpassword()" id="send-otp-button" class="send-otp-button">Send OTP</button>
            <div class="reset-drawer">
                <div class="form-mail-container input-container">
                    <div class="input-lable otp-lable">OTP</div>
                    <input type="text" id="vc" readonly>
                </div>
                <div class="form-mail-container input-container">
                    <div class="input-lable ps-lable">new password</div>
                    <input type="password" id="np" readonly>
                </div>
                <div class="form-mail-container input-container">
                    <div class="input-lable nps-lable">re-enter new password</div>
                    <input type="password" id="rnp" readonly>
                </div>

                <button onclick="resetPassword()" id="change-pass-button" class="change-pass-button notallow" disabled>change password</button>



            </div>
        </div>



    </header>


    <script src="js/header.js"></script>
    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
</body>

</html>