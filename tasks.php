<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de login si l'utilisateur n'est pas connecté
    header('Location: loginPage.php');
    exit();
}

// Vérifier le rôle de l'utilisateur
if ($_SESSION['role'] !== 'user') {
    // Rediriger si le rôle n'est pas 'user'
    header('Location: index.php'); // Page d'erreur ou redirection appropriée
    exit();
}

include 'databaseConnect.php';

// Vérifier si le formulaire a été soumis
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $taskId = $_POST['task_id'] ?? null; // Default to null if not set
    $recipientId = $_POST['sendTask'] ?? null; // Default to null if not set
    $rights = $_POST['droits'] ?? null; // Default to null if not set

    // Check for required fields
    if ($taskId === null || $recipientId === null || $rights === null) {
        die("Invalid input: task ID, recipient ID, or rights not provided.");
    }

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO shared_tasks (task_id, user_partage_id, droit) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($sql);
    if (!$stmt) {
        die("SQL statement preparation failed: " . $connection->error);
    }

    // Bind parameters and execute
    $stmt->bind_param("iis", $taskId, $recipientId, $rights);
    if ($stmt->execute()) {
        header('Location: tasks.php');
        exit();
    } else {
        die("Database error: " . $stmt->error);
    }
}

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des tâches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/signupRequest.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container page_title">
        <h1 class="text-center mb-4">Les Tâches créées</h1>
    </div>
    <div class="container table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Titre</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Priorité</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'databaseConnect.php';

                // Sélectionner les utilisateurs actifs
                $sql = "SELECT * FROM users WHERE role = 'user' AND state = 'active'";
                $user_result = $connection->query($sql);

                // Sélectionner les tâches de l'utilisateur connecté
                $sql = "SELECT * FROM tasks WHERE user_id = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("i", $_SESSION['user_id']);
                $stmt->execute();
                $result = $stmt->get_result();

                if(!$result || !$user_result) {
                    die("Invalid query: " . $connection->error);
                }

                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td scope='row'>{$row['name']}</td>
                        <td scope='row'>{$row['status']}</td>
                        <td scope='row'>" . 
                        (function($priority) {
                            switch($priority) {
                                case 'primary':
                                    return 'Primaire';
                                case 'secondary':
                                    return 'Secondaire';
                                case 'third':
                                    return 'Tertiaire';
                                default:
                                    return $priority;
                            }
                        })($row['priority']) . "
                        </td>
                        <td style='display:flex;justify-content:center;align-items:center;'>
                            <a href='tasks_op/taskView.php?id={$row['id']}'><button type='button' class='btn btn-info me-1'>Info</button></a>
                            <a href='tasks_op/modifyTask.php?id={$row['id']}'><button type='button' class='btn btn-warning me-1'>Modifier</button></a>
                            <button type='button' class='btn btn-success me-1' onclick='showShareForm({$row['id']})'>Partager</button>
                            " . ($row['status'] == 'en cours' ? "<button type='button' class='btn btn-primary me-1' onclick='completeTask({$row['id']})'>Terminer</button>" : "") . "
                        </td>
                    </tr>
                    <tr class='share-task-row' id='share-form-{$row['id']}' style='display: none;'>
                        <td colspan='4'>
                            <form method='post' action='tasks.php' class='mt-3'>
                                <input type='hidden' name='task_id' value='{$row['id']}'>
                                <div class='mb-3'>
                                    <label for='sendTask-{$row['id']}' class='form-label'>Sélectionner un destinataire</label>
                                    <select name='sendTask' id='sendTask-{$row['id']}' class='form-select'>
                                        <option value='' selected disabled>Choisir un utilisateur</option>";
                                        $user_result->data_seek(0); // Reset user result pointer
                                        while($user = $user_result->fetch_assoc()) {
                                            echo "<option value='{$user['id']}'>{$user['fullName']}</option>";
                                        }
                    echo "  </select>
                                    <label for='droits' class='form-label'>Sélectionner les privilèges</label>
                                    <select name='droits' class='form-select'>
                                        <option value='view'>consultation</option>
                                        <option value='update'>modification</option>
                                    </select>
                                </div>
                                <div class='d-flex justify-content-end'>
                                    <button type='submit' class='btn btn-success me-2'>Envoyer</button>
                                    <button type='button' class='btn btn-secondary' onclick='hideShareForm({$row['id']})'>Annuler</button>
                                </div>
                            </form>
                        </td>
                    </tr>";
                }

                // Close the statement
                $stmt->close();
                ?>
            </tbody>
        </table>
    </div>
    <div style="display:flex;justify-content:center;align-items:center;">
        <button type="button" class="btn btn-secondary btn-lg btn-block" onclick="window.location.href='tasks_op/addTask.php'">Ajouter une tâche</button>
    </div>

    <div class="container page_title">
        <h1 class="text-center mb-4">Les Tâches Partagées avec vous</h1>
    </div>
    <div class="container table-responsive" style="margin-bottom: 5rem;">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Titre</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Priorité</th>
                    <th scope="col">Expéditeur</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
include 'databaseConnect.php';

// Adjust the SQL query to join with the tasks table to get the sender
$sql = "SELECT tasks.*, sender.fullName AS senderName, shared_tasks.droit FROM shared_tasks 
JOIN tasks ON shared_tasks.task_id = tasks.id 
JOIN users AS sender ON tasks.user_id = sender.id 
WHERE shared_tasks.user_partage_id = ?";

$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$shared_tasks_result = $stmt->get_result();

while ($shared_row = $shared_tasks_result->fetch_assoc()) {
    echo "<tr>
        <td scope='row'>{$shared_row['name']}</td>
        <td scope='row'>{$shared_row['status']}</td>
        <td scope='row'>" . 
            (function($priority) {
                switch($priority) {
                    case 'primary':
                        return 'Primaire';
                    case 'secondary':
                        return 'Secondaire';
                    case 'third':
                        return 'Tertiaire';
                    default:
                        return $priority;
                }
            })($shared_row['priority']) . "
        </td>
        <td scope='row'>{$shared_row['senderName']}</td> <!-- Use senderName instead of fullName -->
        <td style='display:flex;justify-content:center;align-items:center;'>";
        
    // Show the Modify button only if the droit is 'update'
    if ($shared_row['droit'] == 'update') {
        echo "<a href='tasks_op/modifyTask.php?id={$shared_row['id']}'><button type='button' class='btn btn-warning me-1'>Modifier</button></a>";
    }

    echo "<a href='tasks_op/taskView.php?id={$shared_row['id']}'><button type='button' class='btn btn-info me-1'>Info</button></a>
        </td>
      </tr>";
}
?>


            </tbody>
        </table>
    </div>

    <script>
        function showShareForm(taskId) {
            document.getElementById('share-form-' + taskId).style.display = 'table-row';
        }

        function hideShareForm(taskId) {
            document.getElementById('share-form-' + taskId).style.display = 'none';
        }

        function completeTask(taskId) {
            if (confirm('Êtes-vous sûr de vouloir marquer cette tâche comme terminée?')) {
                window.location.href = 'tasks_op/completeTask.php?id=' + taskId;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
