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
  <h1 class="text-center mb-4">Ajouter une mission</h1>
  </div>
  <div style="display:flex;justify-content:center;align-items:center;flex-direction:column;">
  <form  style="width:50%;" action="#" method="post">
  <div class="form-group">
    <label for="Title"style="margin: 10px 10px;">Titre</label>
    <input type="text" class="form-control" placeholder="Entrer le titre">
  </div>
  <div class="form-group">
    <label for="description" style="margin: 10px 10px;" >Description</label>
    <textarea class="form-control" placeholder="Entrer la description"></textarea>
   </div>
  <div style="display:flex;justify-content:center;align-items:center;">
  <button type="submit" class="btn btn-success m-2" style="font-size: 1.5em;" >Ajouter</button>
  <button type="button" class="btn btn-danger m-2" style="font-size: 1.5em;" onclick="window.location.href='missions.php'" >Annuler</button>
  </div>
</form>
</div>

</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
