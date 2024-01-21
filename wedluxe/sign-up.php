<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="icon" href="images/LogoW.png" />
    <link rel="stylesheet" href="css/sign-up.css">
</head>

<body>
    <header>
        <a onclick="pageTravel('home.php')"><img src="images/logo.jpeg" alt="LOGO" class="logo"></a>
    </header>
    <img src="images/sign-up-backgroung.jpg" alt="" class="sign-up-backdrop">
    <div class="sign-up-form-container">
        <div class="form-heading">
            <h2>Register</h2>
            <h5></h5>
        </div>
        <span style="color: red;" id="errorView"></span>
        <input type="text" placeholder="First Name" id="fname">
        <input type="text" placeholder="Last Name" id="lname">
        <input type="email" placeholder="E-Mail" id="email">
        <input type="password" placeholder="Password" id="pw">
        <input type="password" placeholder="Confirm Password" id="Rpw">

        <!-- <div class="type-category">
            <div class="user-div">
                <input type="radio" name="table" id="loguser" value='1' checked>
                <label for="loguser">User</label>
            </div>

            <div class="seller-div">
                <input type="radio" name="table" id="logseller" value='2'>
                <label for="logseller">Seller</label>
            </div>
        </div> -->

        <div class="type-category">

            <div class="seller-div">
                <input type="checkbox" id="logseller">
                <div class="sell-label">Seller (not for normal members)</div>
            </div>

            <div class="seller-type-container">
                <label class="seller-label" for="seller-hotel-r">Hotel</label>
                <input style="display: none;" class="seller-input-r" type="radio" name="seller-type-r" id="seller-hotel-r">
                <label class="seller-label" for="seller-photo-r">Photography</label>
                <input style="display: none;" class="seller-input-r" type="radio" name="seller-type-r" id="seller-photo-r">
                <label class="seller-label" for="seller-dj-r">Dj</label>
                <input style="display: none;" class="seller-input-r" type="radio" name="seller-type-r" id="seller-dj-r">
                <label class="seller-label" for="seller-vehicle-r">Vehicle</label>
                <input style="display: none;" class="seller-input-r" type="radio" name="seller-type-r" id="seller-vehicle-r">
            </div>
        </div>

        <button class="register-button" onclick="signUp();">Register</button>
    </div>
    <script src="js/common.js"></script>
    <script src="js/header.js"></script>
    <script src="js/sign-up.js"></script>
</body>

</html>