<?php

require_once('inc/init.php');
$title="Panier";
require_once('inc/header.php');

// page du panier
if(isset($_POST['ajout_panier'])){
  $resultat=execRequete("SELECT prix FROM produit WHERE id_produit=:id_produit",array('id_produit'=>$_POST['id_produit']));
  if($resultat->rowCount()==1){
    $produit=$resultat->fetch();
    addPanier($_POST['id_produit'],$_POST['quantite'],$produit['prix']);
    header('location: '.URL.'fiche_produit.php?id_produit='.$_POST['id_produit'].'&statut_produit=ajoute');
    exit();
  }

}
?> <table>
  <th>
    <td>Produit</td>
    <td>Quantité</td>
    <td>Prix</td>

  </th>
</table><?
for($i=0;$i< count($_SESSION['panier']['id_produit']);$i++){
  $resultat=execRequete("SELECT titre FROM produit WHERE id_produit=:id_produit",array('id_produit'=>$_SESSION['panier']['id_produit'][$i]));
  if($resultat->rowCount()==1){
    $produit=$resultat->fetch();
  echo '<tr><td>'.$produit['titre'].'</td>'.
  '<td>'.$_SESSION['panier']['quantite'][$i].'</td>'.
  '<td>'.$_SESSION['panier']['prix'][$i].'</td></tr>';

}}
?></table><?

require_once('inc/footer.php');
