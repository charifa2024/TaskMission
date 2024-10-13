
<?php
include '../databaseConnect.php';

if (isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];
    
    $sql = "UPDATE tasks SET mission_id = NULL WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $task_id);
    
    if ($stmt->execute()) {
        // Task successfully removed from mission
        header("Location: missionView.php?id=" . $_POST['mission_id']);
        exit();
    } else {
        // Error handling
        echo "Error updating record: " . $connection->error;
    }
    
    $stmt->close();
}

$connection->close();
?>
