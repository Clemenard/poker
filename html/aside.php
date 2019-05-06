
<?php if(isset($_SESSION['pseudo'])){
  ?>
<form action="../php/actions.php" method="post"><input type="submit" name="deconnexion" value="Déconnexion"></form>

  <? 
}
  else{ ?>
<form action="../php/actions.php" method="post">
  <label for="pseudo">Votre pseudo</label>
  <input type="text" id="pseudo" name="pseudo">
  <label for="password">Votre mot de passe</label>
  <input type="password" id="password" name="password">
  <input type="submit" value"Connexion">
</form>
<? } ?>
