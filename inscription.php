<?php

require_once('inc/init.php');
$title="Inscription";
$inscription = false;

if(!empty($_POST)){
  // le formulaire est posté

  // Controle des champs vides
  $nb_champs_vides = 0;
  foreach($_POST as $value){
    if( empty($value)  ) $nb_champs_vides++;
  }
  if ( $nb_champs_vides > 0){
    $content .= '<div class="alert alert-danger">Il manque '.$nb_champs_vides.' information(s)</div>';
  }

  // vérif du pseudo
  $verif_pseudo = preg_match('#^[\w.-]{3,20}$#',$_POST['pseudo']);
  if( !$verif_pseudo ){
    $content .= '<div class="alert alert-danger">Le pseudo doit comporter entre 3 et 20 caractères (a à z, A à Z, 0 à 9 et .,-,_)</div>';
  }




  if ( empty($content) ){
    // je n'ai pas d'erreur

    // contrôler l'unicité du pseudo
    $verif_membre = execRequete("SELECT * FROM utilisateurs WHERE pseudo=:pseudo",array('pseudo' => $_POST['pseudo']));
    if ( $verif_membre->rowCount() > 0 ){
      $content .= '<div class="alert alert-danger">Pseudo indisponible, merci d\'en choisir un autre</div>';
    }
    else{
      extract($_POST);
      // génère des variables avec le nom des index
      execRequete("INSERT INTO utilisateurs VALUES (NULL,:pseudo,:mdp,NOW(),1000,0)",array(
        'pseudo' => $pseudo,
        'mdp' => md5($mdp . SALT)
      ));
      $inscription = true;
      $content .= '<div class="alert alert-success">Vous êtes inscrit! <a href="' . URL . 'connexion.php">Cliquer ici pour vous connecter</a></div>';
    }
  }
}

require_once('inc/header.php');
echo $content;
// page d'inscription
if (!$inscription) :
?>
<h1>Formulaire d'inscription</h1>
<form method="post" action="">
  <fieldset>
    <legend>Identifiants</legend>

    <div class="form-group">
      <label for="pseudo">Pseudo</label>
      <input type="text" name="pseudo" id="pseudo" class="form-control" value="<?= $_POST['pseudo'] ?? '' ?>">
    </div>
    <div class="form-group">
      <label for="mdp">Mot de passe</label>
      <input type="password" name="mdp" id="mdp" class="form-control" value="">
    </div>

  </fieldset>
  <input type="submit" class="btn btn-primary" value="S'inscrire">
</form>
<?php
endif;

require_once('inc/footer.php');
