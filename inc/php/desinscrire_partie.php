<?
if(isset($_POST['desinscriptionPartie'])  ){
  $resultat=execRequete('SELECT * FROM donnes WHERE id_utilisateur = :id_u AND id_partie=:id_p',array('id_u'=>$_SESSION['membre']['id_utilisateur'],'id_p'=>$_POST['desinscriptionPartie']));
  if($resultat->rowCount()>0){
execRequete('DELETE FROM donnes WHERE id_utilisateur = :id_u AND id_partie=:id_p',array('id_u'=>$_SESSION['membre']['id_utilisateur'],'id_p'=>$_POST['desinscriptionPartie']));
  $resultat=execRequete('SELECT * FROM donnes WHERE  id_partie=:id_p',array('id_p'=>$_POST['desinscriptionPartie']));
if($resultat->rowCount()==0){
  execRequete('DELETE FROM parties WHERE  id_partie=:id_p',array('id_p'=>$_POST['desinscriptionPartie']));
}
	}
	else{
	$_SESSION['erreur']=  "Vous n'étiez pas inscrit dans la partie";
	}
  header('Location: '.URL.'parties.php');
  exit();
}
?>
