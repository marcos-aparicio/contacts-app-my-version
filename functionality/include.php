<?php

//Redirect
if(!isset($_SESSION["user"])) {
    header("Location: login.php");
    return;
}

