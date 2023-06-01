<?php
session_start(); 
/**
 * Connexion à la base de données
 */
require_once("conn_db/conn.php");

/***
 * Titre de la page
 */
$titlePage="Recettes";

/**
 * Insertion du header
 */
require_once('inc/header.php');

/***
 * Recuoperations des données
 */

// Requette SQL de recuperation de la liste des requettes
$sql = 'SELECT * FROM recipes NATURAL JOIN users WHERE is_enabled=TRUE ORDER BY recipe_id DESC';
// Execution de la requettes
$recipesStatement = $db->query($sql);
// recuperation des elements de la requettes
$recipes = $recipesStatement->fetchAll(PDO::FETCH_ASSOC);
?>
<h3 class="mt-3 fw-bolder"> <?= count($recipes) ?> Recette<?= count($recipes) > 1 ? "s" : "" ?></h3>
<hr>
<!-- Parcours et affichage des recettes -->
<?php if (count($recipes) == 0) : ?>
    <div class="card-body p-0 ">
        <div class="d-flex flex-column p-5 w-50 text-center  mx-auto">
            <i class="fa fa-user fs-1 text-app" aria-hidden="true"></i>
            <h3 class="text-app-secondary fw-bold">Aucune recettes proposé pour l'instant</h3>
            <p class="text-muted">Tous vos recettes sont afficher ici.</p>
        </div>
    </div>
    <?php else :
    foreach ($recipes as $recipe) : ?>
    <article class="mb-3">
        <h3 class="fw-bolder"><a class="text-dark text-decoration-none" href="recipe.php?id=<?= $recipe['recipe_id'] ?>"><?php echo $recipe['title']; ?></a></h3>
        <div><?php echo $recipe['description']; ?></div>
        <i>Auteur: <strong><?= ($recipe['user_id'] == getLoggedUserInfo('userId')) ? "Vous" : $recipe['username']  ?></strong></i>
    </article>
    <?php 
    endforeach;
    endif;
    ?>
</div>
<?php
require_once("inc/footer.php");