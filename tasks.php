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
  <h1 class="text-center mb-4">Les Tâches crées</h1>
  </div>
  <div class="container table-responsive">
  <table class="table">
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
        <button type="submit" class="btn btn-primary me-1">Terminé</button>
       </form>
       <button type="button" class="btn btn-success me-1" onclick="showShareForm()">Partager</button>
       </td>
    </tr>
    <tr>
    <tr class="share-task-row" style="display: none;">
  <td colspan="4">
    <form action="#" method="post" class="mt-3">
      <div class="mb-3">
        <label for="sendTask" class="form-label">Sélectionner un destinataire</label>
        <select name="sendTask" id="sendTask" class="form-select">
          <option value="" selected disabled>Choisir un utilisateur</option>
          <option value="1">Utilisateur 1</option>
          <option value="2">Utilisateur 2</option>
          <option value="3">Utilisateur 3</option>
        </select>
      </div>
      <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-success me-2">Envoyer</button>
        <button type="button" class="btn btn-secondary" onclick="hideShareForm()">Annuler</button>
      </div>
    </form>
  </td>
</tr>


  </tbody>
</table>
</div>
<div style="display:flex;justify-content:center;align-items:center;">
<button type="button" class="btn btn-secondary btn-lg btn-block" onclick="window.location.href='addTask.php'" >Ajouter une tâche</button>
</div>

<div class="container page_title">
  <h1 class="text-center mb-4">Les Tâches Partagéés avec vous</h1>
  </div>
  <div class="container table-responsive" style="margin-bottom: 5rem;">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Titre</th>
      <th scope="col">Statut</th>
      <th scope="col">Priorité</th>
      <th scope="col">Expideteur</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row">Tâche 1</td>
      <td scope="row">en cours</td>
      <td scope="row">primaire</td>
      <td scope="row">Utilisateur 1</td>
      <td style="display:flex;justify-content:center;align-items:center;">
       <a href="taskView.php"><button type="button" class="btn btn-info me-1">Info</button></a>
       <a href="modifyTask.php"><button type="button" class="btn btn-warning me-1">Modifier</button></a>
       </td>
    </tr>
  </tbody>
</table>
</div>
<script>function showShareForm() {
  document.querySelector('.share-task-row').style.display = 'table-row';
}

function hideShareForm() {
  document.querySelector('.share-task-row').style.display = 'none';
}
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
