<?php session_start();
require_once('functions.php')
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $titlePage ?> - Site de Recettes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../css/index.css">
</head>
<body class="d-flex flex-column min-vh-100">
  <?php
  if (isset($_SESSION['LOGGED_USER'])) {
    include_once('nav_auth.php');
  } else {
    include_once('nav.php');
  }
  ?>
  <div class="container mb-5">
    <?php display_flash_message(); ?>