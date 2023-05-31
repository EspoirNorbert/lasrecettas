<?php
session_start();

include_once('config/mysql.php');
include_once('config/user.php');
include_once('variables.php');

$postData = $_POST;

if (
    !isset($postData['title']) 
    || !isset($postData['recipe'])
    )
{
	echo('Il faut un titre et une recette à supprimer.');
    return;
}	

$title = $postData['title'];
$recipe = $postData['recipe'];

$insertRecipe = $mysqlClient->prepare('DELETE recipes(title, recipe, author, is_enabled) VALUES (:title, :recipe, :author, :is_enabled)');
$insertRecipe->execute([
    'title' => $title,
    'recipe' => $recipe,
    'author' => $loggedUser['email'],
    'is_enabled' => 1,
]);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Suppression de recette</title>
    <link
        href="../css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

    <?php include_once('header.php'); ?>
        <h1>Recette supprimé avec succès !</h1>
        
        <div class="card">
            
            <div class="card-body">
                <h5 class="card-title"><?php echo($title); ?></h5>
                <p class="card-text"><b>Email</b> : <?php echo($loggedUser['email']); ?></p>
                <p class="card-text"><b>Recette</b> : <?php echo strip_tags($recipe); ?></p>
            </div>
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</body>
</html>