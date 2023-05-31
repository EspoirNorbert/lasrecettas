<?php
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
<p>Auteur <strong><?= $username ?></strong></p>
<!-- Recette  -->
<p><?= $description ?></p>
<?php
$sqlQueryComment = 'SELECT * FROM comments NATURAL JOIN users WHERE recipe_id = :recipe_id';
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
        <div id="postCommentForm" class="mb-3">
            <form action="post_comment.php" method="POST">
                <input type="hidden" value="<?= $recipes['recipe_id'] ?>" name="recipe_id">
                <input type="hidden" value="<?= $recipes['user_id'] ?>" name="user_id">
                <div class="mt-3 mb-3">
                    <textarea class="form-control" id="comment" placeholder="Laisser un commentaire" name="comment"></textarea>
                </div>
                <?php if (!isset($_SESSION['LOGGED_USER'])) : ?>
                    <div class="alert alert-info">Vous devez vous connecter pour laisser le commentaire.</div>
                <?php else : ?>
                    <button type="submit" class="btn btn-dark">Commenter</button>
                <?php endif; ?>
            </form>
        </div>
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
                    </div>
            <?php endforeach;
            } ?>
        </div>
    </div>

    <div class="col-md-3">
        <h3 class="fw-bolder">Notes</h3>
        <hr>
        <div class="rating_actions">
            <form action="" method="get">
                <div class="mb-3">
                    <select class="form-control" name="ratings" id="ratings">
                        <option value="null">Selectionner la note</option>
                        <?php for ($i = 0; $i <= 5; $i++) { ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php } ?>
                    </select>
                </div>
                <?php if (!isset($_SESSION['LOGGED_USER'])) : ?>
                    <div class="alert alert-info"><small>Connecter vous pour noter</small></div>
                <?php else : ?>
                    <button type="submit" class="btn btn-dark">Noter</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="rating_stats mt-4 bg-light h-50 p-2">
            <h4 class="fw-bolder">Stats</h4>
            <div>
                <h6 className="text-app">Nombre personnes</h6>
                <hr>
                <p><strong><?= 0 ?></strong></p>
            </div>
            <div>
                <h6 className="text-app">Moyenne</h6>
                <hr>
                <p><strong><?= 0.0 ?></strong></p>
            </div>
        </div>
    </div>
</div>

</div>
<?php include_once('inc/footer.php'); ?>