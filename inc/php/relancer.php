<?
if(isset($_POST['relancer'])  ){
  $resultat=execRequete('SELECT * FROM parties WHERE id_partie = :id',array("id"=>$_GET['id']));
  $partie=$resultat->fetch();
  $resultat=execRequete('SELECT * FROM donnes WHERE id_partie = :id AND id_utilisateur=:id_u',array("id"=>$_GET['id'],"id_u"=>$_SESSION['membre']['id_utilisateur']));
  $donne=$resultat->fetch();
  $resultat=execRequete('SELECT max(mise) as miseMax FROM donnes WHERE id_partie = :partie',array(':partie'=>$partie['id_partie']));
  $miseMax=$resultat->fetch();
  $resultat=execRequete('SELECT * FROM utilisateurs WHERE id_utilisateur = :id_u',array("id_u"=>$_SESSION['membre']['id_utilisateur']));
  $joueur=$resultat->fetch();
  if(intval($_POST['relancer'])<intval($miseMax['miseMax'])+20 || intval($_POST['relancer'])>intval($joueur['jetons'])) {



	if($donne('statut')!=1){
		$_SESSION['erreur']=  "Ce n'est pas à votre tour de jouer";
	}
	else{



//test de nouvelle phase
    $resultat=execRequete('SELECT * FROM donnes WHERE id_partie = :id AND ordre=:ordre',array("id"=>$_GET['id'],"ordre"=>intval($donne['ordre'])+1));
    if($resultat->rowCount()==0){
    $resultat=execRequete('SELECT * FROM donnes WHERE id_partie = :id AND ordre=1',array("id"=>$_GET['id']));  }
    $donneSuivante=$resultat->fetch();
    $resultat=execRequete('SELECT max(mise) as miseMax FROM donnes WHERE id_partie = :partie',array(':partie'=>$partie['id_partie']));
    $miseMax=$resultat->fetch();

//update de joueur
$joueur['jetons']-=($miseMax['miseMax']-$donne['mise']+intval($_POST['relancer']));
$_SESSION['membre']['jetons']=$joueur['jetons'];
$donne['mise']=$miseMax['miseMax']+intval($_POST['relancer']);

    execRequete('UPDATE   donnes SET statut =:statut,id_carte1 =:id_carte1,id_carte2 =:id_carte2,mise =:mise WHERE id_utilisateur = :id_u 	AND id_partie = :id_p',
    array(':statut'=>$donne['statut'],':id_carte1'=>$donne['id_carte1'],':id_carte2'=>$donne['id_carte2'],':mise'=>$donne['mise'],':id_u'=>$donne['id_utilisateur'],':id_p'=>$donne['id_partie']));

    $resultat=execRequete('SELECT * FROM donnes WHERE id_partie = :partie ORDER BY ordre',array(':partie'=>$partie['id_partie']));
    $donnes=$resultat->fetchAll();
    if($donneMax['mise']==$miseMax['miseMax']){

//si tout le monde a suivi ou passé
// on réinitialise les mises que l'on transfère dans le pot, on tire les nouvelles cartes et on adapte le joueur actif et l'ordre de tour
      	$ordre=1;
      	foreach($donnes as $d){
          $partie['pot']+=$d['mise'];
      		if($d['statut']!=0){
            if($ordre==1){$d['statut']==1;}
            else{$d['statut']==2;}
            $d['ordre']=$ordre;
            $ordre++;
          }
          $d['mise']=0;
          execRequete('UPDATE   donnes SET statut =:statut,id_carte1 =:id_carte1,id_carte2 =:id_carte2,mise =:mise WHERE id_utilisateur = :id_u 	AND id_partie = :id_p',
          array(':statut'=>$donne['statut'],':id_carte1'=>$donne['id_carte1'],':id_carte2'=>$donne['id_carte2'],':mise'=>$donne['mise'],':id_u'=>$donne['id_utilisateur'],':id_p'=>$donne['id_partie']));
      		}
$partie['phase']=$partie['phase']+1;
if($partie['phase']==2){
  $partie['id_carte_flop1']=tirageCarte($_GET['id']);
  $partie['id_carte_flop2']=tirageCarte($_GET['id']);
  $partie['id_carte_flop3']=tirageCarte($_GET['id']);
}
  else if($partie['phase']==3){
    $partie['id_carte_turn']=tirageCarte($_GET['id']);
  }
  else if($partie['phase']==4){
    $partie['id_carte_river']=tirageCarte($_GET['id']);
  }
    else{
      findepartie($_GET['id']);
    }
     execRequete('UPDATE  parties SET phase =:phase,id_carte_flop2=:id_carte_flop2,id_carte_flop1=:id_carte_flop1,id_carte_flop3=:id_carte_flop3,id_carte_turn=:id_carte_turn,id_carte_river=:id_carte_river,
        WHERE id_partie = :partie',array(':phase'=>$partie['phase'],':partie'=>$partie['id_partie'],':id_carte_flop1'=>$partie['id_carte_flop1'],':id_carte_flop2'=>$partie['id_carte_flop2'],
      ':id_carte_flop3'=>$partie['id_carte_flop3'],':id_carte_turn'=>$partie['id_carte_turn'],':id_carte_river'=>$partie['id_carte_river']));
      }
      else{
        //sinon
// on retire le joueur ayant passé de l'ordre de tour et on change de joueur actif
$ordre=1;
      	foreach($donnes as $d){
      		if($d['statut']!=0){

            $d['ordre']=$ordre;
            $ordre++;
          }
          $d['mise']=0;
          execRequete('UPDATE   donnes SET statut =:statut,id_carte1 =:id_carte1,id_carte2 =:id_carte2,mise =:mise WHERE id_utilisateur = :id_u 	AND id_partie = :id_p',
          array(':statut'=>$donne['statut'],':id_carte1'=>$donne['id_carte1'],':id_carte2'=>$donne['id_carte2'],':mise'=>$donne['mise'],':id_u'=>$donne['id_utilisateur'],':id_p'=>$donne['id_partie']));
      		}
          $resultat=execRequete('SELECT * FROM donnes WHERE id_partie = :id AND id_utilisateur=:id_u',array("id"=>$_GET['id'],':id_u'=>$donneSuivante['id_utilisateur']));
          $donneSuivante=$resultat->fetch();
          $donneSuivante['statut']==1;
          execRequete('UPDATE   donnes SET statut =:statut,id_carte1 =:id_carte1,id_carte2 =:id_carte2,mise =:mise WHERE id_utilisateur = :id_u 	AND id_partie = :id_p',
          array(':statut'=>$donneSuivante['statut'],':id_carte1'=>$donneSuivante['id_carte1'],':id_carte2'=>$donneSuivante['id_carte2'],':mise'=>$donneSuivante['mise'],':id_u'=>$donneSuivante['id_utilisateur'],':id_p'=>$donneSuivante['id_partie']));

  		}
    }


	}else{
  $_SESSION['erreur']=  "Votre mise n'est pas valide : elle doit être comprise entre la mise actuelle+blind et votre total de jetons";
  }
}
?>
