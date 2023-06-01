<?php
session_start();
require_once("../inc/functions.php");
require_once("../config/database.php");

block_access();

$titlePage = "Recettes";
$userId = (int) getLoggedUserInfo('userId');

// Requette SQL de recuperation de la liste des requettes
$sql = 'SELECT * FROM recipes NATURAL JOIN users WHERE user_id = :userId ORDER BY recipe_id DESC';
$recipesStatement = $db->prepare($sql);

// Execution de la requettes
$recipesStatement->execute([
    'userId' => $userId
]);
// recuperation des elements de la requettes
$recipes = $recipesStatement->fetchAll(PDO::FETCH_ASSOC);
require_once('../inc/header.php');
?>
<h3 class="mt-3 fw-bolder"> <?= count($recipes) ?> Recette<?= count($recipes) > 1 ? "s" : "" ?></h3>
<hr>
<!-- Parcours et affichage des recettes -->
<?php if (count($recipes) == 0) : ?>
    <div class="card-body p-0 ">
        <div class="d-flex flex-column p-5 w-50 text-center  mx-auto">
            <i class="fa fa-user fs-1 text-app" aria-hidden="true"></i>
            <h3 class="text-app-secondary fw-bold">Vous n'avez creer aucune recette</h3>
            <p class="text-muted">Tous vos recettes seront sauvegardées ici pour que vous puissez les consultertout moment.
            </p>
            <a href="recipe_form.php" class="w-50 mx-auto btn-lg btn btn-dark">
                <i class="fa fa-plus"></i> Creer une recette</a>
        </div>
    </div>
        <?php else :
        foreach ($recipes as $recipe) : extract($recipe) ?>
            <article class="mb-3 bg-light rounded p-3 border border-dark">
                <h3 class="fw-bolder"><a target="_blank" class="text-dark text-decoration-none" href="recipe.php?id=<?= $recipe['recipe_id'] ?>"><?php echo $recipe['title']; ?></a></h3>
                <div><?php echo $recipe['description']; ?></div>
                <div class="d-flex mt-3">
                    <a href="recipe_edit.php?id=<?= $recipe_id ?>" class="btn btn-success me-2">Modifier</a>
                    <a onclick="return confirm('Voulez vous vraiment supprimer cette recette ?')" href="recipe_delete.php?id=<?= $recipe_id ?>" class="btn btn-danger">Supprimer</a>
                </div>
            </article>
        <?php 
    endforeach;
    endif;
    ?>
    </div>
    <?php
    require_once("../inc/footer.php");
