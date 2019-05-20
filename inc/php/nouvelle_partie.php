<?
if(isset($_POST['nouveauJeu'])){

  execRequete('INSERT INTO parties(id_host) VALUES(:id_host)  ',array(':id_host'=>$_SESSION['membre']['id_utilisateur']));
  $resultat=execRequete('SELECT * FROM parties  ORDER BY id_partie  DESC LIMIT 0,1',array());
$nouvellePartie=$resultat->fetch();
execRequete('INSERT INTO donnes(id_partie,id_utilisateur) VALUES(:id_partie,:id_utilisateur)  ',array('id_partie'=>$nouvellePartie['id_partie'],'id_utilisateur'=>$_SESSION['membre']['id_utilisateur']));
$_SESSION['erreur']= 'Vous avez crée une nouvelle partie';
header('Location: '.URL.'parties.php');
exit();
}
?>
