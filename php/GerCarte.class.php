<?php class GerCarte
{
  protected $db;

public function __construct($db){$this->setDb($db);}



public function getMyC($id_carte){	$persos=new BasicPartie(array());
  $q = $this->db->prepare('SELECT * FROM cartes WHERE id_carte = :id_carte  ');
  $q->execute(array(
    ':id_carte' => $id_carte
));
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC)){$persos = new BasicPartie($donnees);}
return $persos;}


  public function setDb(PDO $db)
{
$this->db = $db;}
};
?>
