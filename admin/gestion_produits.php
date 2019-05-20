<?php

require_once('../inc/init.php');
$title = 'Gestion des Produits';

// Controle des autorisations
if( !isAdmin() ){
  header('location:' . URL . 'connexion.php');
  exit();
}

// 5. Suppression d'un produit
if( isset($_GET['action']) && $_GET['action']=='sup' && !empty($_GET['id']) ){
  // Je vais chercher la photo du produit
  $resultat = execRequete("SELECT photo FROM produit WHERE id_produit=:id",array('id' => $_GET['id']));
  // si je trouve le produit
  if( $resultat->rowCount() == 1){
    $produit = $resultat->fetch();
    // si le champ photo est renseigné
    if(!empty($produit['photo'])){
      $fichier = $_SERVER['DOCUMENT_ROOT'] . URL . 'photo/' . $produit['photo'];
      if( file_exists( $fichier ) ){
        // suppression de la photo
        unlink( $fichier );
      }
    }
  }
  // suppression en BDD
  execRequete("DELETE FROM produit WHERE id_produit=:id",array('id'=>$_GET['id']));
  $content .= '<div class="alert alert-success">Le produit a été supprimé</div>';
  $_GET['action'] = 'affichage';
}


// 3. Enregistrement d'un produit en BDD (ajout et en modif)
if( !empty($_POST) ){

  // contrôles
  $nb_champs_vides = 0;
  foreach($_POST as $value){
    if($value == '') $nb_champs_vides++;
  }
  if ( $nb_champs_vides > 0 ){
    $content .= '<div class="alert alert-danger">Merci de remplir '. $nb_champs_vides . ' information(s) manquante(s)</div>';
  }

  // gérer la photo
  $photo_bdd = $_POST['photo_courante'] ?? '';

  if( !empty($_FILES['photo']['name']) ){
    $photo_bdd = $_POST['reference'] . '_' . $_FILES['photo']['name'];
    $dossier_photo = $_SERVER['DOCUMENT_ROOT'] . URL . 'photo/';
    $ext_auto = ['image/jpeg','image/png','image/gif'];

    if ( in_array( $_FILES['photo']['type'], $ext_auto) ){

      move_uploaded_file($_FILES['photo']['tmp_name'], $dossier_photo . $photo_bdd);

    }else{
      $content .= '<div class="alert alert-danger">La photo n\'a pas été enregistrée. Formats acceptés : jpeg, png, gif</div>';
    }

  }
  if ( empty($content)){
    extract($_POST);
    execRequete("REPLACE INTO produit VALUES (:id_produit,:reference,:categorie,:titre,:description,:couleur,:taille,:public,:photo,:prix,:stock)",array(
      'id_produit' => $id_produit,
      'reference' => $reference,
      'categorie' => $categorie,
      'titre' => $titre,
      'description' => $description,
      'couleur' => $couleur,
      'taille' => $taille,
      'public' => $public,
      'photo' => $photo_bdd,
      'prix' => $prix,
      'stock' => $stock
    ));
    $content .= '<div class="alert alert-success">Le produit a été enregistré</div>';
    $_GET['action'] = 'affichage';
  }
}


require_once('../inc/header.php');
echo $content;

// page de gestion des produits

// 1. Onglets affichage / ajout-modif produit
?>
<ul class="nav nav-tabs nav-justified">
  <li class="nav-item">
    <a class="nav-link <?= ( 
      ( 
        !isset($_GET['action']) 
        ||
        (isset($_GET['action']) && $_GET['action'] == 'affichage'
        )
      ) ? 'active' : '' 
      ) ?>" href="?action=affichage">Affichage des produits</a>
  </li>

  <li class="nav-item">
  <a class="nav-link <?= (isset($_GET['action']) && ( $_GET['action'] == 'ajout'  || $_GET['action'] == 'edit' )) ? 'active':'' ?>" href="?action=ajout">Ajouter un produit</a>
  </li>
</ul>
<?php

// 4. Affichage des produits en BO
if ( !isset($_GET['action']) || (isset($_GET['action']) && $_GET['action'] == 'affichage') ) {
  
  $resultat = execRequete("SELECT * FROM produit");
  if ( $resultat->rowCount() == 0 ){
    ?>
    <div class="alert alert-warning">Il n'y a pas encore de produits enregistrés</div>
    <?php
  }
  else{
    ?>
    <p>Il y a <?= $resultat->rowCount() ?> produit(s) dans la boutique</p>
    <table class="table table-bordered table-striped">
      <tr>
        <?php
            // Les entêtes de colonnes
          for($i=0;$i<$resultat->columnCount();$i++){
            $colonne = $resultat->getColumnMeta($i);
            ?>
            <th><?= ucfirst($colonne['name']) ?></th>
            <?php
         }
        ?>
        <th colspan="2">Actions</th>
      </tr>
      <?php
        // les données de la table produit
        while( $ligne = $resultat->fetch() ){
          ?>
          <tr>
            <?php
              foreach($ligne as $key => $value){
                if($key == 'photo'){
                  $value = '<img class="img-fluid" src="' . URL . 'photo/' . $value . '" alt="' . $ligne['titre'] . '">';
                }
                ?>
                <td><?= $value ?></td>
                <?php
              }
            ?>

            <td><a href="?action=edit&id=<?= $ligne['id_produit'] ?>"><i class="fas fa-pen"></i></a></td>

            <td><a class="confirm" href="?action=sup&id=<?= $ligne['id_produit'] ?>"><i class="fas fa-trash"></i></a></td>

          </tr>
          <?php
        }
      ?>
    </table>
    <?php
  } 
}

