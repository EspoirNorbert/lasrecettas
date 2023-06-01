<?php
session_start();
$titlePage = "Se connecter";
require_once('inc/header.php');

if (isset($_POST['btnSignup'])) {

    if ((isset($_POST['username']) && !empty($_POST["username"])) &&
        (isset($_POST['username']) && !empty($_POST["username"])) && 
        (isset($_POST['password']) && !empty($_POST["password"])) && 
        (isset($_POST['confirm_password']) && !empty($_POST["confirm_password"]))
    ) {

        if ($_POST["password"] != $_POST["confirm_password"]){
            $errorMessage = "Les mots de passe ne correspondent pas !";
        } else {
            require_once("./config/database.php");
            $sql = "SELECT count(*) as total FROM users where email=:email";
            $userStatement = $db->prepare($sql);
            $userStatement->execute([
                'email' => $_POST['email'],
            ]);
            $user = $userStatement->fetch(PDO::FETCH_ASSOC);
            $resultTotal = $user['total'];

            if ($resultTotal == 0){
                // insert donnes
                extract($_POST);
                $insertUser = $db->prepare('INSERT INTO users(username, age, email,password) VALUES (:username, :age,:email,:password)');
                $insertUser->execute([
                    'username' => $username,
                    'age' => $age,
                    'email' => $email,
                    'password' => $password
                ]);
                $_SESSION["flash"]['success'] =  "Votre compte a été crée avec success ! Vous pouvez vous connecter !";
                // redirect
                header("location: login.php");
            } else {
                $errorMessage = "L'adresse mail " . $_POST['email'] . " est deja utilisée.";
            }
        }
    } else {
        $errorMessage = "Veuillez remplir tous les champs !";
    }
}

?>
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
                    <input type="password" class="form-control" id="password" name="confirm_password" placeholder="***********">
                </div>
            </div>
        </div>
        <button type="submit" name="btnSignup" class="btn btn-dark">Creer le compte</button>
    </form>
</div>
<?php
require_once("inc/footer.php");
