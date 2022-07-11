<?php
require "./functionality/database.php";

session_start();

//Redirect
if(!isset($_SESSION["user"])) {
    header("Location: login.php");
    return;
}


function HTTP_error_handling($statement,$object_array){


    if ($statement->rowCount() == 0) {
        http_response_code(404);
        echo("HTTP 404 NOT FOUND");
        die();
    }


    if ($object_array["user_id"] !== $_SESSION["user"]["id"]) {
        http_response_code(403);
        echo("HTTP 403 UNAUTHORIZED");
        die();
    }
}