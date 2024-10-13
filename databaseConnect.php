<?php
// databaseConnect.php

$servername = "localhost";  // Replace with your server name
$username = "root";  // Replace with your database username
$password = "";  // Replace with your database password
$dbname = "TP0web";  // Replace with your database name

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>

