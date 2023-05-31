<?php 
/**
 * Connexion à la base de données
 */
require_once("../conn_db/conn.php");

/***
 * Titre de la page
 */
$titlePage="Recettes";

/**
 * Insertion du header
 */
require_once('../inc/header.php');

/***
 * Recuoperations des données
 */
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
?>
<h3 class="mt-3 fw-bolder"> <?= count($recipes) ?> Recettes</h3>
<hr>
<!-- Parcours et affichage des recettes -->
<?php foreach ($recipes as $recipe) : ?>
    <article class="mb-3">
    <h3 class="fw-bolder"><a target="_blank" class="text-dark text-decoration-none" href="recipe.php?id=<?= $recipe['recipe_id'] ?>"><?php echo $recipe['title']; ?></a></h3>
        <div><?php echo $recipe['description']; ?></div>
        <div class="d-flex mt-3">
            <a href="#" class="btn btn-success me-2">Publier</a>
            <a href="#" class="btn btn-info me-2">Modifier</a>
            <a href="#" class="btn btn-danger">Supprimer</a>
        </div>
    </article>
    <hr>
<?php endforeach ?>
</div>
<?php
require_once("../inc/footer.php");