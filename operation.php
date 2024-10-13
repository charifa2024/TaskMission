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
    // Rediriger si le rôle n'est pas 'admin'
    header('Location: index.php'); // Page d'erreur ou redirection appropriée
    exit();
}

include 'databaseConnect.php'; // Connexion à la base de données

// Requête pour récupérer toutes les opérations avec les e-mails des utilisateurs
$sql = "SELECT operations.operation, operations.created_at, users.email 
        FROM operations 
        INNER JOIN users ON operations.user_id = users.id
        ORDER BY operations.created_at DESC";
$result = $connection->query($sql);
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Opérations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/signupRequest.css">
  </head>
  <body>
  <?php include 'navbar.php'; ?>
    <div class="container page_title">
        <h1 class="text-center mb-4">Gestion des Opérations effectuées par les utilisateurs</h1>
    </div>
    <div class="container table-responsive" style="margin-bottom: 5rem;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Email</th>
                    <th scope="col">Opération</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Vérifier s'il y a des résultats et afficher les opérations
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['created_at'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['operation'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>Aucune opération trouvée</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
