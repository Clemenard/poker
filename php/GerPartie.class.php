<?php class GerPartie
{
  protected $db;

public function __construct($db){$this->setDb($db);}


public function addP($id_host)
{
  $q = $this->db->prepare('INSERT INTO parties(id_host) VALUES(:id_host)  ');
  $q->bindValue(':id_host', $id_host);

$q->execute();
}



public function getAllPStarted(){
  $q = $this->db->prepare('SELECT * FROM parties WHERE phase > :phase');
  $q->setFetchMode(PDO::FETCH_CLASS, 'BasicPartie');
  $q->execute(array(':phase' => 0));
    while ( $q->fetch(PDO::FETCH_ASSOC)){$persos[] = $q->fetch();}
return $persos;}


public function getAllPUnstarted(){
  $q = $this->db->prepare('SELECT * FROM parties WHERE phase = :phase');
  $q->setFetchMode(PDO::FETCH_CLASS, 'BasicPartie');
  $q->bindValue(':phase',0);
  $q->execute();
    while ( $q->fetch(PDO::FETCH_ASSOC)){$persos[] = $q->fetch();}
return $persos;}

public function getP($id){	$persos=new BasicPartie(array());
  $q = $this->db->prepare('SELECT * FROM parties WHERE id_partie = :id');
  $q->execute(array(':id' => $id));
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC)){$persos = new BasicPartie($donnees);}
return $persos;}

public function getLastP(){	$persos=new BasicPartie(array());
  $q = $this->db->prepare('SELECT * FROM parties  ORDER BY id_parties LIMIT 0,1 DESC');
  $q->execute();
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC)){$persos = new BasicPartie($donnees);}
return $persos;}


public function deleteP( $id)
  {
    $this->db->exec('DELETE FROM parties WHERE id_partie = '.$id);
  }

  public function updateP(BasicPartie $perso)
{
 $q = $this->db->prepare('UPDATE parties
    SET phase=:phase,pot=:pot,id_carte_flop1=:id_carte_flop1,id_carte_flop2=:id_carte_flop2,
    id_carte_flop3=:id_carte_flop3,id_carte_turn=:id_carte_turn,id_carte_river=:id_carte_river,
   WHERE id_partie=:id_partie');
$q->bindValue(':phase', $perso->phase());
$q->bindValue(':pot', $perso->pot());
$q->bindValue(':id_carte_flop1', $perso->id_carte_flop1());
$q->bindValue(':id_carte_flop2', $perso->id_carte_flop2());
$q->bindValue(':id_carte_flop3', $perso->id_carte_flop3());
$q->bindValue(':id_carte_turn', $perso->id_carte_turn());
$q->bindValue(':id_carte_river', $perso->id_carte_river());
$q->bindValue(':id_partie', $perso->id_partie());
 $q->execute();
}


  public function setDb(PDO $db)
{
$this->db = $db;}
};
?>
