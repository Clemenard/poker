<?php
class BasicUtilisateur
{
  protected $id_utilisateur;
  protected $pseudo;
  protected $password;
  protected $derniere_connexion;
  protected $jetons;
  protected $statut;

      public function __construct(array $donnees){$this->hydrate($donnees);}

      public function hydrate(array $donnees){
          foreach ($donnees as $key => $value){$method = 'set'.ucfirst($key); if (method_exists($this, $method)){$this->$method($value);}}}

      public function id_utilisateur(){return $this->id_utilisateur;}
     	public function pseudo(){return $this->pseudo;}
      public function password(){return $this->password;}
     	public function derniere_connexion(){return $this->derniere_connexion;}
      public function jetons(){return $this->jetons;}
      public function statut(){return $this->statut;}

      public function setId_utilisateur($id_utilisateur){return $this->id_utilisateur=$id_utilisateur;}
      public function setPseudo($pseudo){return $this->pseudo=$pseudo;}
      public function setPassword($password){return $this->password=$password;}
    	public function setDerniere_connexion($derniere_connexion){return $this->derniere_connexion=$derniere_connexion;}
      public function setJetons($jetons){return $this->jetons=$jetons;}
      public function setStatut($statut){return $this->statut=$statut;}

    };
?>
