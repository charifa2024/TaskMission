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
include 'databaseConnect.php';
$sql = "SELECT * FROM users WHERE role = 'user' AND state = 'desactive'";
$result = $connection->query($sql);
$signupRequests = $result->fetch_all(MYSQLI_ASSOC);
$connection->close();
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des demandes d'inscriptions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/signupRequest.css">
  </head>
  <body>
  <?php include 'navbar.php'; ?>
    <div class="container page_title">
  <h1 class="text-center mb-4">Gestion des demandes d'inscriptions</h1>
  </div>
  <div class="container table-responsive" style="margin-bottom: 5rem;">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Email</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($signupRequests as $request) {
      echo "<tr>";
      echo "<td>" . $request['email'] . "</td>";
      echo "<td>";
      echo "<a href='signup_op/signupRequestView.php?email=" . $request['email'] . "' class='btn btn-info me-1'>Info</a>";
      echo "<form action='signup_op/signupRequestAccept.php' method='post' style='display:inline;'>";
      echo "<input type='hidden' name='email' value='" . $request['email'] . "'>";
      echo "<button type='submit' class='btn btn-success me-1'>Accepter</button>";
      echo "</form>";
      echo "<form action='signup_op/signupRequestReject.php' method='post' style='display:inline;'>";
      echo "<input type='hidden' name='email' value='" . $request['email'] . "'>";
      echo "<button type='submit' class='btn btn-danger'>Refuser</button>";
      echo "</form>";
      echo "</td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
