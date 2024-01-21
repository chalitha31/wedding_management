<?php
session_start();
require "connection.php";

$sText = $_POST["st"];


$query = "SELECT * FROM `dj` INNER JOIN `dj_img_logo` ON `dj`.`id` = `dj_img_logo`.`dj_id`  ";





if (!empty($sText)) {

    $query .= " WHERE `name` LIKE '%" . $sText . "%' AND  `dj`.`status` = '0'";
} else {

    $query .= " WHERE  `dj`.`status` = '0'";
}


$query1 = $query;



if ("0" != ($_POST["page"])) {

    $pageno = $_POST["page"];
} else {

    $pageno = 1;
}


$products = Database::search($query);
$nProduct = $products->num_rows; //total results
$userProducts = $products->fetch_assoc();

$results_per_page = 6;
$num_of_pages = ceil($nProduct / $results_per_page);

$viewed_results_count = ((int)$pageno - 1) * $results_per_page;
$query1 .= "LIMIT " . $results_per_page . " OFFSET " . $viewed_results_count . " ";
$selectedrs = Database::search($query1);

$srn = $selectedrs->num_rows;

if ($srn > 0) {


    while ($ps = $selectedrs->fetch_assoc()) {

        // for ($x = 0; $x < $srn; $x++) {}

?>

        <div class="dj-item-block" onclick="DjDetails(<?php echo $ps['id'] ?>)">
            <div class="dj-item-image-holder">
                <img class="dj-item-image" src="images/dj/<?php echo $ps["image"] ?>" alt="">
            </div>
            <h3 class="dj-name"><?php echo $ps["name"] ?></h3>
            <div class="dj-company"><i></i><?php echo $ps["company_name"] ?></div>
        </div>

<?php

    }
} else {

    $heading = "NO item Found!";
    echo "<h2>" . $heading . "</h2>";
}
?>



<div class="offset-0 offset-lg-1 col-12 col-lg-12 p-3">
    <div class="row">
        <div class="pagination">
            <a <?php

                if ($pageno <= 1) {

                    echo "#";
                } else {

                ?> onclick="basicSearch('<?php echo ($pageno - 1); ?>');" <?php

                                                                        }

                                                                            ?>>&laquo;</a>

            <?php

            for ($page = 1; $page <= $num_of_pages; $page++) {

                if ($page == $pageno) {

            ?>

                    <a onclick="basicSearch('<?php echo $page; ?>');" class="active"><?php echo $page; ?></a>

                <?php

                } else {

                ?>

                    <a onclick="basicSearch('<?php echo $page; ?>');"><?php echo $page; ?></a>

            <?php

                }
            }

            ?>

            <!-- <a href="#">1</a>
                <a href="#" class="active">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a> -->


            <a <?php

                if ($pageno >= $num_of_pages) {

                    echo "#";
                } else {

                ?> onclick="basicSearch('<?php echo ($pageno + 1); ?>');" <?php

                                                                        }

                                                                            ?>>&raquo;</a>
        </div>
    </div>
</div>

</div>