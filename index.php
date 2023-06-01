<?php 
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
<h3 class="mt-3 fw-bolder"> <?= count($recipes) ?> Recettes</h3>
<hr>
<!-- Parcours et affichage des recettes -->
<?php foreach ($recipes as $recipe) : ?>
    
    

    <article class="mb-3">
        <h3 class="fw-bolder"><a class="text-dark text-decoration-none" href="recipe.php?id=<?= $recipe['recipe_id'] ?>"><?php echo $recipe['title']; ?></a></h3>
        <div><?php echo $recipe['description']; ?></div>
        <i>Auteur: <strong><?= ($recipe['user_id'] == getLoggedUserInfo('userId')) ? "Vous" : $recipe['username']  ?></strong></i>
    </article>
   
<?php endforeach ?>
</div>
<?php
require_once("inc/footer.php");