<?php
class BasicPartie
{
  protected $id_parties;
  protected $phase;
  protected $pot;
  protected $id_carte_flop1;
  protected $id_carte_flop2;
  protected $id_carte_flop3;
  protected $id_carte_turn;
  protected $id_carte_river;
  protected $id_host;

      public function __construct(){}

      // public function hydrate(array $donnees){
      //     foreach ($donnees as $key => $value){$method = 'set'.ucfirst($key); if (method_exists($this, $method)){$this->$method($value);}}}

      public function id_parties(){return $this->id_parties;}
     	public function phase(){return $this->phase;}
      public function pot(){return $this->pot;}
      public function id_carte_flop1(){return $this->id_carte_flop1;}
      public function id_carte_flop2(){return $this->id_carte_flop2;}
      public function id_carte_flop3(){return $this->id_carte_flop3;}
      public function id_carte_turn(){return $this->id_carte_turn;}
      public function id_carte_river(){return $this->id_carte_river;}
      public function id_host(){return $this->id_host;}

      public function setPhase($phase){return $this->phase=$phase;}
      public function setPot($pot){return $this->pot=$pot;}
      public function setId_carte_flop1($id_carte_flop1){return $this->id_carte_flop1=$id_carte_flop1;}
      public function setId_carte_flop2($id_carte_flop2){return $this->id_carte_flop2=$id_carte_flop2;}
      public function setId_carte_flop3($id_carte_flop3){return $this->id_carte_flop3=$id_carte_flop3;}
      public function setId_carte_turn($id_carte_turn){return $this->id_carte_turn=$id_carte_turn;}
      public function setId_carte_river($id_carte_river){return $this->id_carte_river=$id_carte_river;}
      public function setId_host($id_host){return $this->id_host=$id_host;}

			public function nouvellePhase($phase,$pot){
				if($phase==2){
					// $carte=fonction d'Axel -- fonction de tirage d'une carte aléatoire sans doublon
					$this->setId_carte_flop1($carte);
					// $carte=fonction d'Axel -- fonction de tirage d'une carte aléatoire sans doublon
					$this->setId_carte_flop2($carte);
					// $carte=fonction d'Axel -- fonction de tirage d'une carte aléatoire sans doublon
					$this->setId_carte_flop3($carte);
				}

				if($phase==3){
					// $carte=fonction d'Axel -- fonction de tirage d'une carte aléatoire sans doublon
					$this->setId_carte_turn($carte);

				}

				if($phase==4){
					// $carte=fonction d'Axel -- fonction de tirage d'une carte aléatoire sans doublon
					$this->setId_carte_river($carte);

				}
				if($phase==5){
					// comparaison de la valeur des mains de chaque joueur au statut > 0
					// le vainqueur récupère le pot
					// exception si son tapis est insuffisant
				}
			}
    };
?>
