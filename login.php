<?php
$titlePage = "Se connecter";
require_once('inc/header.php');


if (isset($_POST['btnLogin'])) {

    if ((isset($_POST['email']) && !empty($_POST["email"])) && 
        (isset($_POST['password']) && !empty($_POST["password"]))){

            require_once("./conn_db/conn.php");
            $sql = "SELECT * FROM users where email=:email AND password=:password";
            $userStatement = $db->prepare($sql);
            $userStatement->execute([
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ]);
            $user = $userStatement->fetch(PDO::FETCH_ASSOC);

            if (!$user){
                $errorMessage = "Les informations envoyées ne permettent pas de vous identifier";
            } else {
                extract($user);
                $_SESSION['LOGGED_USER'] = [
                    "userId" => $user_id,
                    "username" => $username,
                    "email" => $email,
                    "age" => $age,
                ];
                header("Location: auth");
            }
            

    } else {
        $errorMessage = "Veuillez remplir les champs email et mot de passe";
    }
   

    /*foreach ($users as $user) {
        // Utilisateur/trice trouvée !
        if (
            $user['email'] === $_POST['email'] &&
            $user['password'] === $_POST['password']
        ) {

            
        } else {
            $errorMessage = sprintf(
                'Les informations envoyées ne permettent pas de vous identifier : (%s%s)',
                $_POST['email'],
                $_POST['password']
            );
        }
    }*/
}
?>

<?php if (!isset($_SESSION['LOGGED_USER'])) : ?>
<h3 class="mt-3 fw-bolder">Connexion</h3>
<hr>
<form action="" method="post">
    <?php if (isset($errorMessage)) : ?>
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
    <button type="submit" name="btnLogin" class="btn btn-dark">Se connecter</button>
</form>
<!-- Affichage du bloc de succès -->
<?php else : ?>
    <div class="alert alert-success" role="alert">
        <!-- Souhaiter la bienvenue -->
        Bonjour et bienvenue sur le site <?php echo $_SESSION['LOGGED_USER']; ?>
    </div>
<?php  endif;?>
    </div>
<?php
require_once("inc/footer.php");