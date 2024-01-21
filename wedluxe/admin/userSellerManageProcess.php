<?php

session_start();
require "connection.php";

$val = $_GET["Cid"];




$user_rs = Database::search("SELECT * FROM `users` WHERE `user_type_id` = '" . $val . "'");
$user_rsn = $user_rs->num_rows;
?>

<tr>
    <th style="width: 20%;">Name</th>
    <th style="width: 55%;">Email</th>
    <th>Register Date</th>
</tr>

<?php

if ($user_rsn > 0) {
    for ($i = 0; $i < $user_rsn; $i++) {
        $data = $user_rs->fetch_assoc();
?>
        <tr>


            <td><?php echo $data["fname"] . " " . $data["lname"] ?></td>
            <td style="text-align: center;"><?php echo $data["email"] ?></td>
            <td style="text-align: center;"><?php echo $data["register_date"] ?></td>


        </tr>
    <?php
    }
} else {
    ?>
    <tr>
        <td>No User</td>
        <td>No User</td>
        <td>No User</td>
    </tr>
<?php
}
?>