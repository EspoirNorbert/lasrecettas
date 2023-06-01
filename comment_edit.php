<?php
session_start();

require_once("conn_db/conn.php");
$titlePage = "Modification d'un commentaire";
require_once('inc/header.php');

$commentId = $_GET["id"];
$recipeId = $_GET["recipe_id"];

if ((!isset($commentId) && !is_numeric($commentId)) && 
    !isset($recipeId) && !is_numeric($recipeId)) {
    header("Location: recipe.php?id=$recipeId");
    exit();
}

/***
 * Retrieve comment details
 */
$retrieveCommentStatement = $db->prepare('SELECT * FROM comments WHERE comment_id= :commentId AND recipe_id = :recipeId');
$retrieveCommentStatement->execute([
    'recipeId' => $recipeId,
    'commentId' => $commentId,
]);

$comment = $retrieveCommentStatement->fetch(PDO::FETCH_ASSOC);
extract($comment);


/**
 * Retrieve recipe
 */
$retrieveRecipeStatement = $db->prepare('SELECT * FROM recipes WHERE recipe_id = :recipeId');
$retrieveRecipeStatement->execute([
    'recipeId' => $recipeId,
]);

$recipe = $retrieveRecipeStatement->fetch(PDO::FETCH_ASSOC);
extract($recipe);
?>
<h3 class="mt-3 fw-bolder">Modification du commentaire N°<?= $commentId ?> de la recette <i><?= $title ?></i> </h3>
<hr>
<form action="comment_update.php" method="POST">
    <input type="hidden" name="commentId" value="<?= $commentId ?>" >
    <input type="hidden" name="recipeId" value="<?= $recipeId ?>" >
    <div class="mb-3">
        <textarea class="form-control" id="comment" placeholder="Laisser un commentaire" name="comment"><?= $content ?></textarea>
    </div>
    <button type="submit" class="btn btn-dark">Modifier le commentaire</button>
</form>
</div>
<?php
require_once('inc/footer.php');
