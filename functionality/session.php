<?php
require "./functionality/database.php";

session_start();

//Redirect
if(!isset($_SESSION["user"])) {
    header("Location: login.php");
    return;
}

function HTTP_error_handling(){
    global $conn;

    $id = $_GET["id"];

    $statement = $conn->prepare("SELECT * FROM contacts WHERE id = :id LIMIT 1");
    $statement->execute([":id" => $id]);

    if ($statement->rowCount() == 0) {
        http_response_code(404);
        echo("HTTP 404 NOT FOUND");
        return;
    }

    $contact = $statement->fetch(PDO::FETCH_ASSOC);

    if ($contact["user_id"] !== $_SESSION["user"]["id"]) {
        http_response_code(403);
        echo("HTTP 403 UNAUTHORIZED");
        die();
    }

}