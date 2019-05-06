<?php try
{
	$db = new PDO('mysql:host=localhost;dbname=poker;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
function chargerClasse($classe){require $classe . '.class.php';}
spl_autoload_register('chargerClasse');
$geru = new GerUtilisateur($db);
$gerd = new GerDonne($db);
$gerp = new GerPartie($db);
$gerc = new GerCarte($db);
session_start();
?>
