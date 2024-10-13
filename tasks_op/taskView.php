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
$id = $_GET['id'];
$sql = "SELECT * FROM tasks WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$task = $result->fetch_assoc();
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
  <h1 class="text-center mb-4">Les Informations d'une Tâche</h1>
  </div>
  <div class="container mt-4"style="margin-bottom: 5rem;">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-dark text-white">
          <h3 class="mb-0">Informations</h3>
        </div>
        <div class="card-body">
        <div class="card-body">
        <dl class="row">
  <dt class="col-sm-4">Le Titre :</dt>
  <dd class="col-sm-8"><?php echo htmlspecialchars($task['name']); ?></dd>
  <dt class="col-sm-4">La description :</dt>
  <dd class="col-sm-8"><?php echo htmlspecialchars($task['description']); ?></dd>
  <dt class="col-sm-4">La priorité :</dt>
  <dd class="col-sm-8">
    <?php
      switch($task['priority']) {
        case 'primary':
          echo 'primaire';
          break;
        case 'secondary':
          echo 'secondaire';
          break;
        case 'third':
          echo 'tertiaire';
          break;
        default:
          echo htmlspecialchars($task['priority']);
      }
    ?>
  </dd>
  <dt class="col-sm-4">Statut :</dt>
  <dd class="col-sm-8"><?php echo htmlspecialchars($task['status']); ?></dd>
  <?php if (!is_null($task['notes']) && $task['notes'] !== ''): ?>
    <dt class="col-sm-4">Résultat :</dt>
    <dd class="col-sm-8"><?php echo htmlspecialchars($task['notes']); ?></dd>
  <?php endif; ?>
  <?php if (!is_null($task['mission_id']) && $task['mission_id'] !== ''): ?>
    <dt class="col-sm-4">Le titre de mission :</dt>
    <dd class="col-sm-8"><?php echo htmlspecialchars($task['mission_id']); ?></dd>
  <?php endif; ?>
</dl>

  <div class="text-center mt-4">
    <a href="../tasks.php" class="btn btn-dark">Retourner au Tableau</a>
  </div>
</div>
        </div>
      </div>
    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
