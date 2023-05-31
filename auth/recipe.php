<?php
require_once("../conn_db/conn.php");

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

$titlePage = $title;
require_once('../inc/header.php');
?>
<h1><?= $title ?></h1>
<hr>
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
        <div class="rating_stats mt-4 bg-light  p-2">
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
<?php include_once('../inc/footer.php'); ?>