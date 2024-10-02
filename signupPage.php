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
  <div class="logo" onclick="window.location.href ='index.php'" >TaskMission</div>
    <div class="registration-form">
      <h2>Inscription</h2>
      <form>
  <div class="mb-3">
    <label for="inputName" class="form-label">Nom complet</label>
    <input type="text" class="form-control" id="inputName" required>
  </div>
  <div class="mb-3">
    <label for="inputEmail" class="form-label">Adresse Email</label>
    <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" required>
    <div id="emailHelp" class="form-text">Nous ne partagerons jamais votre email avec qui que ce soit.</div>
  </div>
  <div class="mb-3">
    <label for="inputPassword" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="inputPassword" required>
  </div>
  <div class="mb-3">
    <label for="inputConfirmPassword" class="form-label">Confirmer le mot de passe</label>
    <input type="password" class="form-control" id="inputConfirmPassword" required>
  </div>
  <div class="mb-3">
    <label for="inputRole" class="form-label">Rôle</label>
    <select class="form-select" id="inputRole" required>
      <option value="" selected disabled>Choisissez un rôle</option>
      <option value="user">Utilisateur</option>
      <option value="admin">Administrateur</option>
    </select>
  </div>
  <button type="submit" class="btn btn-dark">S'inscrire</button>
</form>

      <div class="mt-3 text-center">
        <p>Déjà inscrit ? <a href="loginPage.php">Se connecter</a></p>
      </div>
    </div>
    
    <!-- Add Bootstrap JavaScript (optional, but recommended for certain components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
