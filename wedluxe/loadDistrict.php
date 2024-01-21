<?php

require "connection.php";

if (isset($_GET["p"])) {

    $province_id = $_GET["p"];

    $Dist_rs = Database::search("SELECT * FROM `district` WHERE `province_id` = '" . $province_id . "'");
    $Dist_num = $Dist_rs->num_rows;

    if ($Dist_num > 0) {

?>

        <option value="0">Select District</option>

        <?php

        for ($x = 0; $x < $Dist_num; $x++) {

            $Dist_data = $Dist_rs->fetch_assoc();

        ?>

            <option value="<?php echo $Dist_data["id"]; ?>"><?php echo $Dist_data["name"]; ?></option>

        <?php

        }
    } else {

        ?>

        <option value="0">Select District</option>

        <?php

        $all_Dist = Database::search("SELECT * FROM `district`");
        $all_num = $all_Dist->num_rows;
        for ($y = 0; $y < $all_num; $y++) {
            $all_data = $all_Dist->fetch_assoc();

        ?>

            <option value="<?php echo $all_data["id"]; ?>"><?php echo $all_data["name"]; ?></option>

<?php

        }
    }
}

?>