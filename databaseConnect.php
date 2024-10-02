<?php
$servername = "localhost"; 
$username = "root"; // Add your MySQL username here
$password = ""; // Add your MySQL password here
$dbname = "TP0web";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If you reach this point, the connection is successful
echo "Connected successfully to TP0web database";

// Don't forget to close the connection when you're done using it
// $conn->close();
?>
