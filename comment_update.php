<?php
session_start();

require_once("conn_db/conn.php");
require_once("inc/functions.php");

$postData = $_POST;
$recipeId = $postData['recipeId'];
$commentId = $postData['commentId'];
$comment = $postData['comment'];


if (isset($postData['comment']) && empty($postData['comment']))
{
	$errorMessage = 'Il faut un commentaire pour soumettre le formulaire.';
    $_SESSION['flash']['danger'] = $errorMessage;
    header("Location: recipe.php?id=$recipe");
    return;
}	

$updateComment = $db->prepare('UPDATE comments SET content= :comment WHERE recipe_id = :recipeId AND comment_id= :commentId');
$updateComment->execute([
    'comment' => $comment,
    'recipeId' => $recipeId,
    'commentId' => $commentId
]);

$_SESSION["flash"]['success'] =  "Le commentaire numero <strong>$commentId</strong> a été mise à jour avec success !";
// redirect
header("location: recipe.php?id=$recipeId");