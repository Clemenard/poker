<?
 include 'sgbdLoader.php';

//Connexion
if(isset($_POST['pseudo']) && isset($_POST['password'])){
  $utilisateur=$geru->getUByPseudo($_POST['pseudo']);
//  echo $utilisateur->id_utilisateurs()." test";
 echo'<pre>';var_dump($utilisateur);echo'</pre>';
if(!is_bool($utilisateur)) {
if($utilisateur->password()==$_POST['password']){
	return "Mot de passe incorrect";
}
else{
    echo'<pre>';var_dump($utilisateur);echo'</pre>';
	$_SESSION['id_utilisateur']=$utilisateur->id_utilisateurs();
	$_SESSION['pseudo']=$utilisateur->pseudo();
	$_SESSION['jetons']=$utilisateur->jetons();
}
}
else{




	$geru->addU($_POST['pseudo'],$_POST['password']);
  $utilisateur=$geru->getUByPseudo($_POST['pseudo']);
	$_SESSION['id_utilisateur']=$utilisateur->id_utilisateurs();
  echo'<pre>';var_dump($utilisateur);echo'</pre>';
	$_SESSION['pseudo']=$utilisateur->pseudo();
	$_SESSION['jetons']=$utilisateur->jetons();
}
}
// Déconnexion
if(isset($_POST['deconnexion'])) {
  session_destroy();}

// Création d'une partie

if(isset($_POST['nouveauJeu'])){
$gerp->addP($_SESSION['id_utilisateur']); // création d'une partie dans la bdd
$nouvellePartie=$gerp->getlastP(); // sélection de la partie générée
$gerd->addD($nouvellePartie->id_parties(),$_SESSION['id_utilisateur']); // création d'une donne associée à la partie et son créateur
return 'Vous avez crée une nouvelle partie';
}

// Se joindre à une partie
if(isset($_POST['inscriptionPartie'])  ){
	$doubleInscription=$gerd->testPresence($_SESSION['id_utilisateur']);// teste si le joueur est déja inscrit
	if(!$doubleInscription){
		$gerd->addD($_POST['inscriptionPartie'],$_SESSION['id_utilisateur']); // création d'une donne associée à la partie et au joueur
return 'Vous vous êtes joint à la partie';
	}
	else{
	return 'Vous êtes déja inscrit dans la partie';
	}
}

// Se retirer d'une partie
if(isset($_POST['desinscriptionPartie'])  ){
	$doubleInscription=$gerd->testPresence($_SESSION['id_utilisateur']);// teste si le joueur est déja inscrit
	if(!$doubleInscription){
		$gerd->deleteD($_POST['desinscriptionPartie'],$_SESSION['id_utilisateur']); // destruction de la donne associée à la partie et au joueur
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
	 $donne->setJoueur_actif(true);
 }
}
return 'La partie est bien lancée';
}
}

// Passer sa main
if(isset($_POST['passerSaMain'])  ){
	$partie=$gerp->getP($_POST['passerSaMain']);
	$donne=$gerd->getMyD($_POST['passerSaMain'],$_SESSION['id_utilisateur']);


	if($donne->joueur_actif()==false){
		return "Ce n'est pas à votre tour de jouer";
	}
	else{
		$donnes=$gerd->getAllDInPartie($_POST['passerSaMain']);
		$donne->setStatut(0);
		$gerd->updateD($donne);
		$nouvellePhase=$gerd->verifStatut($_POST['passerSaMain']);
		if($nouvellePhase==false){

					$donne->changerJoueurActif($donnes);}

		else{
			$partie->setPhase($partie->phase()+1);
			$pot=$partie->pot();
			foreach ($donnes as $donne) {
			$pot+=$donne->mise();
			$donne->setStatut(1);
			$gerd->updateD($donne);
			}
			$partie->setPot($pot);
			$partie->nouvellePhase($partie->phase());
			// changement de joueur actif, code à rajouter

		}
	}
}

// suivre la mise
if(isset($_POST['suivreLaMise'])  ){
	$utilisateur=$geru->getMyU($_SESSION['id_utilisateur']);
	$partie=$gerp->getP($_POST['suivreLaMise']);
	$donne=$gerd->getMyD($_POST['suivreLaMise'],$_SESSION['id_utilisateur']);
	$donnes=$gerd->getAllDInPartie($_POST['passerSaMain']);

	if($utilisateur->jetons()>$_POST['suivreLaMise']){
		$utilisateur->setJetons($utilisateur->jetons()-$_POST['suivreLaMise']);
		$geru->updateJetonsJ($utilisateur);
		$donne->setMise($donne->mise()+$_POST['suivreLaMise']);
		$donne->changerJoueurActif($donnes);
		$topDonne=$gerd->getTopD();
	}


}

// enchérir la mise
if(isset($_POST['encherirLaMise'])  ){
	$utilisateur=$geru->getMyU($_SESSION['id_utilisateur']);
	$partie=$gerp->getP($_POST['encherirLaMise']);
	$donne=$gerd->getMyD($_POST['encherirLaMise'],$_SESSION['id_utilisateur']);
	$donnes=$gerd->getAllDInPartie($_POST['passerSaMain']);

	if($utilisateur->jetons()>$_POST['encherirLaMise']){
		$utilisateur->setJetons($utilisateur->jetons()-$_POST['encherirLaMise']);
		$geru->updateJetonsJ($utilisateur);
		$donne->setMise($donne->mise()+$_POST['encherirLaMise']);
		$donne->changerJoueurActif($donnes);
		$topDonne=$gerd->getTopD();
		$donne=$gerd->getMyD($_POST['suivreLaMise'],$_SESSION['id_utilisateur']);
		$topDonne->setStatus(1);
		$donne->setStatus(2);
		$gerd->updateD($donne);
		$gerd->updateD($topDonne);
	}


}

 header('Location: ../html/index.php');
?>
