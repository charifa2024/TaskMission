<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Tâches et Missions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">      <div class="container-fluid">
        <a class="navbar-brand" href="#">TaskMission</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Tableau de bord</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Créer des tâches</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Créer des Missions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Demandes d'Inscription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Opérations Éffectuées</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container welcome-message">
  <h1 class="text-center mb-4">Bienvenue sur TaskMission</h1>
  <p class="text-center">Gérez efficacement vos tâches et missions entre utilisateurs</p>
  <div class="row mt-4">
    <div class="col-md-4">
      <h3>Organisez</h3>
      <p>Créez et gérez vos tâches et missions en toute simplicité.</p>
    </div>
    <div class="col-md-4">
      <h3>Collaborez</h3>
      <p>Travaillez en équipe et partagez vos projets avec d'autres utilisateurs.</p>
    </div>
    <div class="col-md-4">
      <h3>Suivez</h3>
      <p>Surveillez l'avancement de vos projets et respectez vos délais.</p>
    </div>
  </div>
  <button type="button" class="btn btn-outline-light mt-5" onclick="window.location.href='loginPage.php'">Commencer</button>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
