<?php
session_start();

require_once("config/database.php");
require_once("inc/functions.php");

$commentId = $_GET["id"];
$recipeId = $_GET["recipe_id"];

if ((!isset($commentId) && !is_numeric($commentId)) && 
    !isset($recipeId) && !is_numeric($recipeId)) {
    header("Location: index.php");
    exit();
}

$insertRecipe = $db->prepare('DELETE FROM comments where recipe_id = :recipe_id  AND comment_id= :comment_id');
$insertRecipe->execute([
    'recipe_id' => $recipeId,
    'comment_id' => $commentId,
]);

$_SESSION["flash"]['success'] =  "Le commentaire a été supprimé avec success !";
header("location: recipe.php?id=$recipeId");