<?php class GerDonne
{
  protected $db;

public function __construct($db){$this->setDb($db);}

public function addD($id_partie, $id_utilisateur)
{
  $q = $this->db->prepare('INSERT INTO donnes(id_parties,id_utilisateurs) VALUES(:id_parties,:id_utilisateurs)  ');
  $q->bindValue(':id_parties', $id_partie);
  $q->bindValue(':id_utilisateurs', $id_utilisateur);
  $q->execute();

}

public function getMyD($id_partie, $id_utilisateur){	$persos=new BasicDonne(array());
  $q = $this->db->prepare('SELECT * FROM donnes WHERE id_partie = :id_partie AND id_utilisateur = :id_utilisateur ');
  $q->execute(array(
    ':id_utilisateur' => $id_utilisateur,
    ':id_partie' => $id_partie
));
while ($donnees = $q->fetch(PDO::FETCH_ASSOC)){$persos = new BasicDonne($donnees);}
return $persos;}



public function getAllDInPartie($partie){
  $q = $this->db->prepare('SELECT * FROM donnes WHERE id_parties = :parties');
  $q->setFetchMode(PDO::FETCH_CLASS, 'BasicDonne');
  $q->bindValue(':parties',$partie);
  $q->execute();
return $q->fetchAll();}

public function deleteP( $id)
  {
    $this->db->exec('DELETE FROM donnes WHERE id_partie = '.$id);
  }

  public function updateP(BasicUtilisateur $perso)
{
 $q = $this->db->prepare('UPDATE donnes
    SET mise=:mise,statut=:statut,id_carte1=:id_carte1,id_carte2=:id_carte2,
    ordre=:ordre,joueur_actif=:joueur_actif
   WHERE id_partie=:id_partie AND id_utilisateur=:id_utilisateur');
$q->bindValue(':mise', $perso->mise());
$q->bindValue(':statut', $perso->statut());
$q->bindValue(':id_carte1', $perso->id_carte1());
$q->bindValue(':id_carte2', $perso->id_carte2());
$q->bindValue(':ordre', $perso->ordre());
$q->bindValue(':joueur_actif', $perso->joueur_actif());
$q->bindValue(':id_carte_river', $perso->id_carte_river());
$q->bindValue(':id_partie', $perso->id_partie());
$q->bindValue(':id_utilisateur', $perso->id_utilisateur());
 $q->execute();
}


  public function setDb(PDO $db)
{
$this->db = $db;}
};
?>
