<?php

$host = getenv('DB_HOST') ?? 'localhost';
$database = getenv('DB_DATABASE') ?? 'contacts_app';
$user = getenv('DB_USERNAME') ?? 'root';
$password = getenv('DB_PASSWORD') ?? '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
} catch (PDOException $e) {
    die('PDO Connection Error: ' . $e->getMessage());
}
