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
              <a class="nav-link" href="#">tâches</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Missions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="signupRequest.php">Demandes d'Inscription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Opérations Éffectuées</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container page_title">
  <h1 class="text-center mb-4">Gestion des demandes d'inscriptions</h1>
  </div>
  <div class="container table-responsive">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Email</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row">email@gmail.com</td>
      <td>
       <button type="button" class="btn btn-info me-1">Info</button>
       <button type="button" class="btn btn-success me-1">Accepter</button>
       <button type="button" class="btn btn-danger">Refuser</button>
      </td>

    </tr>
    <tr>
      <td scope="row">email@gmail.com</td>
      <td>
       <button type="button" class="btn btn-info me-1">Info</button>
       <button type="button" class="btn btn-success me-1">Accepter</button>
       <button type="button" class="btn btn-danger">Refuser</button>
      </td>
    </tr>
    <tr>
      <td scope="row">email@gmail.com</td>
      <td>
       <button type="button" class="btn btn-info me-1">Info</button>
       <button type="button" class="btn btn-success me-1">Accepter</button>
       <button type="button" class="btn btn-danger">Refuser</button>
      </td>
    </tr>
  </tbody>
</table>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
