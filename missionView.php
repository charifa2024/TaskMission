<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des missions</title>
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
              <a class="nav-link " href="tasks.php">tâches</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="missions.php">Missions</a>
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
  <h1 class="text-center mb-4">Les Informations d'une mission</h1>
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
            <dd class="col-sm-8">mission 1</dd>
            <dt class="col-sm-4">La description :</dt>
            <dd class="col-sm-8">Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio nulla quaerat ratione explicabo facilis! A iste illum, doloremque facere deserunt est sequi necessitatibus esse tempora ab molestiae temporibus nesciunt quasi!</dd>
        </dl>
        <div class="container page_title">
  <h1 class="text-center mb-4">Les Tâches appartenant à cette mission</h1>
  </div>
  <div class="container table-responsive">
  <table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">Titre</th>
      <th scope="col">Statut</th>
      <th scope="col">Priorité</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row">Tâche 1</td>
      <td scope="row">en cours</td>
      <td scope="row">primaire</td>
      <td style="display:flex;justify-content:center;align-items:center;">
       <a href="taskView.php"><button type="button" class="btn btn-info me-1">Info</button></a>
       <a href="modifyTask.php"><button type="button" class="btn btn-warning me-1">Modifier</button></a>
       <form action="#" method="post">
        <button type="submit" class="btn btn-danger me-1">Supprimer</button>
       </form>
       </td>
    </tr>
    <tr>
  </tbody>
</table>
</div>
<form action="#" method="post">
<label for="addTask" class="form-label fw fs-5 text-uppercase mb-3 mt-4">Ajouter une tâche</label>
    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
  <option selected>Ajouter une tâche</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
    <button type="submit" class="btn btn-success m-2">Ajouter</button>
</form>
          <div class="text-center mt-4">
            <a href="missions.php" class="btn btn-dark">Retourner au Tableau</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
