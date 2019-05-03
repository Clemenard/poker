<?php try
{
	$db = new PDO('mysql:host=cl1-sql20;dbname=img76751;charset=utf8', 'img76751', 'Oitreza13');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
function chargerClasse($classe){require "'/'php'/'".$classe . '.class.php';}
spl_autoload_register('chargerClasse');
$gerp = new GerPartie($db);
$geru = new GerUtilisateur($db);
$gerc = new GerCarte($db);
$gerd = new GerDonne($db);
?>
