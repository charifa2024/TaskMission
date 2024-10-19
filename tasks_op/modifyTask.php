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

// CSRF Token Generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

include '../databaseConnect.php';

// Valider l'ID de tâche
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Vérifier si la tâche appartient à l'utilisateur
$stmt = $connection->prepare("SELECT user_id FROM tasks WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$task = $result->fetch_assoc();
$stmt->close();

// Si la tâche n'existe pas ou ne appartient pas à l'utilisateur, rediriger
if (!$task || $task['user_id'] !== $_SESSION['user_id']) {
    header('Location: index.php'); // Page d'erreur ou redirection appropriée
    exit();
}

// Fetch the original task data
$stmt = $connection->prepare("SELECT name, description, priority, notes FROM tasks WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$task = $result->fetch_assoc();
$stmt->close();

// Initialize variables with the fetched data
$title = $task['name'];
$description = $task['description'];
$notes = $task['notes'];
$priority = $task['priority'];

$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Erreur CSRF - Token invalide");
    }

    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $notes = trim($_POST["notes"]);
    $priority = $_POST["priority"];

    if (empty($title) || empty($description) || empty($priority)) {
        $error = "Veuillez remplir tous les champs";
    } else {
        $stmt = $connection->prepare("UPDATE tasks SET name = ?, description = ?, priority = ?, notes = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $title, $description, $priority, $notes, $id);
        
        if ($stmt->execute()) {
            $success = "La tâche a été mise à jour avec succès";

            // Enregistrement de l'opération
            $operationDescription = 'Modification d\'une tâche';
            $sqlOp = "INSERT INTO operations (user_id, operation) VALUES (?, ?)";
            $stmtOp = $connection->prepare($sqlOp);
            $stmtOp->bind_param("is", $_SESSION['user_id'], $operationDescription);

            if ($stmtOp->execute()) {
                // Rediriger après l'enregistrement de l'opération
                header("Location: ../tasks.php");
                exit();
            } else {
                $error = "Erreur lors de l'enregistrement de l'opération: " . $stmtOp->error;
            }
            $stmtOp->close();
        } else {
            $error = "Erreur lors de la mise à jour de la tâche dans la base de données: " . $stmt->error;
        }
        $stmt->close();
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
    <link rel="stylesheet" href="../css/signupRequest.css">
</head>
<body>
<?php include '../navbar.php'; ?>
<div class="container page_title">
    <h1 class="text-center mb-4">Modifier une Tâche</h1>
</div>

<?php if (!empty($error)): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Erreur !</strong> <?php echo htmlspecialchars($error); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div style="display:flex; justify-content:center; align-items:center; flex-direction:column;">
    <form style="width:50%;" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
        
        <div class="form-group mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" placeholder="Entrer le titre" name="title" value="<?php echo htmlspecialchars($title); ?>">
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" placeholder="Entrer la description" name="description" rows="3"><?php echo htmlspecialchars($description); ?></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="notes" class="form-label">Résultat</label>
            <textarea class="form-control" id="notes" placeholder="Entrer le résultat" name="notes" rows="3"><?php echo htmlspecialchars($notes); ?></textarea>
        </div>

        <div class="form-group mb-4">
            <label for="priority" class="form-label">Priorité</label>
            <select class="form-select" id="priority" name="priority">
                <option value="primary" <?php if ($priority == "primary") echo 'selected'; ?>>Primaire</option>
                <option value="secondary" <?php if ($priority == "secondary") echo 'selected'; ?>>Secondaire</option>
                <option value="third" <?php if ($priority == "third") echo 'selected'; ?>>Tertiaire</option>
            </select>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success m-2" style="font-size: 1.2em;">Modifier</button>
            <button type="button" class="btn btn-danger m-2" style="font-size: 1.2em;" onclick="window.location.href='../tasks.php'">Annuler</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
