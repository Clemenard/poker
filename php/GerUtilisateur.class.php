<?php class GerUtilisateur
{
  protected $db;

public function __construct($db){$this->setDb($db);}

public function addU($pseudo, $password)
{
  $q = $this->db->prepare('INSERT INTO utilisateurs(pseudo,password) VALUES(:pseudo,:password)  ');
$q->bindValue(':pseudo', $pseudo);
$q->bindValue(':password', $password);
  $q->execute();
}


public function countU($nom){
$persos= $this->db->exec('COUNT(*) FROM utilisateurs WHERE pseudo = '.$nom);
return $persos;}

public function getUByPseudo($nom){
  $q = $this->db->prepare('SELECT * FROM utilisateurs WHERE pseudo = :pseudo');
  $q->setFetchMode(PDO::FETCH_CLASS, 'BasicUtilisateur');
  $q->execute(array(':pseudo' => $nom));
  $donnees = $q->fetch();
return $donnees;}


public function getUById($nom){
  $q = $this->db->prepare('SELECT * FROM utilisateurs WHERE id_utilisateurs = :id');
  $q->setFetchMode(PDO::FETCH_CLASS, 'BasicUtilisateur');
  $q->execute(array(':id' => $nom));
  $donnees = $q->fetch();
return $donnees;}

public function deleteU( $nom)
  {
    $this->db->exec('DELETE FROM utilisateurs WHERE pseudo = '.$nom);
  }

  public function updatePasswordJ(BasicUtilisateur $perso)
{
 $q = $this->db->prepare('UPDATE utilisateurs SET password = :password WHERE id_utilisateur=:id_utilisateur');
$q->bindValue(':id_utilisateur', $perso->id_utilisateur());
$q->bindValue(':password', $perso->password());
 $q->execute();
}

public function updateStatutJ(BasicUtilisateur $perso)
{
$q = $this->db->prepare('UPDATE utilisateurs SET statut = :statut WHERE id_utilisateur=:id_utilisateur');
$q->bindValue(':id_utilisateur', $perso->id_utilisateur());
$q->bindValue(':statut', $perso->statut());
$q->execute();
}

public function updateJetonsJ(BasicUtilisateur $perso)
{
$q = $this->db->prepare('UPDATE utilisateurs SET jetons = :jetons WHERE id_utilisateur=:id_utilisateur');
$q->bindValue(':id_utilisateur', $perso->id_utilisateur());
$q->bindValue(':jetons', $perso->jetons());
$q->execute();
}
  public function setDb(PDO $db)
{
$this->db = $db;}
};
?>
