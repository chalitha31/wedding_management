<?php

session_start();

if (isset($_SESSION["user_fname"])) {

    $_SESSION["user_fname"] = null;
    $_SESSION["user_lname"] = null;
    $_SESSION["user_email"] = null;


    session_destroy();

    echo "success";
}
