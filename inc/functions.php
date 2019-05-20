<?php
// l'existence du tableau membre dans la session indique que l'utilisateur s'est correctement connecté
function isConnected(){
  if ( isset($_SESSION['membre']) ){
    return true;
  }
  else{
    return false;
  }
}

// un admin est un membre connecté dont le statut vaut 1
function isAdmin(){
  if( isConnected() && $_SESSION['membre']['statut'] == 1){
    return true;
  }
  else{
    return false;
  }
}

function execRequete($req,$params=array()){
  global $pdo;
  $r = $pdo->prepare($req);
  if ( !empty($params) ){
    // sanatize et bindvalue
    foreach($params as $key => $value){
      $params[$key] = htmlspecialchars($value,ENT_QUOTES);
      $r->bindValue($key,$params[$key],PDO::PARAM_STR);
    }
  }
  $r->execute();
  if ( !empty( $r->errorInfo()[2] )){
    die('Erreur rencontrée - merci de contacter l\'administrateur');
  }
  return $r;
}
function tirageCarte ($id_partie){
  $cartes_tirees=[];
  $resultat=execRequete('SELECT * FROM donnes WHERE id_partie = :partie',array(':partie'=>$id_partie));
  $donnes=$resultat->fetchAll();
  $resultat=execRequete('SELECT * FROM parties  WHERE id_partie=:id',array('id'=>$id_partie));
$partie=$resultat->fetch();
$cartes_tirees[]=$partie['id_carte_flop1'];
$cartes_tirees[]=$partie['id_carte_flop2'];
$cartes_tirees[]=$partie['id_carte_flop3'];
$cartes_tirees[]=$partie['id_carte_turn'];
$cartes_tirees[]=$partie['id_carte_river'];
foreach($donnes as $d){
  $cartes_tirees[]=$d['id_carte1'];
  $cartes_tirees[]=$d['id_carte2'];
}

  $number=rand(1,52);
  while(in_array ( $number , $cartes_tirees )){
    $number=rand(1,52);
  }
return $number;
}
