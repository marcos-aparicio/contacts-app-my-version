<?php
require "./functionality/database.php";

session_start();

//Redirect
if(!isset($_SESSION["user"])) {
    header("Location: login.php");
    return;
}

