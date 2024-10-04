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
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">      <div class="container-fluid">
  <a class="navbar-brand" href="index.php" style="font-size :2em;font-weight:bold;">TaskMission</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Tableau de bord</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="tasks.php">tâches</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="missions.php">Missions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="signupRequest.php">Demandes d'Inscription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="operation.php">Opérations Éffectuées</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
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
            <dd class="col-sm-8">email@gmail.com</dd>
            <dt class="col-sm-4">Nom Complet :</dt>
            <dd class="col-sm-8">charifa fax</dd>
          </dl>
          <div class="text-center mt-4">
            <a href="signupRequest.php" class="btn btn-dark">Retourner au Tableau</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
