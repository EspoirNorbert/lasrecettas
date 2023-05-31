<?php
$titlePage = "Se connecter";
require_once('inc/header.php');
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
        } else {
            $errorMessage = sprintf(
                'Les informations envoyées ne permettent pas de vous identifier : (%s%s)',
                $_POST['email'],
                $_POST['password']
            );
        }
    }
}
?>

<?php if (!isset($_SESSION['LOGGED_USER'])) : ?>
    <h3 class="mt-3 fw-bolder">Creation de compte</h3>
    <hr>
    <form action="" method="post">
        <?php if (isset($errorMessage)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="username" class="form-label">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="username-help" placeholder="John doe">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="johndoe@exemple.com">
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" min="1" class="form-control" id="age" name="age" aria-describedby="age-help">
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="***********">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="password" class="form-label">Confirmation du mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="***********">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-dark">Creer le compte</button>
    </form>
    <!-- Affichage du bloc de succès -->
<?php else : ?>
    <div class="alert alert-success" role="alert">
        <!-- Souhaiter la bienvenue -->
        Bonjour et bienvenue sur le site <?php echo $_SESSION['LOGGED_USER']; ?>
    </div>
<?php endif; ?>
</div>
<?php
require_once("inc/footer.php");