// 2. formulaire ajout/modif de produit
if ( isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action']=='edit' ) ):

    // 6 . chargement d'un produit en édition
    if ( !empty($_GET['id']) ){
      $resultat = execRequete("SELECT * FROM produit WHERE id_produit=:id",array('id' => $_GET['id']));
      $produit_courant = $resultat->fetch();
    }


  ?>
  <form method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="id_produit" value="<?= $_POST['id_produit'] ?? $produit_courant['id_produit'] ?? 0 ?>">

    <div class="form-row">
      <div class="form-group col-6">
        <label for="reference">Référence</label>
        <input type="text" name="reference" id="reference" class="form-control" value="<?= $_POST['reference'] ?? $produit_courant['reference'] ?? '' ?>">
      </div>
      <div class="form-group col-6">
        <label for="categorie">Catégorie</label>
        <input type="text" name="categorie" id="categorie" class="form-control" value="<?= $_POST['categorie'] ?? $produit_courant['categorie'] ?? '' ?>">
      </div>    
    </div>
    <div class="form-group">
      <label for="titre">Titre</label>
      <input type="text" name="titre" id="titre" class="form-control" value="<?= $_POST['titre'] ?? $produit_courant['titre'] ?? '' ?>">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea name="description" id="description" class="form-control"><?= $_POST['description'] ?? $produit_courant['description'] ?? '' ?></textarea>
    </div>
    <div class="form-row">
      <div class="form-group col">
        <label for="couleur">Couleur</label>
        <input type="text" name="couleur" id="couleur" class="form-control" value="<?= $_POST['couleur'] ?? $produit_courant['couleur'] ?? '' ?>">
      </div>
      <div class="form-group col">
        <label for="taille">Taille</label>
        <select name="taille" id="taille" class="form-control">
          <option>S</option>
          <option <?= (
            ( isset($_POST['taille']) && $_POST['taille'] == 'M' )
            ||
            ( isset($produit_courant['taille']) && $produit_courant['taille']=='M')
          ) ? 'selected':'' ?>>M</option>
          <option <?= (
            ( isset($_POST['taille']) && $_POST['taille'] == 'L' )
            ||
            ( isset($produit_courant['taille']) && $produit_courant['taille']=='L')
          ) ? 'selected':'' ?>>L</option>
          <option <?= (
            ( isset($_POST['taille']) && $_POST['taille'] == 'XL' )
            ||
            ( isset($produit_courant['taille']) && $produit_courant['taille']=='XL')
          ) ? 'selected':'' ?>>XL</option>
        </select>
      </div>
      <div class="form-group col">
        <label for="public">Public</label>
        <select name="public" id="public" class="form-control">
          <option value="m">Homme</option> 
          <option <?= (
            ( isset($_POST['public']) && $_POST['public'] == 'f' )
            ||
            ( isset($produit_courant['public']) && $produit_courant['public']=='f')
          )  ? 'selected':'' ?>
          value="f">Femme</option> 
          <option <?= (
            ( isset($_POST['public']) && $_POST['public'] == 'mixte' )
            ||
            ( isset($produit_courant['public']) && $produit_courant['public']=='mixte')
          )  ? 'selected':'' ?> value="mixte">Mixte</option> 
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="photo"><i class="fa fa-camera"></i> <span id="fichier"></span></label>     
      <input type="file" name="photo" id="photo" class="form-control">
      <?php
        if( !empty($produit_courant['photo']) ){
          ?>
          <em>Vous pouvez uploader une nouvelle photo</em>
          <img class="img-fluid w-25" src="<?= URL . 'photo/' . $produit_courant['photo'] ?>" alt="<?= $produit_courant['titre'] ?>">
          <input type="hidden" name="photo_courante" value="<?= $produit_courant['photo'] ?>">
          <?php
        }
      ?>
    </div>
    <div class="form-row">
      <div class="form-group col">
        <label for="Prix">Prix</label>
        <input type="number" name="prix" id="prix" class="form-control" value="<?= $_POST['prix'] ?? $produit_courant['prix'] ?? '' ?>">
      </div>
      <div class="form-group col">
        <label for="stock">Stock</label>
        <input type="number" name="stock" id="stock" class="form-control" value="<?= $_POST['stock'] ?? $produit_courant['stock'] ?? '' ?>">
      </div>
    </div>
    <input type="submit" class="btn btn-primary" value="Enregistrer">
  </form>
  <?php
endif;
require_once('../inc/footer.php');