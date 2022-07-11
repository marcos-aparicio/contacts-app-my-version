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

function POST_edit_contact(){
    global $conn;
    
    $statement = $conn->prepare("SELECT * FROM contacts WHERE id = :id LIMIT 1");
    $statement->execute([":id" => $_GET["id"]]);
    $contact = $statement->fetch(PDO::FETCH_ASSOC);


    $_SESSION["error"]["saved_name"] = $contact["name"];
    $_SESSION["error"]["saved_phone_number"] = $contact["phone_number"];
    $_SESSION["error"]["explanation"] = "";
    $_SESSION["error"]["type"] = null;

    if($_SERVER["REQUEST_METHOD"] != "POST") return;
            
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

    $statement = $conn->prepare("UPDATE contacts SET name = :name, phone_number = :phone_number WHERE id = :id");

    $statement->execute([
        ":id" => $_GET["id"],
        ":name" => $_POST["name"],
        ":phone_number" => $_POST["phone_number"],
    ]);

    $_SESSION["flash"] = [
        "message" => "Contact {$_POST['name']} updated.",
        "color" => "info"
    ];

    header("Location: home.php");
    die();   
}

function POST_add_contact(){
    global $conn;
    
    $_SESSION["error"]["saved_name"] = "";
    $_SESSION["error"]["saved_phone_number"] = "";
    $_SESSION["error"]["explanation"] = "";
    $_SESSION["error"]["type"] = 1;

    if($_SERVER["REQUEST_METHOD"] != "POST") return;
            
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

    
    $statement = $conn->prepare("INSERT INTO contacts (user_id, name, phone_number) VALUES (:id, :name, :phone_number)");
    
    $statement->execute([
        ":id" => $_SESSION["user"]["id"],
        ":name" => $_POST["name"],
        ":phone_number" => $_POST["phone_number"],
    ]);

    $_SESSION["flash"] = [
        "message" => "Contact {$_POST['name']} added.",
        "color" => "success"
    ];

    header("Location: home.php");
    die();   
}

