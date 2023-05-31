<?php 
$titlePage="Tableau de bord";
require_once('../inc/header.php');
?>
<div class="card mt-5">
    <div class="card-header">Tableau de board</div>
    <div class="card-body">
        <p>Bonjour et bienvenue sur le site <strong> <?php echo $_SESSION['LOGGED_USER']['username']; ?></strong></p>
    </div>
</div>
</div>
<?php
require_once("../inc/footer.php");