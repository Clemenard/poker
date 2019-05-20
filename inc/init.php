<?php

// Fuseau horaire
date_default_timezone_set('Europe/Paris');

// Session
session_start();

// Connexion à la BDD
$pdo = new PDO(
  'mysql:host=localhost;dbname=poker',
  'root',
  'root',
  array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  )
);

// Constantes de site
define('URL','/poker_fredo/');
define('SALT','Comp!iqu3');

// Initialisation de variables
$content = '';
$left_content = '';
$right_content = '';

// Inclusion du fichier de fonctions
require_once('functions.php');
