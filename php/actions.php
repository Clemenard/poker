<?
// Création d'une partie

if(isset($_POST['nouveauJeu'])){
$gerp->addP($_SESSION['idJoueur']); // création d'une partie dans la bdd
$nouvellePartie=$gerp->getlastP(); // sélection de la partie générée
$gerd->addD($nouvellePartie->id_partie(),$_SESSION['idJoueur']); // création d'une donne associée à la partie et son créateur
return 'Vous avez crée une nouvelle partie';
}

// Se joindre à une partie
if(isset($_POST['inscriptionPartie'])  ){
	$doubleInscription=$gerd->testPresence($_SESSION['idJoueur']);// teste si le joueur est déja inscrit
	if(!$doubleInscription){
		$gerd->addD($_POST['inscriptionPartie'],$_SESSION['idJoueur']); // création d'une donne associée à la partie et au joueur
return 'Vous vous êtes joint à la partie';
	}
	else{
	return 'Vous êtes déja inscrit dans la partie';
	}
}

// Se retirer d'une partie
if(isset($_POST['desinscriptionPartie'])  ){
	$doubleInscription=$gerd->testPresence($_SESSION['idJoueur']);// teste si le joueur est déja inscrit
	if(!$doubleInscription){
		$gerd->deleteD($_POST['desinscriptionPartie'],$_SESSION['idJoueur']); // destruction de la donne associée à la partie et au joueur
return 'Vous vous êtes retiré de la partie';
	}
	else{
	return "Vous n'étiez pas inscrit dans la partie";
	}
}

// Lancer une partie
if(isset($_POST['lancementPartie'])  ){
	$partie=$gerp>getP($_POST['lancementPartie']);//objet Partie chargé
	$donnes=$gerd->getAllDInPartie($_POST['lancementPartie']);// array des objets Donne chargé
	$nbJoueur= count($donnes); // nombre de joueurs dans la partie
	if($nbJoueur<2){
		return "Il faut au moins deux joueurs pour lancer la partie";
	}
		else if($partie->phase()!=1){
		return "La partie est déja lancée";}
		else{
$partie->setPhase($partie->phase()+1);
$gerp->updateP($partie); // update de la phase de jeu


$i=1;


foreach($donnes as $donne){
	$donne->setOrdre($i);
	// $carte=fonction d'Axel -- fonction de tirage d'une carte aléatoire sans doublon
	$donne->setCarte1($carte);
	// $carte=fonction d'Axel -- fonction de tirage d'une carte aléatoire sans doublon
	$donne->setCarte2($carte);
if($i==2){$donne->setMise(10);}
else if(($nbJoueur==2 && $i==1) || $i==3 ){$donne->setMise(20);}

 if(($nbJoueur==2 && $i==2) || ($nbJoueur==3 && $i==1) || ($nbJoueur>3 && $i==4)){
	 $donne->setJoueurActif(true);
 }
}
return 'La partie est bien lancée';
}
}
?>
