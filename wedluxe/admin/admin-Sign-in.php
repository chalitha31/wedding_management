<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin sign in</title>
    <link rel="icon" href="../images/LogoW.png" />
    <link rel="stylesheet" href="admin-css/admin-Sign-in.css">
</head>

<body>
    <header>
        <a onclick="pageTravel('home.php')"><img src="../images/Logo.png" alt="LOGO" class="logo"></a>
    </header>

    <div class="admin-sign-up-form-container">

        <div class="form-heading">
            <h2>ADMIN LOGGING</h2>
        </div>

        <div class="mail-tag tag">Email</div>

        <input class="email-input" type="email" id="email">

        <div class="opt-tag tag">OPT (check your mail)</div>

        <input class="opt-input" type="password" id="otpinput" disabled>

        <div class="gif-container">
            <!-- <img class="load-gif" src="images/package_img/preloader.gif"> -->
            <!-- <lord-icon src="https://cdn.lordicon.com/xjovhxra.json" trigger="loop" colors="primary:#30c9e8,secondary:#08a88a" style="width:250px;height:250px"></lord-icon> -->
            <lord-icon src="https://cdn.lordicon.com/ridbdkcb.json" trigger="loop" colors="primary:#4be1ec,secondary:#cb5eee" style="width:100px;height:100px">
            </lord-icon>
            <div class="sentL">Sent</div>
        </div>

        <div class="button-container">
            <a href="../home.php" class="back-button">Back</a>
            <button onclick="adminVerification();" class="code-button" id="sendlogin">Send Verification Code</button>
        </div>
    </div>

    <script src="admin-js/admin-Sign-in.js"></script>
    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
</body>

</html>