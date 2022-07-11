<?php

require "./functionality/session.php";

HTTP_error_handling();

$conn->prepare("DELETE FROM contacts WHERE id = :id")->execute([":id" => $id]);

$_SESSION["flash"] = [
  "message" => "Contact {$contact['name']} deleted.",
  "color" => "danger"
];

header("Location: home.php");
