<?php
session_start();

require_once("conn_db/conn.php");
require_once("inc/functions.php");

$postData = $_POST;

$recipe = $postData['recipe_id'];
$rate = $postData['rate'];
$author = getLoggedUserInfo('userId');

if (!isset($postData['rate']))
{
	$errorMessage = 'Il faut une note pour soumettre le formulaire.';
    $_SESSION['flash']['danger'] = $errorMessage;
    header("Location: recipe.php?id=$recipe");
    return;
}	

$insertRecipe = $db->prepare('INSERT INTO ratings (rating,recipe_id,user_id) VALUES (:ratings, :recipe_id,:user_id)');
$insertRecipe->execute([
    'ratings' => $rate,
    'recipe_id' => $recipe,
    'user_id' => $author,  
]);

$_SESSION["flash"]['success'] =  "Vous avez noté la recette numero $recipe avec success !";
// redirect
header("location: recipe.php?id=$recipe");