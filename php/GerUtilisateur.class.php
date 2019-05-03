<?php class GerUtilisateur
{
  protected $db;

public function __construct($db){$this->setDb($db);}

public function addU(BasicUtilisateur $perso)
{
  $q = $this->db->prepare('INSERT INTO utilisateurs(pseudo,password,derniere_connexion) VALUES(:pseudo,:password,NOW())  ');
$q->bindValue(':pseudo', $perso->pseudo());
$q->bindValue(':password', $perso->password());

  $q->execute();

}

public function getUByPseudo($nom){	$persos=new BasicUtilisateur(array());
  $q = $this->db->prepare('SELECT * FROM utilisateurs WHERE nom = :nom');
  $q->execute(array(':nom' => $nom));
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC)){$persos = new BasicUtilisateur($donnees);}
return $persos;}

public function getUById($id){	$persos=new BasicUtilisateur(array());
  $q = $this->db->prepare('SELECT * FROM utilisateurs WHERE id_utilisateur = :id');
  $q->execute(array(':id' => $id));
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC)){$persos = new BasicUtilisateur($donnees);}
return $persos;}

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
