<?php
class BasicDonne
{
  protected $id_utilisateurs;
  protected $id_partie;
  protected $id_carte1;
  protected $id_carte2;
  protected $mise;
	protected $mise_totale;
  protected $statut;
  protected $ordre;
  protected $joueur_actif;


      public function __construct(array $donnees){$this->hydrate($donnees);}

      public function hydrate(array $donnees){
          foreach ($donnees as $key => $value){$method = 'set'.ucfirst($key); if (method_exists($this, $method)){$this->$method($value);}}}

      public function id_utilisateurs(){return $this->id_utilisateurs;}
     	public function id_partie(){return $this->id_partie;}
      public function pot(){return $this->pot;}
      public function id_carte1(){return $this->id_carte1;}
      public function id_carte2(){return $this->id_carte2;}
      public function mise(){return $this->mise;}
			public function mise_totale(){return $this->mise_totale;}
      public function statut(){return $this->statut;}
      public function ordre(){return $this->ordre;}
      public function joueur_actif(){return $this->joueur_actif;}

      public function setId_partie($id_partie){return $this->id_partie=$id_partie;}
      public function setId_utilisateurs($id_utilisateurs){return $this->id_utilisateurs=$id_utilisateurs;}
      public function setId_carte1($id_carte1){return $this->id_carte1=$id_carte1;}
      public function setId_carte2($id_carte2){return $this->id_carte2=$id_carte2;}
      public function setMise($mise){return $this->mise=$mise;}
			public function setMise_totale($mise_totale){return $this->mise_totale=$mise_totale;}
      public function setStatut($statut){return $this->statut=$statut;}
      public function setOrdre($ordre){return $this->ordre=$ordre;}
      public function setJoueur_actif($joueur_actif){return $this->joueur_actif=$joueur_actif;}

public function changerJoueurActif($listeDonnes,$gerd){
	$ordre=-1;
	foreach($listeDonnes as $donne){
		if($donne->joueur_actif() == true){
			$ordre=$donne->ordre()+1;
			$donne->setJoueur_actif(false);
		}
		else if($donne->ordre()==$ordre){
		$donne->setJoueur_actif(true);
		}
		$gerd->updateD($donne);
	}
	if($ordre==count($listeDonnes)){
		$listeDonnes[0]->setJoueur_actif(true);
		$gerd->updateD($listeDonnes[0]);
	}
}
		};
?>
