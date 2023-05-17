
<?php
  session_start();
  if (isset($_SESSION['user']))
  {
    $user = $_SESSION['user'];
  }
  
  if (isset($_POST['s_inscrire']))
  {
    header("Location: register.php");
    exit;
  }
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Kaz Cuisine</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
        <li>
          <a class="nav-link" href="add_recipes.php">Ajouter une recette</a>
        </li>
      </ul>
      <?php if(isset($user)): ?>
        <span>Connecté avec le compte <?php echo $user['email']." "; ?></span> 
        <form action=""><button type="submit" class="btn btn-danger" name="logout"><a class="nav-link" href="logout.php">Déconnexion</a></button></form>
      <?php else: ?>
        <form method="POST">
          <button type="submit" class="btn-primary" name="s_inscrire">S'inscrire</button>
        </form>
      <?php endif; ?>   
    </div>
  </div>
</nav>

