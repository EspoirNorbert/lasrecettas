<?php
session_start();

require_once("conn_db/conn.php");
require_once("inc/functions.php");

$postData = $_POST;
$recipe = $postData['recipe_id'];
$comment = $postData['comment'];
$author = getLoggedUserInfo('userId');

if (isset($postData['comment']) && empty($postData['comment']))
{
	$errorMessage = 'Il faut un commentaire pour soumettre le formulaire.';
    $_SESSION['flash']['danger'] = $errorMessage;
    header("Location: recipe.php?id=$recipe");
    return;
}	

$insertRecipe = $db->prepare('INSERT INTO comments (content,date ,recipe_id,user_id) VALUES (:content, now(),:recipe_id,:user_id)');
$insertRecipe->execute([
    'content' => $comment,
    'recipe_id' => $recipe,
    'user_id' => $author,  
]);

$_SESSION["flash"]['success'] =  "Vous avez commenté la recette numero $recipe avec success !";
// redirect
header("location: recipe.php?id=$recipe");