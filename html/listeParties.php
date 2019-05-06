
<form action="../php/actions.php" method="post">
	<input type="submit" name="nouveauJeu" value="Créer une nouvelle partie"></form>
	<h1>Liste des parties en attente</h1>
	<table>
		<tr>
			<th>Identifiant partie</th>
			<th>Nombre d'inscrits</th>
			<th>Hôte de la partie</th>
		</tr>
	<?php $partiesEnAttente=$gerp->getAllPUnstarted();
	foreach($partiesEnAttente as $partie){
		 echo'<pre>';var_dump($partie);echo'</pre>';
		$donnes=$gerd->getAllDInPartie($partie->id_parties());
		$nbJoueur= count($donnes);
echo"<tr><td>".$partie->id_parties()
."</td><td>".$nbJoueur
."</td><td>".$partie->id_host()
.'</td><td><form action="../php/actions.php" method="post">';
$participation=false;
foreach($donnes as $donne){
	if($donne->id_joueur() == $_SESSION['id_joueur']){
		$participation=true;
	}
}
if($participation==true){
	echo '<button type="submit" name="desinscriptionPartie" value="'.$partie->id_parties()
	.'">Se désinscrire</button</form>';
}
else{
echo '<button type="submit" name="inscriptionPartie" value="'.$partie->id_parties()
.'">S\'inscrire</button</form>';}
echo "</td></tr>";
	}?>
</table>

	<h1>Liste des parties en cours</h1>
	<table>
		<tr>
			<th>Identifiant partie</th>
			<th>Nombre de joueurs</th>
			<th>Phase de jeu</th>
			<th>Joueur actif</th>
		</tr>
	<?php $partiesEnCours=$gerp->getAllPStarted();
	foreach($partiesEnCours as $partie){
		$donnes=$gerd->getAllDInPartie($partie->id_parties());
		$joueurActif=$geru->getNameU($gerd->getIdActif());
		$nbJoueur= count($donnes);
echo"<tr><td>".$partie->id_parties()
."</td><td>".$nbJoueur
."</td><td>".$partie->phase()
."</td><td>".$joueurActif;
$participation=false;
foreach($donnes as $donne){
	if($donne->id_joueur() == $_SESSION['id_joueur']){
		$participation=true;
	}
}
if($participation==true){
	echo "</td><td> Vous participez";
}
echo "</td></tr>";
	}?>
</table>
