
<form action="actions.php" method="post">
	<input type="submit" name="nouveauJeu" value="Créer une nouvelle partie"></form>
	<h1>Liste des parties en attente</h1>
	<table>
		<tr>
			<th>Identifiant partie</th>
			<th>Nombre d'inscrits</th>
			<th>Hôte de la partie</th>
		</tr>
	<?php $partiesEnAttente=$gerp->getAllPhase0P();
	foreach($partiesEnAttente as $partie){
		$donnes=$gerd->getAllDInPartie($partie->id_partie());
		$nbJoueur= count($donnes);
echo"<tr><td>".$partie->id_partie()
."</td><td>".$nbJoueur
."</td><td>".$partie->id_host()
.'</td><td><form action="actions.php" method="post">';
$participation=false;
foreach($donnes as $donne){
	if($donne->id_joueur() == $_SESSION['id_joueur']){
		$participation=true;
	}
}
if($participation==true){
	echo '<button type="submit" name="desinscriptionPartie" value="'.$partie->id_partie()
	.'">Se désinscrire</button</form>';
}
else{
.'<button type="submit" name="inscriptionPartie" value="'.$partie->id_partie()
.'">S\'inscrire</button</form>';}
."</td></tr>";
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
	<?php $partiesEnCours=$gerp->getAllEnCoursP();
	foreach($partiesEnCours as $partie){
		$donnes=$gerd->getAllDInPartie($partie->id_partie());
		$joueurActif=$geru->getNameU($gerd->getIdActif());
		$nbJoueur= count($donnes);
echo"<tr><td>".$partie->id_partie()
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
