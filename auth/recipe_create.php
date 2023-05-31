<?php
session_start();

require_once("../conn_db/conn.php");
require_once("../inc/functions.php");

$postData = $_POST;

if (!isset($postData['title']) || !isset($postData['recipe']))
{
	$errorMessage = 'Il faut un titre et une recette pour soumettre le formulaire.';
    $_SESSION['flash']['danger'] = $errorMessage;
    header("Location: recipe_form.php");
    return;
}	

$title = $postData['title'];
$recipe = $postData['recipe'];
$isEnabled = isset($postData['isEnabled']) ? 0 : 1;
$author = getLoggedUserInfo('userId');


$insertRecipe = $db->prepare('INSERT INTO recipes(title, description, is_enabled,user_id) VALUES (:title, :recipe,:is_enabled,:author)');
$insertRecipe->execute([
    'title' => $title,
    'recipe' => $recipe,
    'is_enabled' => $isEnabled,
    'author' => $author,  
]);

$_SESSION["flash"]['success'] =  "Une recette a été crée avec success";
// redirect
header("location: recipes.php");