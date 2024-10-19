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

include '../databaseConnect.php';

// Initialize variables
$title = $description = $priority = $error = $success = "";

// Generate a CSRF token if it doesn't exist
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Check for POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verify CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Invalid CSRF token");
    }

    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $priority = $_POST["priority"];

    // Validate inputs
    if (empty($title) || empty($description) || empty($priority)) {
        $error = "Veuillez remplir tous les champs";
    } else {
        $stmt = $connection->prepare("INSERT INTO tasks (name, description, user_id, priority) VALUES (?, ?, ?, ?)");
        $user_id = $_SESSION['user_id']; // ID de l'utilisateur connecté
        $stmt->bind_param("ssis", $title, $description, $user_id, $priority);

        if ($stmt->execute()) {
            $success = "La tâche a été créée avec succès";

            // Enregistrement de l'opération
            $operationDescription = 'Création d\'une tâche';
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
            $error = "Erreur lors de l'insertion de la tâche dans la base de données: " . $stmt->error;
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
  <h1 class="text-center mb-4">Créer une nouvelle Tâche</h1>
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
    <div class="form-group">
      <label for="Title" style="margin: 10px 10px;">Titre</label>
      <input type="text" class="form-control" placeholder="Entrer le titre" name="title" value="<?php echo htmlspecialchars($title); ?>">
    </div>
    <div class="form-group">
      <label for="description" style="margin: 10px 10px;">Description</label>
      <textarea class="form-control" placeholder="Entrer la description" name="description"><?php echo htmlspecialchars($description); ?></textarea>
    </div>
    <div class="form-group" style="margin: 10px 10px;">
      <label for="exampleFormControlSelect1">Saisir la Priorité</label>
      <select class="form-control" id="exampleFormControlSelect1" name="priority">
        <option value="primary" <?php if ($priority == "primaire") echo 'selected'; ?>>Primaire</option>
        <option value="secondary" <?php if ($priority == "secondaire") echo 'selected'; ?>>Secondaire</option>
        <option value="third" <?php if ($priority == "tertiaire") echo 'selected'; ?>>Tertiaire</option>
      </select>
    </div>

    <div style="display:flex; justify-content:center; align-items:center;">
      <button type="submit" class="btn btn-success m-2" style="font-size: 1.5em;">Créer</button>
      <button type="button" class="btn btn-danger m-2" style="font-size: 1.5em;" onclick="window.location.href='../tasks.php'">Annuler</button>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
