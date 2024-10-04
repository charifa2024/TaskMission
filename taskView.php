<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des tâches</title>
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
              <a class="nav-link active" aria-current="page" href="tasks.php">tâches</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="missions.php">Missions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="signupRequest.php">Demandes d'Inscription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="operation.php">Opérations Éffectuées</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container page_title">
  <h1 class="text-center mb-4">Les Informations d'une Tâche</h1>
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
            <dd class="col-sm-8">tâche 1</dd>
            <dt class="col-sm-4">La description :</dt>
            <dd class="col-sm-8">Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio nulla quaerat ratione explicabo facilis! A iste illum, doloremque facere deserunt est sequi necessitatibus esse tempora ab molestiae temporibus nesciunt quasi!</dd>
            <dt class="col-sm-4">La priorité :</dt>
            <dd class="col-sm-8">primaire</dd>
            <dt class="col-sm-4">Statut :</dt>
            <dd class="col-sm-8">Terminé</dd>
            <dt class="col-sm-4">Résultat :</dt>
            <dd class="col-sm-8">Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio nulla quaerat ratione explicabo facilis! A iste illum, doloremque facere deserunt est sequi necessitatibus esse tempora ab molestiae temporibus nesciunt quasi!</dd>
            <dt class="col-sm-4">Le titre de mission :</dt>
            <dd class="col-sm-8">mission 1</dd>

          </dl>
          <div class="text-center mt-4">
            <a href="tasks.php" class="btn btn-dark">Retourner au Tableau</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
