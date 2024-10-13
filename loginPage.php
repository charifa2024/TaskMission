<?php
// Configurer la session
ini_set('session.gc_maxlifetime', 3600); // 1 heure de durée de session
// Démarrer la session
session_start();

// Inclure la connexion à la base de données
include 'databaseConnect.php';

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    // Rediriger l'utilisateur connecté vers son tableau de bord
    header('Location: index.php');
    exit();
}

// Variable pour stocker le message d'erreur
$error = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sécuriser l'email avec mysqli_real_escape_string
    $email = mysqli_real_escape_string($connection, $email);

    // Requête pour chercher l'utilisateur
    $sql = "SELECT * FROM users WHERE email = ? and state='active'";
    if ($stmt = $connection->prepare($sql)) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Vérification du mot de passe
            if (password_verify($password, $user['password'])) {
                // Régénérer l'ID de session pour éviter le vol de session
                session_regenerate_id(true);

                // Stocker les infos de l'utilisateur dans la session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                // Redirection vers le tableau de bord
                header('Location: index.php');
                exit();
            } else {
                $error = "Mot de passe incorrect.";
            }
        } else {
            $error = "Utilisateur non trouvé.";
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/loginPage.css">
  </head>
  <body>
    <div class="logo" onclick="window.location.href ='index.php'">TaskMission</div>
    <div class="login-form">
      <h2>Connexion</h2>
      <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
      <?php endif; ?>
      <form method="POST">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Adresse Email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
        </div>
        <button type="submit" class="btn btn-dark">Connecter</button>
      </form>
      <div class="mt-3 text-center">
        <p>Pas encore de compte ? <a href="signupPage.php">S'inscrire</a></p>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
