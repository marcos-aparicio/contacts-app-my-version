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

function isContactValidated(){
            
    if (empty($_POST["name"]) || empty($_POST["phone_number"])) {

        $_SESSION["error"]["explanation"] = "Please fill all the fields.";
        $_SESSION["error"]["saved_name"] = $_POST["name"];
        $_SESSION["error"]["saved_phone_number"] = $_POST["phone_number"];

        $_SESSION["error"]["type"] = empty($_POST["name"])? 1:2;
        return;  
    } 
    else if (strlen($_POST["phone_number"]) < 9) {
        $_SESSION["error"]["explanation"] = "Phone number must be at least 9 characters.";
        $_SESSION["error"]["saved_name"] = $_POST["name"];
        $_SESSION["error"]["saved_phone_number"] = "";
        $_SESSION["error"]["type"] = 2;
        return;
    }
    return true;
}

