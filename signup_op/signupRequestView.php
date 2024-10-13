<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de login si l'utilisateur n'est pas connecté
    header('Location: loginPage.php');
    exit();
}

// Vérifier le rôle de l'utilisateur
if ($_SESSION['role'] !== 'admin') {
    // Rediriger si le rôle n'est pas 'user'
    header('Location: index.php'); // Page d'erreur ou redirection appropriée
    exit();
}
?>
<?php 
include '../databaseConnect.php';
$email = $_GET['email'];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $connection->query($sql);
$user = $result->fetch_assoc();
$connection->close();
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des demandes d'inscriptions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/signupRequest.css">
  </head>
  <body>
  <?php include '../navbar.php'; ?>
    <div class="container page_title">
  <h1 class="text-center mb-4">Demande d'Inscription</h1>
  </div>
</div>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-dark text-white">
          <h3 class="mb-0">Informations de la Demande</h3>
        </div>
        <div class="card-body">
          <dl class="row">
            <dt class="col-sm-4">Adresse Email :</dt>
            <dd class="col-sm-8"><?php echo htmlspecialchars($user['email']); ?></dd>
            <dt class="col-sm-4">Nom Complet :</dt>
            <dd class="col-sm-8"><?php echo htmlspecialchars($user['fullName']); ?></dd>
          </dl>
          <div class="text-center mt-4">
            <a href="../signupRequest.php" class="btn btn-dark">Retourner au Tableau</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
