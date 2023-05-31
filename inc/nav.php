<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Lasrecettas</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Recettes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contactez Nous</a>
        </li>
        <?php if (!isset($_SESSION['LOGGED_USER'])) : ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Se connecter</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signup.php">S'inscrire</a>
        </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
        <li class="nav-item">
          <a class="nav-link" href="create.php">Creer une recettes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Se deconnecter</a>
       
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>