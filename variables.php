<?php

// récupération des variables àl'aide du client MySQL
$usersStatement = $mysqlClient->prepare('SELECT * FROM users');
$usersStatement->execute();
$users = $usersStatement->fetchAll();

$recipesStatement = $mysqlClient->prepare('SELECT * FROM recipes WHERE is_enabled is TRUE');
$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll();
/*
$users = [
    [
        'full_name' => 'Mickaël Andrieu',
        'email' => 'user@exemple.com',
        'age' => 34,
        'password' => 'devine',
    ],
    [
        'full_name' => 'Mathieu Nebra',
        'email' => 'mathieu.nebra@exemple.com',
        'age' => 34,
        'password' => 'MiamMiam',
    ],
    [
        'full_name' => 'Laurène Castor',
        'email' => 'laurene.castor@exemple.com',
        'age' => 28,
        'password' => 'laCasto28',
    ],
    [
        'full_name' => 'Marcel Lawson',
        'email' => 'marcel.lawson@exemple.com',
        'age' => 45,
        'password' => 'Marcelo2013',
    ],
    [
        'full_name' => 'Rebecca Odoua',
        'email' => 'odouarebecca@gmail.com',
        'age' => 17,
        'password' => 'rebecca2005',
    ],
];

$recipes = [
    [
        'title' => 'Cassoulet',
        'recipe' => '',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => true,
    ],
    [
        'title' => 'Couscous',
        'recipe' => '',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => false,
    ],
    [
        'title' => 'Escalope milanaise',
        'recipe' => '',
        'author' => 'mathieu.nebra@exemple.com',
        'is_enabled' => false,
    ],
    [
        'title' => 'Salade Romaine',
        'recipe' => '',
        'author' => 'laurene.castor@exemple.com',
        'is_enabled' => true,
    ],
    [
        'title' => 'Fufu Sauce Gombo',
        'recipe' => '',
        'author' => 'marcel.lawson@exemple.com',
        'is_enabled' => true,
    ],
];*/
if(isset($_GET['limit']) && is_numeric($_GET['limit'])) {
    $limit = (int) $_GET['limit'];
} else {
    $limit = 100;
}
