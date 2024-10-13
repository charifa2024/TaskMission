<?php
include '../databaseConnect.php';

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
    
    $sql = "UPDATE tasks SET status = 'done' WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $taskId);
    
    if ($stmt->execute()) {
        header("Location: ../tasks.php");
    } else {
        echo "Error updating task: " . $connection->error;
    }
    
    $stmt->close();
} else {
    echo "No task ID provided.";
}

$connection->close();
?>
