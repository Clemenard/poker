<?php

require_once('../inc/init.php');
$title = 'Gestion des Commandes';

// Controle des autorisations
if( !isAdmin() ){
  header('location:' . URL . 'connexion.php');
  exit();
}
require_once('../inc/header.php');

// page de gestion des commandes

require_once('../inc/footer.php');