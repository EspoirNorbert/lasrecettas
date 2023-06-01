<?php

/****
 * Ce script nous permet d'isoler la connexion à la base de données
 * Il doit renvoyer un object $pdo qui va representer la connexion
*/
define("DB_HOST","localhost");
define("DB_NAME","recipe_db");
define("DB_USERNAME","root");
define("DB_PASSWORD","");

$db = new PDO(
    'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',
    DB_USERNAME,
    DB_PASSWORD,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
) or die ("Echec de connexion à la base de données");

