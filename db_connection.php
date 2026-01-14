<?php
// db_connection.php
$host = 'localhost';
$dbname = 'octalgo_db';
$username = 'root'; // Change to your DB username
$password = '';     // Change to your DB password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>