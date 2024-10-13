<?php
include '../databaseConnect.php';
$email = $_POST['email'];
$sql = "UPDATE users SET state = 'active' WHERE email = '$email'";
$result = $connection->query($sql);
$connection->close();
header('Location: ../signupRequest.php');
?>