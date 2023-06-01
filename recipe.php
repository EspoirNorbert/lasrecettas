<?php
session_start();
require_once("conn_db/conn.php");

$recipe_id = $_GET["id"];

if (!isset($recipe_id) && !is_numeric($recipe_id)) {
    header("Location: index.php");
    exit();
}


/**
 * Recuperations des details des recettes
 */
$sql = 'SELECT * FROM recipes NATURAL JOIN users WHERE recipe_id = :recipe_id';
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute([
    'recipe_id' => $recipe_id
]);
$recipe = $recipesStatement->fetch(PDO::FETCH_ASSOC);
extract($recipe);

/***
 * Extract permet de transformer les clés d'un tableau en variable
 * Par exemple
 *  $users = [
 *      "name" => "Maryline",    
 *      "age" => 22,    
 *  ]
 * 
 * En utilisant extract comme si :
 * extract($users);
 * 
 * On peut directement acceder à la valeur de name sans specifier le tableau
 * au lieu de $users['name'] on directement $name 
 *
 * 
 */
$titlePage = $title;
require_once('inc/header.php');
?>
<h3 class="mt-3 fw-bolder"><?= $title ?></h3>
<hr>
<p>Auteur <strong><?= ($recipe['user_id'] == getLoggedUserInfo('userId')) ? "Vous" : $username  ?></strong></p>
<!-- Recette  -->
<p><?= $description ?></p>
<?php
$sqlQueryComment = 'SELECT * FROM comments NATURAL JOIN users WHERE recipe_id = :recipe_id ORDER BY date DESC';
$CommentStatement = $db->prepare($sqlQueryComment);
$CommentStatement->execute([
    'recipe_id' => $recipe_id
]);
$comments = $CommentStatement->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="row mb-5">
    <div class="col-md-9">
        <h3 class="fw-bolder"><?= count($comments) ?> Commentaire<?= count($comments) > 1 ? "s" : "" ?></h3>
        <hr>
        <?php if (($recipe['user_id'] != getLoggedUserInfo('userId'))) : ?>
            <div id="postCommentForm" class="mb-3">
                <form action="comment_create.php" method="POST">
                    <input type="hidden" value="<?= $recipe_id ?>" name="recipe_id">
                    <div class="mt-3 mb-3">
                        <textarea class="form-control" id="comment" placeholder="Laisser un commentaire" name="comment"></textarea>
                    </div>
                    <?php if (!isset($_SESSION['LOGGED_USER'])) : ?>
                        <div class="alert alert-info">Vous devez vous connecter pour laisser le commentaire.</div>
                    <?php else : ?>
                        <input type="hidden" value="<?= getLoggedUserInfo('userId') ?>" name="user_id">
                        <button type="submit" class="btn btn-dark">Commenter</button>
                    <?php endif; ?>
                </form>
            </div>
        <?php endif; ?>
        <div id="comments">
            <?php
            if (count($comments) == 0) {
            ?>
                <div class="alert alert-info">
                    Aucun commentaires n'a été emis par cette recette pour le moment.
                </div>
                <?php
            } else {
                foreach ($comments as $comment) :  extract($comment) ?>
                    <div class="card mb-3 border-0 bg-light shadow-sm">
                        <div class="row g-0">
                            <div class="col-md-2 bg-dark d-flex justify-content-center">
                                <img title="<?= $username ?>" src="/assets/images/user.png" width="100" class="img-fluid rounded-start mt-3 border-dark ms-3" alt="Avatar de <?= $username ?>">
                            </div>
                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $username ?></h5>
                                    <p class="card-text"><?= $content ?></p>
                                    <p class="card-text"><small class="text-body-secondary">Posté le <?= $date ?></small></p>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($_SESSION['LOGGED_USER']) && $comment['user_id'] == getLoggedUserInfo('userId')) : ?>
                            <div class="card-footer">
                                <a href="comment_edit.php?id=<?= $comment_id ?>&recipe_id=<?= $recipe_id ?>" class="btn btn-success">Modifier</a>
                                <a href="comment_delete.php?id=<?= $comment_id ?>&recipe_id=<?= $recipe_id ?>" class="btn btn-danger">Supprimer</a>
                            </div>
                        <?php endif; ?>

                    </div>
            <?php endforeach;
            } ?>
        </div>
    </div>

    <div class="col-md-3">
        <h3 class="fw-bolder">Notes</h3>
        <hr>
        <?php if (($recipe['user_id'] != getLoggedUserInfo('userId'))) : ?>
            <div class="rating_actions">
                <form action="rating_create.php" method="POST">
                    <?php
                    // recuperer la note de la recette de l'utilisateur
                    if (isset($_SESSION['LOGGED_USER'])) {
                        $userId = getLoggedUserInfo('userId');
                        $sqlRating = 'SELECT rating FROM ratings where recipe_id = :recipe_id and user_id =:user_id';
                        $ratingStatement = $db->prepare($sqlRating);
                        $ratingStatement->execute([
                            'recipe_id' => $recipe_id,
                            'user_id' => $userId,
                        ]);
                        $resultRating  = $ratingStatement->fetch(PDO::FETCH_ASSOC);
                        $rate = (gettype($resultRating) == "boolean") ? [] : $resultRating;
                    }
                    ?>
                    <input type="hidden" value="<?= $recipe_id ?>" name="recipe_id">
                    <div class="mb-3">
                        <?php for ($i = 0; $i <= 5; $i++) { ?>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" 
                                <?php if ((isset($_SESSION['LOGGED_USER']) && !empty($rate)) && $rate['rating'] == $i) echo "checked"; ?> id="radio<?= $i ?>" name="rate" value="<?= $i ?>">
                                <label class="form-check-label" for="radio1"><?= $i ?></label>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if (!isset($_SESSION['LOGGED_USER'])) : ?>
                        <div class="alert alert-info"><small>Connecter vous pour noter</small></div>
                    <?php else : ?>
                        <button type="submit" class="btn btn-dark">Noter</button>
                    <?php endif; ?>
                </form>
            </div>
        <?php endif; ?>
        <div class="rating_stats mt-4 bg-light p-2">
            <h4 class="fw-bolder">Stats</h4>
            <div>
                <h6 className="text-app">Nombre personnes</h6>
                <hr>
                <?php
                $sqlTotalCount = 'SELECT count(DISTINCT user_id) as total_users FROM ratings where recipe_id = :recipe_id ';
                $totalUserStatement = $db->prepare($sqlTotalCount);
                $totalUserStatement->execute([
                    'recipe_id' => $recipe_id
                ]);
                $resultTotalUser  = $totalUserStatement->fetch(PDO::FETCH_ASSOC);
                ?>
                <p><strong><?= $resultTotalUser['total_users'] ?></strong></p>
            </div>
            <div>
                <h6 className="text-app">Moyenne</h6>
                <hr>
                <?php
                $sqlAverage = 'SELECT AVG(rating) AS average_rating FROM ratings where recipe_id = :recipe_id ';
                $averageStatement = $db->prepare($sqlAverage);
                $averageStatement->execute([
                    'recipe_id' => $recipe_id
                ]);
                $resultAverage   = $averageStatement->fetch(PDO::FETCH_ASSOC);
                ?>
                <p><strong><?= ($resultAverage['average_rating'] == NULL) ? 'NA' : round($resultAverage['average_rating'], 2) ?></strong></p>
            </div>
        </div>
    </div>
</div>

</div>
<?php include_once('inc/footer.php'); ?>