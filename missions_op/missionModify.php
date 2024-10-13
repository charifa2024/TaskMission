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
$id = $_GET['id'];

// Fetch the original mission data
$stmt = $connection->prepare("SELECT name, description FROM missions WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$mission = $result->fetch_assoc();
$stmt->close();

// Initialize variables with the fetched data
$title = $mission['name'];
$description = $mission['description'];

$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);

    if (empty($title) || empty($description)) {
        $error = "Veuillez remplir tous les champs";
    } else {
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
                // Redirection après avoir enregistré l'opération
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
  <strong>Erreur !</strong> <?php echo htmlspecialchars($error); ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>
  <div style="display:flex;justify-content:center;align-items:center;flex-direction:column;">
  <form  style="width:50%;" method="post">
  <div class="form-group">
    <label for="Title"style="margin: 10px 10px;">Titre</label>
    <input type="text" class="form-control" placeholder="Entrer le titre " name="title" value="<?php echo htmlspecialchars($title); ?>" >
  </div>
  <div class="form-group mb-3">
    <label for="description" style="margin: 10px 10px;" >Description</label>
    <textarea class="form-control" placeholder="Entrer la description" name="description" rows="3"><?php echo htmlspecialchars($description); ?></textarea>
   </div>
  <div style="display:flex;justify-content:center;align-items:center;">
  <button type="submit" class="btn btn-success m-2" style="font-size: 1.5em;" >Modifier</button>
  <button type="button" class="btn btn-danger m-2" style="font-size: 1.5em;" onclick="window.location.href='../missions.php'" >Annuler</button>
  </div>
</form>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
