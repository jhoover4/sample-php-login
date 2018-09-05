<?php

$servername = getenv('DB_HOST');
$port = getenv('DB_PORT');
$username = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$dbName = getenv('DB_NAME');

$dsn = "mysql:host={$servername};port={$port};dbname={$dbName}";

try {
    $db = new PDO($dsn, $username, $password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}