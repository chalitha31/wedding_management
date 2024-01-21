<?php

session_start();

if (isset($_SESSION["admin_email"])) {



    $_SESSION["admin_email"] = null;
    $_SESSION["admintype"] = null;


    session_destroy();

    echo "success";
}
