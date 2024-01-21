<?php

session_start();
require "connection.php";

$id = $_GET["id"];

$result = Database::search("SELECT * FROM `feedback` WHERE  `id` = '" . $id . "'");
$nrow = $result->num_rows;

if ($nrow == 1) {

    Database::iud("UPDATE `feedback` SET  `status` = '1' WHERE `id` = '" . $id . "'");
    echo "success";
} else {

    echo "error";
}
