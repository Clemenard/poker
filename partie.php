<?php

require_once('inc/init.php');
$title = 'Ma partie';

require_once('inc/header.php');

if(isset($_GET['id'])){

  $resultat=execRequete('SELECT * FROM parties WHERE id_partie = :id',array("id"=>$_GET['id']));
  $partie=$resultat->fetch();
  if($partie['phase']==0){
    ?>   <table>
        <tr>
          <th>Pseudo</th>
          <th>Jetons</th>
        </tr>
        <?
    $resultat=execRequete('SELECT * FROM donnes WHERE id_partie = :partie',array(':partie'=>$partie['id_partie']));
    $donnes=$resultat->fetchAll();
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
}



require_once('inc/footer.php');
