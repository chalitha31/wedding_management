<?php
require "connection.php";
session_start();
$val = $_GET["Cid"];


$Bookings = array();

// Query for hotel bookings with order date in descending order
$queryHotel = "SELECT *, `wedding_date` AS `booking_date` FROM `hotel_booking` WHERE `user_email` = '" . $_SESSION["user_email"] . "' AND `hidden` = '0' AND `order_status` = 'confirmed' ORDER BY `order_date` DESC";
$purchase_rs = Database::search($queryHotel);
if ($purchase_rs) {
    $hotelBookings = array();
    while ($row = mysqli_fetch_assoc($purchase_rs)) {
        $row['booking_type'] = 'hotel_booking';
        $hotelBookings[] = $row;
    }
    $Bookings['hotel_bookings'] = $hotelBookings;
} else {
    echo "Error executing the hotel booking query: " . mysqli_error($connection);
}

// print_r($hotelBookings)




$queryPhotography = "SELECT * FROM `photography_booking` WHERE `user_email` = '" . $_SESSION["user_email"] . "' AND `hidden` = '0' AND `order_status` = 'confirmed' ORDER BY `order_date` DESC";
$purchase_rs = Database::search($queryPhotography);
if ($purchase_rs) {
    $photoBookings = array();
    while ($row = mysqli_fetch_assoc($purchase_rs)) {

        $row['booking_type'] = 'photography_booking';
        $photoBookings[] = $row;
    }

    $Bookings['photography_bookings'] = $photoBookings;
} else {
    echo "Error executing the photography booking query: " . mysqli_error($connection);
}

$queryPhotography = "SELECT * FROM `dj_booking`  WHERE `user_email` = '" . $_SESSION["user_email"] . "' AND `hidden` = '0' AND `order_status` = 'confirmed' ORDER BY `id` DESC";
$purchase_rs = Database::search($queryPhotography);
if ($purchase_rs) {
    $djBookings = array();
    while ($row = mysqli_fetch_assoc($purchase_rs)) {
        $row['booking_type'] = 'dj_booking';
        $djBookings[] = $row;
    }

    $Bookings['dj_bookings'] = $djBookings;
} else {
    echo "Error executing the photography booking query: " . mysqli_error($connection);
}

$queryPhotography = "SELECT * FROM `vehical_booking`  WHERE `user_email` = '" . $_SESSION["user_email"] . "' AND `hidden` = '0' AND `order_status` = 'confirmed' ORDER BY `id` DESC ";
$purchase_rs = Database::search($queryPhotography);
if ($purchase_rs) {
    $vehBookings = array();
    while ($row = mysqli_fetch_assoc($purchase_rs)) {
        $row['booking_type'] = 'vehical_booking';
        $vehBookings[] = $row;
    }

    $Bookings['vehical_bookings'] = $vehBookings;
} else {
    echo "Error executing the photography booking query: " . mysqli_error($connection);
}

// echo  $Bookings['hotel_bookings'][1]['order_date'];
// echo  $Bookings['photography_bookings'][1]['order_date'];
// print_r($Bookings);


// Merge and sort the bookings array by order_date
$mergedBookings = array_merge($Bookings['photography_bookings'], $Bookings['hotel_bookings'], $Bookings['dj_bookings'], $Bookings['vehical_bookings']);

if ($val == "1") {

    usort($mergedBookings, function ($a, $b) {
        return strtotime($b['order_date']) - strtotime($a['order_date']);
    });
} else {
    // $mergedBookings = array_merge($Bookings['photography_bookings'], $Bookings['hotel_bookings'], $Bookings['dj_bookings'], $Bookings['vehical_bookings']);

    usort($mergedBookings, function ($a, $b) {
        $today = strtotime(date('Y-m-d')); // Get the current day as a timestamp
        $bookingDateA = strtotime($a['booking_date']); // Convert booking dates to timestamps
        $bookingDateB = strtotime($b['booking_date']);

        // Calculate the difference in days between booking dates and the current day
        $daysDifferenceA = ($bookingDateA > $today) ? ($bookingDateA - $today) / (60 * 60 * 24) : PHP_INT_MAX;
        $daysDifferenceB = ($bookingDateB > $today) ? ($bookingDateB - $today) / (60 * 60 * 24) : PHP_INT_MAX;

        // Compare the differences to determine the closest booking date
        return $daysDifferenceA - $daysDifferenceB;
    });
}
// Access and process the merged bookings array



?>



<?php
$val_id = "";

