<?php
session_start();
require_once("../inc/functions.php");
block_access();

require_once("../conn_db/conn.php");
$titlePage = "Creation d'une recette";
require_once('../inc/header.php');

$recipe_id = $_GET["id"];

if (!isset($recipe_id) && !is_numeric($recipe_id)) {
    header("Location: index.php");
    exit();
}

$retrieveRecipeStatement = $db->prepare('SELECT * FROM recipes WHERE recipe_id = :id');
$retrieveRecipeStatement->execute([
    'id' => $recipe_id,
]);

$recipe = $retrieveRecipeStatement->fetch(PDO::FETCH_ASSOC);
extract($recipe);
?>
<h3 class="mt-3 fw-bolder">Modification de la recette N°<?= $recipe_id ?> </h3>
<hr>
<form action="recipe_update.php" method="POST">
    <input type="hidden" name="id" value="<?= $recipe_id ?>" >
    <div class="mb-3">
        <label for="title" class="form-label">Titre de la recette</label>
        <input type="text" class="form-control" value="<?= $title ?>"  id="title" name="title" aria-describedby="title-help">
        <div id="title-help" class="form-text">Choisissez un titre percutant !</div>
    </div>
    <div class="mb-3">
        <label for="recipe" class="form-label">Description de la recette</label>
        <textarea class="form-control"  placeholder="Seulement du contenu vous appartenant ou libre de droits." col="10" rows="10" id="recipe" name="recipe"><?= $description ?></textarea>
    </div>
    <div class="form-check mb-3">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="isEnabled"  <?php if ($is_enabled == 0) echo "checked" ?> > Rendre Invisible
        </label>
    </div>
    <button type="submit" class="btn btn-dark">Mettre à jour la reccette</button>
</form>
</div>
<?php
require_once('../inc/footer.php');
