<?php
include 'databaseConnect.php';

// Enable error reporting for debugging (optional)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmPassword = $_POST["confirm_password"];
  $role = $_POST["role"];

  // Check if passwords match
  if ($password !== $confirmPassword) {
    echo "Passwords do not match.";
    exit;
  }

  // Hash the password
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Prepare the SQL statement
  $sql = "INSERT INTO users (fullName, email, password, role) VALUES (?, ?, ?, ?)";
  if ($stmt = $connection->prepare($sql)) {
    $stmt->bind_param("ssss", $name, $email, $hashedPassword, $role);

    // Execute the statement
    if ($stmt->execute()) {
      // Redirect after successful registration
      header("Location: loginPage.php");
      exit;
    } else {
      // Log error for debugging purposes (optional)
      error_log("Error: " . $stmt->error);
      echo "Registration failed. Please try again.";
    }

    $stmt->close();
  } else {
    // Log error if statement preparation fails (optional)
    error_log("Error: " . $connection->error);
    echo "Registration failed. Please try again.";
  }

  $connection->close();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Page</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/signup.css">
  </head>
  <body>
    <div class="logo" onclick="window.location.href ='index.php'">TaskMission</div>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div>
            <div class="registration-form">
              <h2 class="text-center">Inscription</h2>
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mb-3">
                  <label for="inputName" class="form-label">Nom complet</label>
                  <input type="text" class="form-control" id="inputName" name="name" required>
                </div>
                <div class="mb-3">
                  <label for="inputEmail" class="form-label">Adresse Email</label>
                  <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" name="email" required>
                  <div id="emailHelp" class="form-text">Nous ne partagerons jamais votre email avec qui que ce soit.</div>
                </div>
                <div class="mb-3">
                  <label for="inputPassword" class="form-label">Mot de passe</label>
                  <input type="password" class="form-control" id="inputPassword" name="password" required>
                </div>
                <div class="mb-3">
                  <label for="inputConfirmPassword" class="form-label">Confirmer le mot de passe</label>
                  <input type="password" class="form-control" id="inputConfirmPassword" name="confirm_password" required>
                </div>
                <div class="mb-3">
                  <label for="inputRole" class="form-label">Rôle</label>
                  <select class="form-select" id="inputRole" name="role" required>
                    <option value="" selected disabled>Choisissez un rôle</option>
                    <option value="user">Utilisateur</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-dark">S'inscrire</button>
              </form>

              <div class="mt-3 text-center">
                <p>Déjà inscrit ? <a href="loginPage.php">Se connecter</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Add Bootstrap JavaScript (optional, but recommended for certain components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
