<?php

require "./functionality/session.php";


$statement = $conn->prepare("SELECT * FROM contacts WHERE id = :id LIMIT 1");
$statement->execute([":id" => $_GET["id"]]);
$contact = $statement->fetch(PDO::FETCH_ASSOC);

HTTP_error_handling($statement,$contact);


$conn->prepare("DELETE FROM contacts WHERE id = :id")->execute([":id" => $_GET["id"]]);

$_SESSION["flash"] = [
  "message" => "Contact {$contact['name']} deleted.",
  "color" => "danger"
];

header("Location: home.php");
