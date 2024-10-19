<?php
session_start();

// Generate CSRF token if not set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generate a random token
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: loginPage.php');
    exit();
}

// Vérifier le rôle de l'utilisateur
if ($_SESSION['role'] !== 'user') {
    header('Location: index.php'); // Redirection appropriée pour les utilisateurs non autorisés
    exit();
}

include '../databaseConnect.php';

$id = (int)$_GET['id']; // Valider l'ID de mission

// Préparer et exécuter la requête pour récupérer les données de la mission
$stmt = $connection->prepare("SELECT name, description FROM missions WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$mission = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Initialiser les variables avec les données récupérées
$title = htmlspecialchars($mission['name']);
$description = htmlspecialchars($mission['description']);

$error = $success = "";

// Traitement du formulaire de soumission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Erreur CSRF : le token est invalide.");
    }

    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);

    // Validation des champs
    if (empty($title) || empty($description)) {
        $error = "Veuillez remplir tous les champs";
    } else {
        // Préparer et exécuter la requête de mise à jour
        $stmt = $connection->prepare("UPDATE missions SET name = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $title, $description, $id);

        if ($stmt->execute()) {
            $success = "La mission a été modifiée avec succès";

            // Enregistrement de l'opération
            $operationDescription = 'Modification d\'une mission';
            $sql = "INSERT INTO operations (user_id, operation) VALUES (?, ?)";
            $stmtOp = $connection->prepare($sql);
            $stmtOp->bind_param("is", $_SESSION['user_id'], $operationDescription);

            if ($stmtOp->execute()) {
                header("Location: ../missions.php");
                exit();
            } else {
                $error = "Erreur lors de l'enregistrement de l'opération: " . $stmtOp->error;
            }
            $stmtOp->close();
        } else {
            $error = "Erreur lors de la mise à jour de la mission: " . $stmt->error;
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
    <title>Gestion des missions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/signupRequest.css">
</head>
<body>
    <?php include '../navbar.php'; ?>

    <div class="container page_title">
        <h1 class="text-center mb-4">Modifier une mission</h1>
    </div>

    <?php if (!empty($error)): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Erreur !</strong> <?php echo $error; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="d-flex justify-content-center align-items-center flex-column">
        <form style="width:50%;" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>"> <!-- Hidden CSRF Token -->
            <div class="form-group mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" name="title" placeholder="Entrer le titre" value="<?php echo $title; ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" placeholder="Entrer la description" rows="3" required><?php echo $description; ?></textarea>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success m-2" style="font-size: 1.5em;">Modifier</button>
                <button type="button" class="btn btn-danger m-2" style="font-size: 1.5em;" onclick="window.location.href='../missions.php'">Annuler</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
