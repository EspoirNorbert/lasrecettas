<?php
session_start();

require_once("../config/database.php");
require_once("../inc/functions.php");
block_access();

$postData = $_POST;

if (
    !isset($postData['id']) || !isset($postData['title']) || !isset($postData['recipe']))
{
	$errorMessage = 'Il faut un titre et une recette pour soumettre le formulaire.';
    $_SESSION['flash']['danger'] = $errorMessage;
    header("Location: recipe_form.php");
    return;
}	

$id = $postData['id'];
$title = $postData['title'];
$recipe = $postData['recipe'];
$isEnabled = isset($postData['isEnabled']) ? 0 : 1;

$insertRecipe = $db->prepare('UPDATE recipes SET title = :title, description = :recipe , is_enabled= :is_enabled WHERE recipe_id = :id');
$insertRecipe->execute([
    'title' => $title,
    'recipe' => $recipe,
    'is_enabled' => $isEnabled,
    'id' => $id,
]);

$_SESSION["flash"]['success'] =  "La recette numero <strong>$id</strong> a été mise à jour avec success !";
// redirect
header("location: recipe.php?id=$id");