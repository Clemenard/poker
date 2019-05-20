<?php

require_once('inc/init.php');
$title="Mon compte";
require_once('inc/header.php');

// page de compte client
$resultat=execRequete("SELECT * FROM  utilisateurs WHERE pseudo=:pseudo",array(':pseudo'=>$_SESSION['membre']['pseudo']));
?>
<div class="row">
<div class="col-6">
  <ul>
<?
for($i=0; $i<$resultat->columnCount();$i++){
  $colonne = $resultat->getColumnMeta($i);
  if($colonne['name']!='password' && $colonne['name']!='id_utilisateur'){
   ?>
  <li><?= $colonne['name'] ?></li>
  <?php
}}
?>
</ul>
</div>
<div class="col-6">
  <ul>
    <?
$ligne = $resultat->fetch();

      $i=0;
          foreach($ligne as $information){
            if($i!=2 && $i!=0){
              ?>
                <li><?= $information ?></li>
              <?

            }
          $i++;}
    ?>
  </ul>

</div>
</div>
<?
require_once('inc/footer.php');
?>
