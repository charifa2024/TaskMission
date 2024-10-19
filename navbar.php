<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<?php
session_start();
?>
<style>
  .navbar-nav .nav-link.active {
    font-weight: bold;
    color: #ffffff !important;
  }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">      <div class="container-fluid">
        <a class="navbar-brand" href="index.php" style="font-size :2em;font-weight:bold;">TaskMission</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">Tableau de bord</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo ($current_page == 'tasks.php') ? 'active' : ''; ?>" href="tasks.php">tâches</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo ($current_page == 'missions.php') ? 'active' : ''; ?>" href="missions.php">Missions</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo ($current_page == 'signupRequest.php') ? 'active' : ''; ?>" href="signupRequest.php">Demandes d'Inscription</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo ($current_page == 'operation.php') ? 'active' : ''; ?>" href="operation.php">Opérations Éffectuées</a>
  </li>
</ul>
<?php
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
  echo"
          <ul class='navbar-nav ms-auto'>
          <li class='nav-item'>
            <a class='nav-link' href='logout.php'>
              <button type='button' class='btn btn-outline-light'>Déconnexion</button>
            </a>
          </li>
        </ul>";}
  ?>
        </div>
      </div>
    </nav>