<?php

session_start();
require "connection.php";

$val = $_GET["Cid"];


$purchase_rsn = 0;
if ($val == "0") {

    $purchase_rs = Database::search("SELECT * FROM `hotel_booking`    ");


    $purchase_rsn = $purchase_rs->num_rows;
} elseif ($val == "1") {

    $purchase_rs = Database::search("SELECT * FROM `dj_booking`  ");


    $purchase_rsn = $purchase_rs->num_rows;
} elseif ($val == "2") {

    $purchase_rs = Database::search("SELECT * FROM `photography_booking`   ");


    $purchase_rsn = $purchase_rs->num_rows;
} elseif ($val == "3") {

    $purchase_rs = Database::search("SELECT * FROM `vehical_booking`  ");


    $purchase_rsn = $purchase_rs->num_rows;
}
?>

<tr>
    <th>Company Name</th>
    <?php
    if ($val == "3") {
    ?>

        <th class="package-head">vehical & model</th>

    <?php
    } else {

    ?>

        <th class="package-head">Package Name</th>
    <?php
    }
    ?>
    <!-- <th class="package-head">Package Name</th> -->
    <th>Oder Date & Time</th>
    <th>Booked Day</th>

    <?php
    if ($val == "3") {
    ?>

        <th class="extra-head">Days</th>

    <?php
    } else {

    ?>

        <th class="extra-head">Day or Night</th>
    <?php
    }
    ?>

    <th style="width: 20%;">Booked User</th>
</tr>

<?php

if ($purchase_rsn > 0) {
    for ($i = 0; $i < $purchase_rsn; $i++) {
        $data = $purchase_rs->fetch_assoc();

        $image_rsn = 0;

        if ($val == "0") {
            $product_rs = Database::search("SELECT * FROM `packages` WHERE `id` = '" . $data["packag_id"] . "'");

            $product_data = $product_rs->fetch_assoc();

            $image_rs = Database::search("SELECT `hotels`.`name`,`hotels`.`id`,`hotel_img_logo`.`image` FROM `hotels` INNER JOIN `hotel_img_logo` ON `hotels`.`id` = `hotel_img_logo`.`hotel_id` WHERE `hotels`.`id` = '" . $product_data["hotel_id"] . "'  ");

            $image_rsn = $image_rs->num_rows;
        } elseif ($val == "1") {

            $product_rs = Database::search("SELECT * FROM `dj_package` WHERE `id` = '" . $data["packag_id"] . "'");

            $product_data = $product_rs->fetch_assoc();

            $image_rs = Database::search("SELECT `dj`.`name`,`dj`.`company_name`,`dj`.`id`,`dj_img_logo`.`image` FROM `dj` INNER JOIN `dj_img_logo` ON `dj`.`id` = `dj_img_logo`.`dj_id` WHERE `dj`.`id` = '" . $product_data["dj_id"] . "'  ");

            $image_rsn = $image_rs->num_rows;
        } elseif ($val == "2") {

            $product_rs = Database::search("SELECT * FROM `photography_package` WHERE `id` = '" . $data["packag_id"] . "'");

            $product_data = $product_rs->fetch_assoc();

            $image_rs = Database::search("SELECT `photography`.`name`,`photography`.`company_name`,`photography`.`id`,`photography__img_logo`.`image` FROM `photography` INNER JOIN `photography__img_logo` ON `photography`.`id` = `photography__img_logo`.`photography_id` WHERE `photography`.`id` = '" . $product_data["photography_id"] . "'  ");

            $image_rsn = $image_rs->num_rows;
        } elseif ($val == "3") {
            // $product_rs = Database::search("SELECT * FROM `packages` WHERE `id` = '" . $data["packag_id"] . "'");


            // $product_data = $product_rs->fetch_assoc();

            $image_rs = Database::search("SELECT  `vehicles_details`.`model`,`vehicles_details`.`company_id`,`vehicles_details`.`name`,`vehicles`.`company_name`,`vehicles_details`.`id`,`vehicles_img`.`img` FROM `vehicles_details` INNER JOIN `vehicles_img` ON `vehicles_details`.`id` = `vehicles_img`.`vehical_de_id` INNER JOIN `vehicles` ON `vehicles`.`id` = `vehicles_details`.`company_id` WHERE `vehicles_details`.`id` = '" . $data["vehical_detils_id"] . "'  ");


            $image_rsn = $image_rs->num_rows;
        }

        if ($image_rsn >= 1) {
            $image_data = $image_rs->fetch_assoc();
?>
            <tr>
                <?php
                if ($val == 0) {
                ?>
                    <td><?php echo $image_data["name"] ?></td>
                <?php
                } else {
                ?>
                    <td><?php echo $image_data["company_name"] ?></td>
                <?php
                }

                if ($val == 3) {
                ?>
                    <td><?php echo $image_data["name"] . " - " .  $image_data["model"] ?></td>
                <?php
                } else {
                ?>
                    <td><?php echo $product_data["package_type"] ?></td>
                <?php
                }
                ?>

                <td><?php echo $data["order_date"] ?></td>

                <?php
                if ($val == 0) {
                ?>

                    <td><?php echo $data["wedding_date"] ?></td>

                <?php
                } else {
                ?>
                    <td><?php echo $data["booking_date"] ?></td>

                <?php
                }
                ?>


                <?php
                if ($val == 3) {
                ?>

                    <td><?php echo $data["extra_date"] ?></td>

                    <?php
                } else {
                    $timeid = $data["time_id"];
                    if ($timeid == 1) {
                    ?>
                        <td>Day</td>
                    <?php
                    } else {
                    ?>
                        <td>Night</td>
                    <?php
                    }
                    ?>

                <?php
                }
                ?>


                <td><?php echo $data["user_email"] ?></td>


            </tr>
    <?php
        }
    }
} else {
    ?>

    <td>No Boooked Items</td>
    <td>No Boooked Items</td>
    <td>No Boooked Items</td>
    <td>No Boooked Items</td>
    <td>No Boooked Items</td>
    <td>No Boooked Items</td>
<?php
}
?>