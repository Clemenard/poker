<?
if(isset($_POST['inscriptionPartie'])  ){
  $resultat=execRequete('SELECT * FROM donnes WHERE id_utilisateur = :id_u AND id_partie=:id_p',array('id_u'=>$_SESSION['membre']['id_utilisateur'],'id_p'=>$_POST['inscriptionPartie']));
  if($resultat->rowCount()==0){
    execRequete('INSERT INTO donnes(id_partie,id_utilisateur) VALUES(:id_partie,:id_utilisateur)  ',array('id_partie'=>$_POST['inscriptionPartie'],'id_utilisateur'=>$_SESSION['membre']['id_utilisateur']));
$_SESSION['erreur']=  'Vous vous êtes joint à la partie';
header('Location: '.URL.'parties.php');
exit();
	}
	else{
	$_SESSION['erreur']=  'Vous êtes déja inscrit dans la partie';
  header('Location: '.URL.'parties.php');
  exit();
	}
}
?>
