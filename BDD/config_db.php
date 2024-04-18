<?php
$servername = "localhost:8889";
$username = "root";
$password = "root";
$database = "u213363560_CarStory.sql";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connexion échouée: " . $e->getMessage();
}
