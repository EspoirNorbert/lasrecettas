<?php
session_start();

require_once("../config/database.php");
require_once("../inc/functions.php");
block_access();


$recipeId = $_GET["id"];
$commentId = $_GET["id"];

if (!isset($recipeId) && !is_numeric($recipeId)) {
    header("Location: index.php");
    exit();
}

$insertRecipe = $db->prepare('DELETE FROM recipes where recipe_id = :id');
$insertRecipe->execute([
    'id' => $recipeId
]);

$_SESSION["flash"]['success'] =  "La recette supprimé avec success !";
header("location: recipes.php");


