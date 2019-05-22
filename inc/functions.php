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

  $resultat=execRequete('SELECT * FROM donnes WHERE id_partie = :id AND statut>0',array("id"=>intval($_GET['id'])));
  $donnes=$resultat->fetchAll();
  $best=[];
  foreach($donnes as $d){
    $hasFlush=false;$hasCarre=false;$hasFull=false;$hasCouleur=false;$hasSuite=false;$hasBrelan=false;$hasDoublePaire=false;$hasPaire=false;
    $annonce=[];
    $annonce[]=$d['id_carte1'];
    $annonce[]=$d['id_carte2'];
    $annonce[]=$partie['id_carte_flop1'];
    $annonce[]=$partie['id_carte_flop2'];
    $annonce[]=$partie['id_carte_flop3'];
    $annonce[]=$partie['id_carte_turn'];
    $annonce[]=$partie['id_carte_river'];
    $a_bis=[];
    $figures=[];$couleurs=[];
    foreach($annonce as $key=>$value){
    $resultat=execRequete('SELECT * FROM cartes WHERE id_carte = :id ',array("id"=>intval($value)));
    $a_bis[$key]=$resultat->fetch();
// echo'<pre>';
// var_dump($a_bis[$key]);
// echo'</pre>';

if (array_key_exists($a_bis[$key]['couleur'],$couleurs)) {
  $couleurs[$a_bis[$key]['couleur']]+=1;
}
else{$couleurs[$a_bis[$key]['couleur']]=1;}



if (array_key_exists($a_bis[$key]['figure'],$figures)){
  $figures[$a_bis[$key]['figure']]+=1;
}
else{$figures[$a_bis[$key]['figure']]=1;}
}
// echo'<pre>';
// var_dump($couleurs);
// echo'</pre>';
// echo'<pre>';
// var_dump($figures);
// echo'</pre>';
if(max($couleurs)>4){
  $hasCouleur=true;
}
$suite=0;$suiteMax=0;$clef=0;asort($figures);

foreach($figures as $key=>$value){
  // echo $key.'=>'.$value."  ";
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
else if($hasCarre==true){$d['score']=6;}
else if($hasCouleur==true){$d['score']=4;}
else if($hasBrelan==true){$d['score']=3;}
else if($hasDoublePaire==true){$d['score']=2;}
else if($hasPaire==true){$d['score']=1;}
else{$d['score']=0;}
execRequete('UPDATE   donnes SET score =:score WHERE id_utilisateur = :id_u 	AND id_partie = :id_p',
array(':score'=>$d['score'],':id_u'=>$d['id_utilisateur'],':id_p'=>$d['id_partie']));

}
$best['score']=-1;$bestPrime=[];
foreach($donnes as $d){
 // var_dump($d);
  if($d['score']>$best['score']){
  $best=$d;
  $bestPrime=[];}

else if($d['score']==$best['score']){
  $bestPrime=$d;
}
}
if(empty($bestPrime)){
$best['statut']=4;
execRequete('UPDATE   donnes SET statut =:statut WHERE id_utilisateur = :id_u 	AND id_partie = :id_p',
array(':statut'=>$best['statut'],':id_u'=>$best['id_utilisateur'],':id_p'=>$best['id_partie']));
$resultat = execRequete("SELECT * FROM utilisateurs WHERE id_utilisateur=:id ",
array('id' => $best['id_utilisateur']));
$gagnant=$resultat->fetch();

$gagnant['jetons']=intval($gagnant['jetons'])+$partie['pot'];
execRequete('UPDATE   utilisateurs SET jetons =:jetons WHERE id_utilisateur = :id_u',
array(':jetons'=>$gagnant['jetons'],':id_u'=>$best['id_utilisateur']));
}
else{
  $bestPrime['statut']=4;
  execRequete('UPDATE   donnes SET statut =:statut WHERE id_utilisateur = :id_u 	AND id_partie = :id_p',
  array(':statut'=>$bestPrime['statut'],':id_u'=>$bestPrime['id_utilisateur'],':id_p'=>$bestPrime['id_partie']));
  $resultat = execRequete("SELECT * FROM utilisateurs WHERE id_utilisateur=:id ",
  array('id' => $bestPrime['id_utilisateur']));
  $gagnantMoit=$resultat->fetch();
  $gagnantMoit['jetons']=intval($gagnantMoit['jetons'])+$partie['pot']/2;
  execRequete('UPDATE   utilisateurs SET jetons =:jetons WHERE id_utilisateur = :id_u',
  array(':jetons'=>$gagnantMoit['jetons'],':id_u'=>$bestPrime['id_utilisateur']));


  $best['statut']=4;
  execRequete('UPDATE   donnes SET statut =:statut WHERE id_utilisateur = :id_u 	AND id_partie = :id_p',
  array(':statut'=>$best['statut'],':id_u'=>$best['id_utilisateur'],':id_p'=>$best['id_partie']));
  $resultat = execRequete("SELECT * FROM utilisateurs WHERE id_utilisateur=:id ",
  array('id' => $best['id_utilisateur']));
  $gagnantMoit=$resultat->fetch();

  $gagnantMoit['jetons']=intval($gagnantMoit['jetons'])+$partie['pot']/2;
  execRequete('UPDATE   utilisateurs SET jetons =:jetons WHERE id_utilisateur = :id_u',
  array(':jetons'=>$gagnantMoit['jetons'],':id_u'=>$best['id_utilisateur']));
  }
}

function annonce($score){
  switch($score){
  case 1 : return "une Paire";
  case 2 : return "une Double Paire";
  case 3 : return "un Brelan";
  case 4 : return "une Suite";
  case 5 : return "une Couleur";
  case 6 : return "un Full";
  case 7 : return "un Carré";
  case 8 : return "une Quinte Flush";
  default : return "rien du tout";}
}
?>
