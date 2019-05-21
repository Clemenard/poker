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

function findepartie($partie){
  $resultat=execRequete('SELECT * FROM donnes WHERE id_partie = :id AND statut>0',array("id"=>$_GET['id']));
  $donnes=$resultat->fetch();
  foreach($donnes as $d){
    $annonce=[];
    $annonce[]=$d['carte1'];
    $annonce[]=$d['carte2'];
    $annonce[]=$partie['carte_flop1'];
    $annonce[]=$partie['carte_flop2'];
    $annonce[]=$partie['carte_flop3'];
    $annonce[]=$d['carte_turn'];
    $annonce[]=$d['carte_river'];
    $annonce_bis=[];
    foreach($annonce as $a=>$key){
    $resultat=execRequete('SELECT * FROM cartes WHERE id_carte = :id ',array("id"=>$a));
    $a_bis[$key]=$resultat->fetch();

  $figures=[];$couleurs=[];

if (array_key_exists($a_bis[$key]['couleur'],$couleurs)){
  $couleurs[$f]++;
}
else{$couleurs[$f]=1;}



if (array_key_exists($a_bis[$key]['figure'],$figures)){
  $figures[$f]++;
}
else{$figures[$f]=1;}
}

if($couleurs[1]>4 || $couleurs[2]>4 || $couleurs[3]>4 || $couleurs[4]>4){
  $hasCouleur=true;
}
$suite=0;$suiteMax=0;$clef=0;asort($figures);

foreach($figures as $key=>$value){
  if($value==4){$hasCarre=true;}
  else if($value==3){$hasBrelan=true;}
  else if($value==2 && $hasPaire=true){$hasDoublePaire=true;}
  else if($value==2 ){$hasPaire=true;}

  //test de suite
  if($suite==0){$suite=1;$suiteMax=1;}
  else if($clef==$key-1){
    $suite++;
  if($suiteMax<$suite){$suiteMax=$suite;}
}
else{$suite=1;}
  $clef=$key;
}
if($suite>4){
  $hasSuite=true;
}
if($hasSuite==true && $hasCouleur==true){$hasFlush==true;}
if($hasPaire==true && $hasBrelan==true){$hasFull==true;}
if($hasFlush==true){$d['score']=7;}
if($hasCarre==true){$d['score']=6;}
if($hasFull==true){$d['score']=5;}
if($hasCouleur==true){$d['score']=4;}
if($hasBrelan==true){$d['score']=3;}
if($hasDoublePaire==true){$d['score']=2;}
if($hasPaire==true){$d['score']=1;}
else{$d['score']=0;}
}
$best['score']=0;
foreach($donnes as $d){
  if($d['score']>$best['score']){
  $best=$d;
  $bestPrime=[];}

else if($d['score']==$best['score']){
  $bestPrime=$d;
}
}
if(empty($bestPrime)){

}
}

?>
