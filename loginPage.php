<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/loginPage.css">
  </head>
  <body>
  <div class="logo" onclick="window.location.href ='index.php'" >TaskMission</div>
    <div class="login-form">
      <h2>Connexion</h2>
      <form>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Adresse Email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">Nous ne partagerons jamais votre email avec qui que ce soit.</div>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
          <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-dark">Connecter</button>
      </form>
      <div class="mt-3 text-center">
        <p>Pas encore de compte ? <a href="signupPage.php">S'inscrire</a></p>
      </div>
    </div>
    
    <!-- Add Bootstrap JavaScript (optional, but recommended for certain components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
