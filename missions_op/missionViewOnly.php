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
$sql = "SELECT * FROM missions WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$mission = $result->fetch_assoc();
//
$sql = "SELECT * FROM tasks WHERE mission_id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$tasks_mission = $result->fetch_all(MYSQLI_ASSOC);
//
//
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
  <h1 class="text-center mb-4">Les Informations d'une mission</h1>
  </div>
  <div class="container mt-4"style="margin-bottom: 5rem;">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-dark text-white">
          <h3 class="mb-0">Informations</h3>
        </div>
        <div class="card-body">
 
<dl class="row">
    <dt class="col-sm-4">Le Titre :</dt>
    <dd class="col-sm-8"><?php echo htmlspecialchars($mission['name']); ?></dd>
    <dt class="col-sm-4">La description :</dt>
    <dd class="col-sm-8"><?php echo htmlspecialchars($mission['description']); ?></dd>
</dl>
        <div class="container page_title">
  <h1 class="text-center mb-4">Les Tâches appartenant à cette mission</h1>
  </div>
  <div class="container table-responsive">
  <table class="table table-dark table-striped">
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
    foreach ($tasks_mission as $task) {
      echo "<tr>
        <td scope='row'>" . htmlspecialchars($task['name']) . "</td>
        <td scope='row'>" . htmlspecialchars($task['status']) . "</td>
        <td scope='row'>" . (function($priority) {
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
      })($task['priority']) . "</td>
        <td style='display:flex;justify-content:center;align-items:center;'>
        <a href='../tasks_op/taskView.php?id=$task[id]'><button type='button' class='btn btn-info me-1'>Info</button></a>
      </td>
      </tr>";
    }
      ?>
    
  </tbody>
</table>
</div>
          <div class="text-center mt-4">
            <a href="../missions.php" class="btn btn-dark">Retourner au Tableau</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
