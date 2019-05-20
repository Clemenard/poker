<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Eragny Poker Tour | <?= $title ?></title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

  <link rel="stylesheet" href="<?= URL . 'inc/css/style.css' ?>">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="<?= URL . 'inc/js/functions.js' ?>"></script>

</head>
<body>
  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="<?= URL ?>">Eragny Poker Tour</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item
          <?= ($title == 'Accueil') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= URL ?>">Accueil <span class="sr-only">Accueil</span></a>
          </li>
          <?php
          if ( !isConnected() ) :
          ?>
            <li class="nav-item
            <?= ($title == 'Inscription') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= URL . 'inscription.php' ?>">Inscription</a>
            </li>
            <li class="nav-item
            <?= ($title == 'Connexion') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= URL . 'connexion.php' ?>">Connexion</a>
            </li>
          <?php
          else :
          ?>
            <li class="nav-item
            <?= ($title == 'Mon compte') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= URL . 'compte.php' ?>">Mon compte</a>
            </li>
            <li class="nav-item
            <?= ($title == 'Mes commandes') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= URL . 'parties.php' ?>">Liste des parties</a>
            </li>
            <li class="nav-item
            <?= ($title == 'Connexion') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= URL . 'connexion.php?action=deconnexion' ?>">Déconnecter</a>
            </li>
          <?php
          endif;
          if( isAdmin() ):
            ?>
            <li class="nav-item <?= (substr($title,0,7)=='Gestion') ? 'active': '' ?> dropdown">
              <a class="nav-link  dropdown-toggle" href="#" id="menuadmin" role="button" data-toggle="dropdown">
              <i class="fas fa-tools"></i> Admin</a>
              <div class="dropdown-menu" aria-labelledby="menuadmin">
                <a class="dropdown-item <?= ($title=='Gestion des Produits') ? 'active' : '' ?>" href="<?= URL . 'admin/gestion_produits.php' ?>">Gestion des produits</a>
                <a class="dropdown-item <?= ($title=='Gestion des Membres') ? 'active' : '' ?>" href="<?= URL . 'admin/gestion_membres.php' ?>">Gestion des membres</a>
                <a class="dropdown-item <?= ($title=='Gestion des Commandes') ? 'active' : '' ?>" href="<?= URL . 'admin/gestion_commandes.php' ?>">Gestion des commandes</a>
              </div>
            </li>
            <?php
          endif;
          ?>
        </ul>
        <? if(isset($_SESSION['erreur'])){
          echo $_SESSION['erreur'];
          if(!empty($_SESSION['erreur'])){
         ?>
        <div class="alert alert-danger"><? echo $_SESSION['erreur']; ?> </div>
      </div><? $_SESSION['erreur']='';
    }} ?>
    </nav>
  </header>
  <main class="container">
