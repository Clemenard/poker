<?php

require_once('../inc/init.php');
$title = 'Gestion des Membres';

// Controle des autorisations
if( !isAdmin() ){
  header('location:' . URL . 'connexion.php');
  exit();
}
require_once('../inc/header.php');

// page de gestion des membres

require_once('../inc/footer.php');