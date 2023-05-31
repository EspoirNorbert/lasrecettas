<?php
$db = new PDO(
    'mysql:host=localhost;dbname=recettes;charset=utf8',
    'root',
    'root',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
);
if(!$_SESSION['adp'] || !$_SESSION['name'])
{
    header('Location: home.php');
}
if(!isset($_GET['id']) && !empty($_GET['id'])){
    $getid = $_GET['id'];
    $getrecipe=$db->prepare('SELECT * FROM reccette WHERE id=?');
    $getrecipe->execute(array($getid));
    if($getrecipe->rowCount() > 0)
    {
        $deleterecipe = $db->prepare('DELETE FROM recette WHERE id = ?');
    $deleterecipe->execute(array($getid));
    header('Location: recette.php ');
    }

    else{
        echo("Aucune recette trouvé");
}
}

?>