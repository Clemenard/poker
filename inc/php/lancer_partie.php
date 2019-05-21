<?
echo"blabla";
if(isset($_POST['lancementPartie'])  ){
	echo"blabla";
	$resultat=execRequete('SELECT * FROM parties  WHERE id_partie=:id',array('id'=>$_POST['lancementPartie']));
$nouvellePartie=$resultat->fetch();
$resultat=execRequete('SELECT * FROM donnes WHERE id_partie = :partie',array(':partie'=>$_POST['lancementPartie']));
$donnes=$resultat->fetchAll();
	$nbJoueur= count($donnes); // nombre de joueurs dans la partie
	if($nbJoueur<2){
		$_SESSION['erreur']=  "Il faut au moins deux joueurs pour lancer la partie";
	}
		else if($nouvellePartie['phase']!=0){
		$_SESSION['erreur']=  "La partie est déja lancée";}
		else{
$nouvellePartie['phase']=$nouvellePartie['phase']+1;

 execRequete('UPDATE  parties SET phase =:phase WHERE id_partie = :partie',array(':phase'=>intval($nouvellePartie['phase']),':partie'=>intval($_POST['lancementPartie'])));

$i=1;

foreach($donnes as $donne){
	$donne['ordre']=$i;
	$carte=53;
	$donne['id_carte1']=tirageCarte($_POST['lancementPartie']);
	$donne['id_carte2']=tirageCarte($_POST['lancementPartie']);
if($i==2){$donne['mise']=10;}
else if(($nbJoueur==2 && $i==1) || $i==3 ){$donne['mise']=20;}

 if(($nbJoueur==2 && $i==2) || ($nbJoueur==3 && $i==1) || ($nbJoueur>3 && $i==4)){
	 $donne['statut']=1;
 }
 else{$donne['statut']=2;}
 execRequete('UPDATE   donnes SET statut =:statut,id_carte1 =:id_carte1,id_carte2 =:id_carte2,mise =:mise,ordre=:ordre WHERE id_utilisateur = :id_u 	AND id_partie = :id_p',
 array(':statut'=>$donne['statut'],':ordre'=>$donne['ordre'],':id_carte1'=>$donne['id_carte1'],':id_carte2'=>$donne['id_carte2'],':mise'=>$donne['mise'],':id_u'=>$donne['id_utilisateur'],':id_p'=>$donne['id_partie']));
 $i++;
}
$_SESSION['erreur']=  'La partie est bien lancée';
}
header('Location: '.URL.'partie.php?id='.$_POST['lancementPartie']);
exit();
}
?>
