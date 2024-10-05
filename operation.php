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
              <a class="nav-link " href="signupRequest.php">Demandes d'Inscription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="operation.php">Opérations Éffectuées</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container page_title">
  <h1 class="text-center mb-4">Gestion des Opérations effectuées par les utilisateurs</h1>
  </div>
  <div class="container table-responsive"style="margin-bottom: 5rem;">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Email</th>
      <th scope="col">Opération</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row">2023-06-01</td>
      <td scope="row">email@gmail.com</td>
      <td scope="row">Création de tâche</td>
    </tr>
  </tbody>
</table>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
