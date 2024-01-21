<?php

session_start();
require "connection.php";

$val = $_GET["Cid"];




$user_rs = Database::search("SELECT * FROM `users` WHERE `user_type_id` = '" . $val . "'");
$user_rsn = $user_rs->num_rows;
?>

<tr>
    <th>Name</th>
    <th style="width: 15%;">Seller Email</th>
    <th>Profile</th>
    <th>Payed</th>
    <th>block</th>
</tr>

<?php

if ($user_rsn > 0) {
    for ($i = 0; $i < $user_rsn; $i++) {
        $data = $user_rs->fetch_assoc();

        $image_rsn = 0;

        if ($val == "2") {
            // $product_rs = Database::search("SELECT * FROM `packages` WHERE `seller_email` = '" . $data["email"] . "'");

            // $product_data = $product_rs->fetch_assoc();

            $image_rs = Database::search("SELECT `hotels`.`pay_id`,`hotels`.`name`,`hotels`.`id`,`hotels`.`status` FROM `hotels`  WHERE `hotels`.`seller_email` = '" . $data["email"] . "'  ");

            $image_rsn = $image_rs->num_rows;
        } elseif ($val == "3") {

            // $product_rs = Database::search("SELECT * FROM `dj_package` WHERE `seller_email` = '" . $data["email"] . "'");

            // $product_data = $product_rs->fetch_assoc();

            $image_rs = Database::search("SELECT `dj`.`pay_id`,`dj`.`name`,`dj`.`company_name`,`dj`.`id`,`dj`.`status` FROM `dj` WHERE `dj`.`seller_email` = '" . $data["email"] . "' ");

            $image_rsn = $image_rs->num_rows;
        } elseif ($val == "4") {

            // $product_rs = Database::search("SELECT * FROM `photography_package` WHERE `seller_email` = '" . $data["email"] . "'");

            // $product_data = $product_rs->fetch_assoc();

            $image_rs = Database::search("SELECT `photography`.`pay_id`,`photography`.`name`,`photography`.`company_name`,`photography`.`id`,`photography`.`status` FROM `photography` WHERE `photography`.`seller_email` = '" . $data["email"] . "' ");

            $image_rsn = $image_rs->num_rows;
        } elseif ($val == "5") {
            // $product_rs = Database::search("SELECT * FROM `packages` WHERE `id` = '" . $data["packag_id"] . "'");


            // $product_data = $product_rs->fetch_assoc();

            $image_rs = Database::search("SELECT  `vehicles`.`pay_id`,`vehicles_details`.`model`,`vehicles_details`.`company_id`,`vehicles_details`.`name`,`vehicles`.`company_name`,`vehicles_details`.`status`,`vehicles_details`.`id` FROM `vehicles_details` INNER JOIN `vehicles` ON `vehicles`.`id` = `vehicles_details`.`company_id` WHERE `vehicles`.`seller_email` = '" . $data["email"] . "'  ");


            $image_rsn = $image_rs->num_rows;
        }

        for ($k = 0; $k < $image_rsn; $k++) {
            $image_data = $image_rs->fetch_assoc();

?>
            <tr>
                <?php
                if ($val == 5) {
                ?>
                    <td><?php echo $image_data["name"] . " - " .  $image_data["model"] ?></td>
                <?php
                } else {
                ?>
                    <td><?php echo $image_data["name"] ?></td>
                <?php
                }
                ?>
                <td><?php echo $data["email"] ?></td>
                <td style="text-align: center;" class="view-td"><button onclick="profile('<?php echo $image_data['id'] ?>','<?php echo $val ?>')" class="view-btn">View</button></td>
                <?php
                $timeid = $image_data["pay_id"];
                if ($timeid == 1) {
                ?>
                    <td style="text-align: center;" class="prof-payed-td">Yes</td>
                <?php
                } else {
                ?>
                    <td style="text-align: center;" class="prof-payed-td">No</td>
                <?php
                }
                ?>

                <td><button id="btn<?php echo $image_data["id"] ?>" onclick="profileBlock('<?php echo $image_data['id']; ?>','<?php echo $val; ?>');" class="block-btn <?php
                                                                                                                                                                        if ($image_data["status"] == "0") {
                                                                                                                                                                        ?>
                                                                                                                                                                           block

                                                                                                                                                                           <?php
                                                                                                                                                                        } else if ($image_data["status"] == "1") {
                                                                                                                                                                            ?>
                                                                                                                                                                               unblock
                                                                                                                                                                           <?php
                                                                                                                                                                        }
                                                                                                                                                                            ?>"><?php
                                                                                                                                                                                if ($image_data["status"] == "0") {
                                                                                                                                                                                    echo "Block";
                                                                                                                                                                                } else if ($image_data["status"] == "1") {
                                                                                                                                                                                    echo "unblock";
                                                                                                                                                                                }
                                                                                                                                                                                ?></button></td>

            </tr>
    <?php
        }
    }
} else {
    ?>

    <tr>
        <td>No Data</td>
        <td>No Data</td>
        <td>No Data</td>
        <td>No Data</td>
        <td>No Data</td>
        <!-- <td>abc@gmail.com</td>
        <td class="view-td"><button class="view-btn">View</button></td>
        <td class="prof-payed-td">Yes</td>
        <td><button class="block-btn">Block</button></td> -->
    </tr>


<?php
}
?>