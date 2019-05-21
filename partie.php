<?php

require_once('inc/init.php');
require_once('inc/php/suivre.php');
require_once('inc/php/relancer.php');
require_once('inc/php/passer.php');
$title = 'Ma partie';

require_once('inc/header.php');

if(isset($_GET['id'])){

  $resultat=execRequete('SELECT * FROM parties WHERE id_partie = :id',array("id"=>$_GET['id']));
  $partie=$resultat->fetch();
  $resultat=execRequete('SELECT * FROM donnes WHERE id_partie = :partie',array(':partie'=>$partie['id_partie']));
  $donnes=$resultat->fetchAll();
  $resultat=execRequete('SELECT * FROM donnes WHERE id_partie = :partie AND id_utilisateur=:id_u',array(':partie'=>$partie['id_partie'],':id_u'=>$_SESSION['membre']['id_utilisateur']));
  $maDonne=$resultat->fetch();
  var_dump($maDonne);
  $resultat=execRequete('SELECT max(mise) as miseMax FROM donnes WHERE id_partie = :partie',array(':partie'=>$partie['id_partie']));
  $miseMax=$resultat->fetch();
  if($partie['phase']==0){
    ?>   <table>
        <tr>
          <th>Pseudo</th>
          <th>Jetons</th>
        </tr>
        <?

    $nbJoueur= count($donnes);
    foreach($donnes as $d){
      $resultat=execRequete('SELECT * FROM utilisateurs WHERE id_utilisateur = :id',array(':id'=>$d['id_utilisateur']));
  		$joueur=$resultat->fetch();
      $joueur['pseudo'];
    echo'<tr><td><a href="'.URL.'compte.php?id='.$d['id_utilisateur'].'">'.$joueur['pseudo']
    ."</a></td><td>".$joueur['jetons']
    .'</td></tr>';


    }
    ?>
</table>
<?
if($nbJoueur>1 &&  $_SESSION['membre']['id_utilisateur']==$partie['id_host']){
  echo '<form action="" method="post"><button type="submit" name="lancerPartie" value="'.$partie['id_partie']
  .'">Lancer la partie</button></form>';
}
  }
  else{ ?>
    <table>
      <tr>
        <th>Joueur</th>
        <th>Jetons</th>
        <th>Statut</th>
      </tr>

    <?
    foreach($donnes as $d){
      $resultat=execRequete('SELECT * FROM utilisateurs WHERE id_utilisateur = :id',array(':id'=>$d['id_utilisateur']));
  		$joueur=$resultat->fetch();
      $joueur['pseudo'];
    echo'<tr ';
if($d['statut'] == 0){echo 'class="gris"';}
else if($d['statut'] == 1){echo 'class="vert"';}
    echo '><td><a href="'.URL.'compte.php?id='.$d['id_utilisateur'].'">'.$joueur['pseudo']
    ."</a></td><td>".$d['mise']
    .'</td><td>';
    if($d['statut']==0){echo 'PASSE';}else if($d['statut']==1){echo 'ACTIF';}else{echo 'ATTEND';}
    echo '</td>';
    if($d['statut']==1 && $d['id_utilisateur']==$_SESSION['membre']['id_utilisateur']){
      if($joueur['jetons']>($miseMax['miseMax']-$donne['mise']+20)){
        echo '<form action="" method="post"><input name="relancer" type="number" min="'.( intval($miseMax['miseMax']+20)).' max="'. intval($joueur['jetons']) .'" step="20" /><button type="submit"  value="'.$partie['id_partie']
        .'">Relancer</button></form>';}
       if($joueur['jetons']>($miseMax['miseMax']-$donne['mise'])){
        echo '<form action="" method="post"><button type="submit" name="suivre" value="'.$partie['id_partie']
    .'">Suivre</button></form>';}
    echo '<form action="" method="post"><button type="submit" name="passer" value="'.$partie['id_partie']
    .'">Passer</button></form>';
    echo'</tr>';
  }}
  ?></table>
  <h3>Ma main</h3>
  <img class="carte" src="<?= URL.'photo/cartes/carte_'.$maDonne['id_carte1'].'.jpg' ?>" alt="carte">
  <img class="carte" src="<?= URL.'photo/cartes/carte_'.$maDonne['id_carte2'].'.jpg' ?>" alt="carte"><?
}
}



require_once('inc/footer.php');
