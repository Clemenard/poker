<?php
class BasicCarte
{
  protected $id_cartes;
  protected $couleur;
  protected $figure;



      public function __construct(array $donnees){$this->hydrate($donnees);}

      public function hydrate(array $donnees){
          foreach ($donnees as $key => $value){$method = 'set'.ucfirst($key); if (method_exists($this, $method)){$this->$method($value);}}}

      public function id_carte(){return $this->id_carte;}
     	public function couleur(){return $this->couleur;}
      public function figure(){return $this->figure;}




		};
?>