if (empty($mergedBookings)) {
?>
    <div class="col-12 bg-light text-center">
        <span style="margin-top: 200px;margin-bottom:200px ;" class="fs-1 fw-bold text-black-50 d-block">
            You Have No Items In Your history Yet...
        </span>
    </div>
    <?php
} else {



    foreach ($mergedBookings as $booking) {
        // Access individual booking data
        // $orderDate = $booking['order_date'];
        // $id = $booking['id'];


        // $bookingType = isset($booking['packag_id']) ? 'photography_booking' : 'hotel_booking' :'dj_booking' : 'vehical_booking';
        // if ($booking['booking_type'] == 'hotel_booking') {
        //     echo "hotel_booking";
        // } elseif ($booking['booking_type'] == 'photography_booking') {
        //     echo "photography_booking";
        // } elseif ($booking['booking_type'] == 'dj_booking') {
        //     echo "dj_booking";
        // } elseif ($booking['booking_type'] == 'vehical_booking') {
        //     echo "vehical_booking";
        // }
        // Process the booking data as needed
        // echo "Booking - Order Date: " . $orderDate . ", ID: " . $id . "<br>";
        $image_rsn = 0;

        if ($booking['booking_type'] == 'hotel_booking') {
            $val_id = "0";
            $product_rs = Database::search("SELECT * FROM `packages` WHERE `id` = '" . $booking["packag_id"] . "'");

            $product_data = $product_rs->fetch_assoc();

            $image_rs = Database::search("SELECT `hotels`.`name`,`hotels`.`id`,`hotel_img_logo`.`image` FROM `hotels` INNER JOIN `hotel_img_logo` ON `hotels`.`id` = `hotel_img_logo`.`hotel_id` WHERE `hotels`.`id` = '" . $product_data["hotel_id"] . "'  ");

            $image_rsn = $image_rs->num_rows;
        } elseif ($booking['booking_type'] == 'dj_booking') {
            $val_id = "1";
            $product_rs = Database::search("SELECT * FROM `dj_package` WHERE `id` = '" . $booking["packag_id"] . "'");

            $product_data = $product_rs->fetch_assoc();

            $image_rs = Database::search("SELECT `dj`.`name`,`dj`.`company_name`,`dj`.`id`,`dj_img_logo`.`image` FROM `dj` INNER JOIN `dj_img_logo` ON `dj`.`id` = `dj_img_logo`.`dj_id` WHERE `dj`.`id` = '" . $product_data["dj_id"] . "'  ");

            $image_rsn = $image_rs->num_rows;
        } elseif ($booking['booking_type'] == 'photography_booking') {
            $val_id = "2";
            $product_rs = Database::search("SELECT * FROM `photography_package` WHERE `id` = '" . $booking["packag_id"] . "'");

            $product_data = $product_rs->fetch_assoc();

            $image_rs = Database::search("SELECT `photography`.`name`,`photography`.`company_name`,`photography`.`id`,`photography__img_logo`.`image` FROM `photography` INNER JOIN `photography__img_logo` ON `photography`.`id` = `photography__img_logo`.`photography_id` WHERE `photography`.`id` = '" . $product_data["photography_id"] . "'  ");

            $image_rsn = $image_rs->num_rows;
        } elseif ($booking['booking_type'] == 'vehical_booking') {
            // $product_rs = Database::search("SELECT * FROM `packages` WHERE `id` = '" . $data["packag_id"] . "'");


            // $product_data = $product_rs->fetch_assoc();
            $val_id = "3";
            $image_rs = Database::search("SELECT  `vehicles_details`.`model`,`vehicles_details`.`company_id`,`vehicles_details`.`name`,`vehicles`.`company_name`,`vehicles_details`.`id`,`vehicles_img`.`img` FROM `vehicles_details` INNER JOIN `vehicles_img` ON `vehicles_details`.`id` = `vehicles_img`.`vehical_de_id` INNER JOIN `vehicles` ON `vehicles`.`id` = `vehicles_details`.`company_id` WHERE `vehicles_details`.`id` = '" . $booking["vehical_detils_id"] . "'  ");


            $image_rsn = $image_rs->num_rows;
        }
    ?>

        <!-- Alert -->
        <div id="custom-dialog" style="display: none;">
            <div id="customAlert" style="text-align: center;" class="message ">Do you want to continue?</div>
            <div class="buttons">
                <button id="custom-no">No</button>
                <button id="custom-yes">Yes</button>
            </div>
        </div>
        <!-- Alert -->



        <div class="col-12 mt-0">
            <div class="row">
                <div class="col-1 mx-3 mt-4 mb-1">
                    <div class="row">
                        <span class="text-start fs-2 d-flex" style="font-family: Impact;"><img style="width: 43px;" src="images/Logo.jpg" /><?php echo $booking['booking_type'] ?></span>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">

                        <div class="col-12 col-lg-1 bg-info text-center text-lg-end">
                            <div class="row">
                                <label class="form-label text-lg-start mt-2" style="font-size: 16px; font-family: Tahoma, sans-serif; font-weight: bolder;">Order_id</label>
                            </div>
                            <label class="form-label text-white fs-5 py-5 fw-bold"><?php echo $booking['order_id'] ?></label>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="text-start">
                                    <label class="form-label text-center mt-2" style="font-size: 16px; font-family: Tahoma; font-weight: bolder;">Order Details</label>
                                </div>
                            </div>

                            <?php
                            if ($image_rsn >= 1) {
                                $image_data = $image_rs->fetch_assoc();

                                // $val_id = $val;
                            ?>
                                <div class="row g-2 py-0">
                                    <div class="card mx-0 my-3" style="max-width: 540px;">
                                        <div class="row g-0">
                                            <div class="col-md-4">

                                                <?php
                                                if ($booking['booking_type'] == 'hotel_booking') {
                                                ?>

                                                    <img src="images/hotels/<?php echo $image_data["image"]; ?>" class="img-fluid rounded-start" alt="...">

                                                <?php
                                                } elseif ($booking['booking_type'] == 'dj_booking') {

                                                ?>

                                                    <img src="images/dj/<?php echo $image_data["image"]; ?>" class="img-fluid rounded-start" alt="...">

                                                <?php
                                                } elseif ($booking['booking_type'] == 'photography_booking') {

                                                ?>

                                                    <img src="images/photographers/<?php echo $image_data["image"]; ?>" class="img-fluid rounded-start" alt="...">

                                                <?php
                                                } elseif ($booking['booking_type'] == 'vehical_booking') {

                                                ?>

                                                    <img src="images/vehicles/gallary/<?php echo $image_data["img"]; ?>" class="img-fluid rounded-start" alt="...">

                                                <?php
                                                }
                                                ?>
                                                <!-- <img src="images/hotels/<?php echo $image_data["image"]; ?>" class="img-fluid rounded-start" alt="..."> -->

                                            </div>
                                            <div class="col-md-8 ">
                                                <div class="card-body">
                                                    <?php
                                                    if ($booking['booking_type'] == 'vehical_booking') {
                                                        $product_rs = Database::search("SELECT * FROM `vehicles` WHERE `id` = '" . $image_data["company_id"] . "'");


                                                        $product_data = $product_rs->fetch_assoc();
                                                    ?>

                                                        <h5 class="card-title"><?php echo $product_data["company_name"] ?></h5>
                                                        <p class="card-text"><b>vehicle : </b> <?php echo $image_data["name"] ?></p>
                                                        <p class="card-text"><b>Model : </b> <?php echo $image_data["model"] ?></p>

                                                        <p class="card-text"><b>Order Date : </b> <?php echo $booking["order_date"] ?> </p>

                                                    <?php
                                                    } elseif ($booking['booking_type'] == 'hotel_booking') {
                                                    ?>
                                                        <h5 class="card-title"><?php echo $image_data["name"] ?></h5>
                                                        <p class="card-text"><b>packages : </b> <?php echo $product_data["package_type"] ?></p>

                                                        <p class="card-text"><b>Order Date : </b> <?php echo $booking["order_date"]  ?> </p>

                                                    <?php
                                                    } else {
                                                    ?>

                                                        <h5 class="card-title"><?php echo $image_data["company_name"] ?></h5>
                                                        <p class="card-text"><b></b> <?php echo $image_data["name"]  ?></p>
                                                        <p class="card-text"><b>packages : </b> <?php echo $product_data["package_type"] ?></p>

                                                        <p class="card-text"><b>Order Date : </b> <?php echo $booking["order_date"]  ?> </p>

                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <!-- <img src="resources/empty.svg" class="img-fluid rounded-start" alt="..."> -->

                            <?php
                            }
                            ?>
                        </div>
                        <?php
                        if ($booking['booking_type'] == 'vehical_booking') {
                        ?>
                            <div class="col-12 col-lg-2 text-center text-lg-end bg-info">
                                <div class="row">
                                    <div class="text-start">
                                        <label class="form-label text-start mt-2" style="font-size: 16px; font-family: Tahoma; font-weight: bolder;">Days</label>
                                    </div>
                                </div>
                                <label class="form-label fs-4 text-white fw-bold py-5"><?php echo $booking['extra_date'] ?></label>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-12 col-lg-2 text-center text-lg-end bg-info">
                                <div class="row">
                                    <div class="text-start">
                                        <label class="form-label text-start mt-2" style="font-size: 16px; font-family: Tahoma; font-weight: bolder;">Amount</label>
                                    </div>
                                </div>
                                <label class="form-label fs-4 text-white fw-bold py-5">Rs.<?php echo $product_data["price"]; ?>.00</label>
                            </div>

                        <?php } ?>


                        <div class="col-12 col-lg-2 text-center text-lg-end bg-light">
                            <?php
                            if ($booking['booking_type'] == 'hotel_booking') {
                            ?>
                                <div class="row">
                                    <div class="text-start">
                                        <label class="form-label mt-2" style="font-size: 16px; font-family: Tahoma; font-weight: bolder;">Wedding date</label>
                                    </div>
                                </div>
                                <label class="form-label fs-4 py-5 px-3 fw-bold"><?php echo $booking["wedding_date"]; ?></label>
                            <?php
                            } else {

                            ?>
                                <div class="row">
                                    <div class="text-start">
                                        <label class="form-label mt-2" style="font-size: 16px; font-family: Tahoma; font-weight: bolder;">Booking date</label>
                                    </div>
                                </div>
                                <label class="form-label fs-4 py-5 px-3 fw-bold"><?php echo $booking["booking_date"]; ?></label>
                            <?php
                            }

                            ?>
                        </div>


                        <div class="col-12 col-lg-3 mt-5">
                            <div class="row">
                                <div class="col-6 d-grid">
                                    <?php
                                    if ($booking['booking_type'] == 'vehical_booking') {

                                    ?>
                                        <button onclick="showFeedbackModel('<?php echo $image_data['id'] ?>','<?php echo $image_data['name'] ?>','<?php echo $image_data['model'] ?>','<?php echo $val_id ?>')" class="btn btn-secondary rounded border border-1 border-primary mt-5 fs-5"><i class="bi bi-info-circle-fill"></i> Feed Back</button>
                                    <?php
                                    } else {
                                        $model = "";
                                    ?>
                                        <button onclick="showFeedbackModel('<?php echo $image_data['id'] ?>','<?php echo $image_data['name'] ?>','<?php echo $model ?>','<?php echo $val_id ?>')" class="btn btn-secondary rounded border border-1 border-primary mt-5 fs-5"><i class="bi bi-info-circle-fill"></i> Feed Back</button>

                                    <?php }

                                    ?>

                                </div>

                                <?php
                                $d = new DateTime();
                                $tz = new DateTimezone("Asia/Colombo");
                                $d->setTimezone($tz);
                                $date = $d->format("Y-m-d");


                                if ($booking['booking_type'] == 'hotel_booking') {


                                    if ($date < $booking["wedding_date"]) {
                                ?>
                                        <div class="col-4 d-grid">
                                            <button class="btn btn-warning rounded mt-5 fs-6" onclick="cancelbooking('<?php echo $booking['id']; ?>','<?php echo $val_id ?>');"><i style="-webkit-text-stroke-width: 3.7px; " class="bi bi-x-lg"></i> cancel</button>
                                        </div>

                                        <div class="col-1 d-grid">
                                            <button class="btn btn-danger rounded mt-5 fs-5" onclick="deleteFromPHistory('<?php echo $booking['id']; ?>','<?php echo $val_id ?>');"><i class="bi bi-trash-fill"></i></button>
                                        </div>

                                    <?php
                                    } else {
                                    ?>

                                        <div class="col-6 d-grid">
                                            <button class="btn btn-danger rounded mt-5 fs-5" onclick="deleteFromPHistory('<?php echo $booking['id']; ?>','<?php echo $val_id ?>');"><i class="bi bi-trash-fill"></i> Delete</button>
                                        </div>

                                    <?php
                                    }
                                    ?>


                                    <?php
                                } else {



                                    if ($date < $booking["booking_date"]) {
                                    ?>
                                        <div class="col-4 d-grid">
                                            <button class="btn btn-warning rounded mt-5 fs-6" onclick="cancelbooking('<?php echo $booking['id']; ?>','<?php echo $val_id ?>');"><i style="-webkit-text-stroke-width: 3.7px; " class="bi bi-x-lg"></i> cancel</button>
                                        </div>

                                        <div class="col-1 d-grid">
                                            <button class="btn btn-danger rounded mt-5 fs-5" onclick="deleteFromPHistory('<?php echo $booking['id']; ?>','<?php echo $val_id ?>');"><i class="bi bi-trash-fill"></i></button>
                                        </div>

                                    <?php
                                    } else {
                                    ?>

                                        <div class="col-6 d-grid">
                                            <button class="btn btn-danger rounded mt-5 fs-5" onclick="deleteFromPHistory('<?php echo $booking['id']; ?>','<?php echo $val_id ?>');"><i class="bi bi-trash-fill"></i> Delete</button>
                                        </div>

                                    <?php
                                    }
                                    ?>


                                <?php
                                }

                                ?>





                                <!-- <div class="col-1 d-grid">
                        <button class="btn btn-danger rounded mt-5 fs-5" onclick="deleteFromPHistory('<?php echo $data['id']; ?>','<?php echo $val_id ?>');"><i class="bi bi-trash-fill"></i></button>
                    </div> -->


                                <div class="col-12">
                                    <hr style="border-style: solid;border-width: 2px;border-color: rgb(0, 0, 0);">
                                </div>



                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>


<?php
    }
}

?>