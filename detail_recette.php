<?php session_start(); // $_SESSION 
    include_once('config/mysql.php');
    include_once('config/user.php');
    include_once('variables.php');
    include_once('functions.php');

$db = new PDO(
    'mysql:host=localhost;dbname=recettes;charset=utf8',
    'root',
    'root',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
); 
//récupérer l'indentifiant de la recette passé en paramètre
//cet identifiant s'appel id et on le récupère grace à la superglobal $_GET
$recipe_id = $_GET["id"] ;
$sqlQuery = 'SELECT recipe,author,recipe_id,title FROM recipes WHERE recipe_id = :recipe_id';
$recipesStatement = $db->prepare($sqlQuery);
$recipesStatement->execute([
    'recipe_id' => $recipe_id
]);
$recipe = $recipesStatement->fetch(PDO::FETCH_ASSOC);
//var_dump($recipes);
//die();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - <?= $recipe["title"] ?></title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/index.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php include_once('header.php'); ?>
        <h1><?= $recipe["title"] ?></h1>
        <hr>
        <p>
        Auteur:<?= $recipe["author"] ?>
        </p>
        <!-- Recette  -->
        <p><?= $recipe['recipe'] ?></p>
            
            <a class="btn btn-primary" href="update.php">Modifier</a>
            <a class="btn btn-primary"href="delete.php">Supprimer</a>
            <hr>
                <h3>Commentaire</h3>
                <div>
                    <?php 
                    $sqlQueryComment = 'SELECT comment,note,created_date FROM comments WHERE recipe_id = :recipe_id';
                    $CommentStatement = $db->prepare($sqlQueryComment);
                    $CommentStatement->execute([
                        'recipe_id' => $recipe_id
                    ]);
                    $comments = $CommentStatement->fetchAll(PDO::FETCH_ASSOC);
                    //var_dump($comments);
                    //die();
                    if (count($comments) == 0){
                        ?>
                    <p>Cette recette ne contient aucun commentaire</p>
                        <?php
                    }else{
                        
                         foreach($comments as $comment) : ?>
            <article>
                <h3>
                            Posté le <?= $comment["created_date"] ?>
            </h3>
                <p><?= $comment["comment"] ?></p>
                <p>Note: <?= $comment["note"] ?></p>
                <hr>
            </article>
        <?php endforeach;} ?>
                        
                </div>
        
        <div>
            <form action="post_comment.php" method="POST">
                <input type="hidden" value="<?= $recipes['recipe_id'] ?>"name = "recipe_id">
                <input type="hidden" value="<?= $recipes['user_id'] ?>"name = "user_id">
                <div class= "mt-3 mb-3">
                    <label class="form-label" for="">Attribuer une note entre 0 et 5 à cette recette</label>
                    <input type="number" class="form-control" id="note" name="note">
                </div>
                <div class= "mt-3 mb-3">
                    <label class="form-label" for="">Laisser un commentaire</label>
                    <textarea class="form-control"id="comment" name="comment"></textarea>
                </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
        <br />
        </form>
    </div>
    <?php include_once('footer.php'); ?>
</body>

</html>