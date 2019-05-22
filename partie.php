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
  // var_dump($maDonne);
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
    <h3>La table : Phase de <?
    switch($partie['phase']){
    case 1 : echo "Blind";break;
    case 2 : echo "Flop";break;
    case 3 : echo "Turn";break;
    case 4 : echo "River";break;
    default : echo "Showdown";break;
    } ?></h3>
    <?
    if($partie['phase']>4){

      echo '<p>Vous avez '.annonce($maDonne['score']).'</p>';
      if($maDonne['statut'] == 4){
      echo '<p>Vous avez gagné la partie</p>';  
      }
    }
    ?>
    <div>
      <img class="carte" src="<?= URL.'photo/cartes/carte_'.$partie['id_carte_flop1'].'.jpg' ?>" alt="">
      <img class="carte" src="<?= URL.'photo/cartes/carte_'.$partie['id_carte_flop2'].'.jpg' ?>" alt="">
      <img class="carte" src="<?= URL.'photo/cartes/carte_'.$partie['id_carte_flop3'].'.jpg' ?>" alt="">
      <img class="carte" src="<?= URL.'photo/cartes/carte_'.$partie['id_carte_turn'].'.jpg' ?>" alt="">
      <img class="carte" src="<?= URL.'photo/cartes/carte_'.$partie['id_carte_river'].'.jpg' ?>" alt="">
    </div>

    <table>
      <tr>
        <th>Joueur</th>
        <? if($partie['phase']>4){ ?>
          <th>Cartes</th>
          <th>Score</th>
        <? }else {?>
          <th>Jetons</th>
        <th>Statut</th>
      <? } ?>
      </tr>

    <?
    foreach($donnes as $d){
      $resultat=execRequete('SELECT * FROM utilisateurs WHERE id_utilisateur = :id',array(':id'=>$d['id_utilisateur']));
  		$joueur=$resultat->fetch();
      $joueur['pseudo'];
    echo'<tr ';
if($d['statut'] == 0 && $partie['phase']<=4){echo 'class="gris"';}
else if($d['statut'] == 1 && $partie['phase']<=4){echo 'class="vert"';}
else if($d['statut'] == 4 && $partie['phase']>4){echo 'class="gold"';}
    echo '><td><a href="'.URL.'compte.php?id='.$d['id_utilisateur'].'">'.$joueur['pseudo']
    .'</a></td><td>';
     if($partie['phase']>4){
       echo'<img class="carte" src="'. URL.'photo/cartes/carte_'.$d['id_carte1'].'.jpg" alt="carte">';
       echo'<img class="carte" src="'. URL.'photo/cartes/carte_'.$d['id_carte2'].'.jpg" alt="carte">';
       echo '</td><td>'.annonce($d['score']).'</td><td>';}
       else{
         echo $d['mise'].'</td><td>';
    if($d['statut']==0){echo 'PASSE';}else if($d['statut']==1){echo 'ACTIF';}else{echo 'ATTEND';}
    echo '</td>';
    if($d['statut']==1 && $d['id_utilisateur']==$_SESSION['membre']['id_utilisateur']){
      if($joueur['jetons']>($miseMax['miseMax']-$maDonne['mise']+20)){
        echo '<form action="" method="post"><input name="relancer" type="number" min="'.( intval($miseMax['miseMax']+20)).' max="'. intval($joueur['jetons']) .'" step="20" /><button type="submit"  value="'.$partie['id_partie']
        .'">Relancer</button></form>';}
       if($joueur['jetons']>($miseMax['miseMax']-$maDonne['mise'])){
        echo '<form action="" method="post"><button type="submit" name="suivre" value="'.$partie['id_partie']
    .'">Suivre</button></form>';}
    echo '<form action="" method="post"><button type="submit" name="passer" value="'.$partie['id_partie']
    .'">Passer</button></form>';

  }
  echo'</tr>';
}}
  ?></table><?  ?>
  <h3>Ma main</h3>
  <img class="carte" src="<?= URL.'photo/cartes/carte_'.$maDonne['id_carte1'].'.jpg' ?>" alt="carte">
  <img class="carte" src="<?= URL.'photo/cartes/carte_'.$maDonne['id_carte2'].'.jpg' ?>" alt="carte"><?
}
}



require_once('inc/footer.php');
