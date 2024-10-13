<?php
include '../databaseConnect.php';
$email = $_POST['email'];
$sql = "DELETE FROM users WHERE email = '$email'";
$result = $connection->query($sql);
$connection->close();
header('Location: ../signupRequest.php');
?>