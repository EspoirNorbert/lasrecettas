<?php
$titlePage = "Creation d'une recette";
require_once('../inc/header.php');

if (isset($_POST["btnSendMessage"])) {
    $_SESSION['flash']['success'] = "Votre message a été bien envoyée";
    header("Location: contact.php");
}

?>
<h3 class="mt-3 fw-bolder">Ajouter une nouvelle recette</h3>
<hr>
<div class="alert alert-info alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Info!</strong> Les recettes nouvellement crées sont visibles par tous le monde.
</div>
<form action="post_create.php" method="POST">
    <div class="mb-3">
        <label for="title" class="form-label">Titre de la recette</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="title-help">
        <div id="title-help" class="form-text">Choisissez un titre percutant !</div>
    </div>
    <div class="mb-3">
        <label for="recipe" class="form-label">Description de la recette</label>
        <textarea class="form-control" placeholder="Seulement du contenu vous appartenant ou libre de droits." 
        col="10" rows="10" id="recipe" name="recipe"></textarea>
    </div>
    <div class="form-check mb-3">
    <label class="form-check-label">
      <input class="form-check-input" type="checkbox" name="isEnabled"> Rendre Invisible
    </label>
  </div>
    <button type="submit" class="btn btn-dark">Creer la recette</button>
</form>
</div>
<?php
require_once('../inc/footer.php');
