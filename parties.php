<?php

require_once('inc/init.php');
require_once('inc/php/nouvelle_partie.php');
require_once('inc/php/inscrire_partie.php');
require_once('inc/php/desinscrire_partie.php');
require_once('inc/php/lancer_partie.php');
$title = 'Liste des parties';

require_once('inc/header.php');

// corps de la page d'accueil
?>
<form action="" method="post">
	<input type="submit" name="nouveauJeu" value="Créer une nouvelle partie"></form>
	<h1>Liste des parties en attente</h1>
	<table>
		<tr>
			<th>Identifiant partie</th>
			<th>Nombre d'inscrits</th>
			<th>Hôte de la partie</th>
		</tr>
	<?php $resultat=execRequete('SELECT * FROM parties WHERE phase = 0',array());
  if($resultat->rowCount()>0){
    $partiesEnAttente=$resultat->fetchAll();
	foreach($partiesEnAttente as $partie){
		  // echo'<pre>';var_dump($partie);echo'</pre>';
		$resultat=execRequete('SELECT * FROM donnes WHERE id_partie = :partie',array(':partie'=>$partie['id_partie']));
    $donnes=$resultat->fetchAll();
		$resultat=execRequete('SELECT pseudo FROM utilisateurs WHERE id_utilisateur = :id',array(':id'=>$partie['id_host']));
    $host=$resultat->fetch();
		// echo'<pre>';var_dump($donnes);echo'</pre>';
		$nbJoueur= count($donnes);
echo'<tr><td><a href="'.URL.'partie.php?id='.$partie['id_partie'].'">'.$partie['id_partie']
."</a></td><td>".$nbJoueur
."</td><td>".$host['pseudo']
.'</td><td>';
$participation=false;

foreach($donnes as $donne){
	if($donne['id_utilisateur'] == $_SESSION['membre']['id_utilisateur']){
		$participation=true;
	}
}
if($participation==true){
	echo '<form action="" method="post"><button type="submit" name="desinscriptionPartie" value="'.$partie['id_partie']
	.'">Se désinscrire</button></form>';
	if($nbJoueur>1 &&  $_SESSION['membre']['id_utilisateur']==$partie['id_host']){
		echo '<form action="" method="post"><button type="submit" name="lancementPartie" value="'.$partie['id_partie']
		.'">Lancer la partie</button></form>';
	}
}
else{
echo '<form action="" method="post"><button type="submit" name="inscriptionPartie" value="'.$partie['id_partie']
.'">S\'inscrire</button</form>';}

echo "</td></tr>";
	}}?>
</table>

	<h1>Liste des parties en cours</h1>
	<table>
		<tr>
			<th>Identifiant partie</th>
			<th>Nombre de joueurs</th>
			<th>Phase de jeu</th>
			<th>Joueur actif</th>
		</tr>
	<?php $resultat=execRequete('SELECT * FROM parties WHERE phase > 0',array());
  if($resultat->rowCount()>0){
    $partiesEnCours=$resultat->fetchAll();
	foreach($partiesEnCours as $partie){
		$resultat=execRequete('SELECT * FROM donnes WHERE id_partie = :partie',array(':partie'=>$partie['id_partie']));
		$donnes=$resultat->fetchAll();

		$resultat=execRequete('SELECT pseudo FROM utilisateurs WHERE id_utilisateur = :id',array(':id'=>$partie['id_host']));
		$joueurActif=$resultat->fetch();

		$nbJoueur= count($donnes);
echo'<tr><td><a href="index.php?page=partie&id='.$partie['id_partie'].'">'.$partie['id_partie']
."</a></td><td>".$nbJoueur
."</td><td>".$partie['phase']
."</td><td>".$joueurActif['pseudo'];
$participation=false;
foreach($donnes as $donne){
	if($donne['id_utilisateur'] == $_SESSION['membre']['id_utilisateur']){
		$participation=true;
	}
}
if($participation==true){
	echo "</td><td> Vous participez";
}
echo "</td></tr>";
}}?>
</table>
<?php

require_once('inc/footer.php');
