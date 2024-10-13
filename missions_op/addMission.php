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
?>
<?php
include '../databaseConnect.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize variables
$title = $description = $error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);

    if (empty($title) || empty($description)) {
        $error = "Veuillez remplir tous les champs";
    } else {
        $stmt = $connection->prepare("INSERT INTO missions (name, description, user_id) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die("Erreur de préparation: " . $connection->error);
        }
        
        $user_id = $_SESSION['user_id']; // Fixed user_id for development purposes
        if (!$stmt->bind_param("ssi", $title, $description, $user_id)) {
            die("Erreur de liaison des paramètres: " . $stmt->error);
        }

        if ($stmt->execute()) {
            $success = "La mission a été créée avec succès";
            // Redirect using PHP header
            $operationDescription = 'Création d\'une mission';
            $sql = "INSERT INTO operations (user_id, operation) VALUES (?, ?)";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("is", $_SESSION['user_id'], $operationDescription);
        
        if ($stmt->execute()) {
            echo "Opération enregistrée avec succès";
        } else {
            echo "Erreur lors de l'enregistrement de l'opération: " . $conn->error;
        }
        
            header("Location: ../missions.php");
            exit();
        } else {
            $error = "Erreur lors de l'insertion dans la base de données: " . $stmt->error;
        }
        $stmt->close();
    }

$stmt->close();
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
  <h1 class="text-center mb-4">Ajouter une mission</h1>
  </div>
  <?php if (!empty($error)): ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Erreur !</strong> <?php echo htmlspecialchars($error); ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>
  <div style="display:flex;justify-content:center;align-items:center;flex-direction:column;">
  <form  style="width:50%;" method="post">
  <div class="form-group">
    <label for="Title"style="margin: 10px 10px;">Titre</label>
    <input type="text" class="form-control" placeholder="Entrer le titre" name="title"<?php echo htmlspecialchars($title); ?>>
  </div>
  <div class="form-group">
    <label for="description" style="margin: 10px 10px;" >Description</label>
    <textarea class="form-control" placeholder="Entrer la description"name="description"><?php echo htmlspecialchars($description); ?></textarea>
   </div>
  <div style="display:flex;justify-content:center;align-items:center;">
  <button type="submit" class="btn btn-success m-2" style="font-size: 1.5em;" >Ajouter</button>
  <button type="button" class="btn btn-danger m-2" style="font-size: 1.5em;" onclick="window.location.href='../missions.php'" >Annuler</button>
  </div>
</form>
</div>

</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
