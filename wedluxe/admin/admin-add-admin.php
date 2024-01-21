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
        <title>Add Admin</title>
        <link rel="icon" href="../images/LogoW.png" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="admin-css/admin-common.css">
        <link rel="stylesheet" href="admin-css/admin-booking.css">
        <link rel="stylesheet" href="admin-css/admin-add-admin.css">
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
            <span onclick="pageTravel('admin-booking.php')" class="styl1">Booking</span>
            <span onclick="pageTravel('admin-profile-manage.php')" class="styl1">Profile Manage</span>
            <span onclick="pageTravel('admin-user-seller.php')" class="styl1">User Seller</span>

            <?php
            if ($_SESSION["admintype"] == "1") {
            ?>
                <span onclick="pageTravel('admin-add-admin.php')" class="sidebar-active styl1">Add Admin</span>

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
            <div class="page-title">Profile Manage</div>

            <div class="add-admin-con">
                <label for="fName">First Name</label>
                <input type="text" name="" id="fName">
                <label for="lName">Last Name</label>
                <input type="text" name="" id="lName">
                <label for="aEmail">Email</label>
                <input type="email" name="" id="aEmail">
                <button onclick="addadmin()" class="add-btn">ADD</button>
            </div>


            <h3 class="admin-staff">Admin Staff</h3>
            <table>
                <tr>
                    <th style="width:30%;">First Name</th>
                    <th style="width:30%;">Last Name</th>
                    <th style="width:45%;">Email</th>
                    <th>block</th>
                </tr>

                <?php
                $resultset = Database::search("SELECT * FROM `admin` WHERE `type` != '1' ");

                $nrow = $resultset->num_rows;
                for ($i = 0; $i < $nrow; $i++) {

                    $AData = $resultset->fetch_assoc();
                ?>

                    <tr>
                        <td><?php echo $AData["fname"] ?></td>
                        <td><?php echo $AData["lname"] ?></td>
                        <td style="text-align:center"><?php echo $AData["email"] ?></td>
                        <td><button id="bt<?php echo $AData["email"] ?>" onclick="blockAdmin('<?php echo $AData['email'] ?>')" class="block-btn  <?php
                                                                                                                                                    if ($AData["status"] == "0") {
                                                                                                                                                    ?>
                                                                                                                                               block
                                                                                                                                                <?php
                                                                                                                                                    } else if ($AData["status"] == "1") {
                                                                                                                                                ?>
                                                                                                                                                unblock
                                                                                                                                                <?php
                                                                                                                                                    }
                                                                                                                                                ?>"><?php
                                                                                                                                                    if ($AData["status"] == "0") {
                                                                                                                                                        echo "Block";
                                                                                                                                                    } else if ($AData["status"] == "1") {
                                                                                                                                                        echo "unblock";
                                                                                                                                                    }
                                                                                                                                                    ?></button></td>
                    </tr>

                <?php
                }
                ?>
            </table>

        </div>

        <script src="admin-js/admin-common.js"></script>
        <script src="admin-js/admin-add-admin.js"></script>
        <script src="admin-js/time.js"></script>
    </body>

    </html>

<?php
} else {
    echo "Please Sign In as A Admin";
}

?>