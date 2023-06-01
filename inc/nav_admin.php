<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/auth">Lasrecettas</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/index.php">Decouvir d'autre recettes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/auth/recipes.php">Mes recettes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/auth/recipe_form.php">Creer une recette</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/auth/logout.php">Se deconnecter</a>
        </li>
      </ul>
     <div class="navbar-nav ml-auto">
        <img width="30" src="../assets/images/user.png" class="me-3" alt="">
        <span><?= getLoggedUserInfo("username") ?> <strong>#<?= getLoggedUserInfo("userId") ?></strong></span>
     </div>
    </div>
  </div>
</nav>