<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Page d'accueil</title>
    <link
        href="../css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>
<?php include_once('header.php'); ?>
<?php
// Soumission du formulaire
if (isset($_POST['email']) &&  isset($_POST['password'])) {

    foreach ($users as $user) {
        // Utilisateur/trice trouvée !
        if (
            $user['email'] === $_POST['email'] &&
            $user['password'] === $_POST['password']
        ) {

            // Enregistrement de l'email de l'utilisateur en session
            $_SESSION['LOGGED_USER'] = $user['email'];
        }else{
            $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s%s)',
                $_POST['email'],
                $_POST['password']
            );
            }
    }
}
?>

<?php if(!isset($_SESSION['LOGGED_USER'])): ?>

<form action="home.php" method="post">
    <?php if(isset($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
        <div id="email-help" class="form-text">L'email utilisé lors de la création de compte.</div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>

<!-- Affichage du bloc de succès -->
<?php else: ?>
    <div class="alert alert-success" role="alert">

        <!-- Souhaiter la bienvenue -->
        Bonjour et bienvenue sur le site <?php echo $_SESSION['LOGGED_USER']; ?>
    </div>
    <?php endif; ?>

