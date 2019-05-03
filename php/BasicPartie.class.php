<?php
class BasicPartie
{
  protected $id_partie;
  protected $phase;
  protected $pot;
  protected $id_carte_flop1;
  protected $id_carte_flop2;
  protected $id_carte_flop3;
  protected $id_carte_turn;
  protected $id_carte_river;

      public function __construct(array $donnees){$this->hydrate($donnees);}

      public function hydrate(array $donnees){
          foreach ($donnees as $key => $value){$method = 'set'.ucfirst($key); if (method_exists($this, $method)){$this->$method($value);}}}

      public function id_partie(){return $this->id_partie;}
     	public function phase(){return $this->phase;}
      public function pot(){return $this->pot;}
      public function id_carte_flop1(){return $this->id_carte_flop1;}
      public function id_carte_flop2(){return $this->id_carte_flop2;}
      public function id_carte_flop3(){return $this->id_carte_flop3;}
      public function id_carte_turn(){return $this->id_carte_turn;}
      public function id_carte_river(){return $this->id_carte_river;}

      public function setId_partie($id_partie){return $this->id_partie=$id_partie;}
      public function setPhase($phase){return $this->phase=$phase;}
      public function setPot($pot){return $this->pot=$pot;}
      public function setId_carte_flop1($id_carte_flop1){return $this->id_carte_flop1=$id_carte_flop1;}
      public function setId_carte_flop2($id_carte_flop2){return $this->id_carte_flop2=$id_carte_flop2;}
      public function setId_carte_flop3($id_carte_flop3){return $this->id_carte_flop3=$id_carte_flop3;}
      public function setId_carte_turn($id_carte_turn){return $this->id_carte_turn=$id_carte_turn;}
      public function setId_carte_river($id_carte_river){return $this->id_carte_river=$id_carte_river;}
    };
?>
