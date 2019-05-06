
<?php include '../php/sgbdLoader.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Eragny Poker Tour</title>
</head>
<body>
	<?php include 'header.php';
	 include 'aside.php';

	 if(isset($_GET['page'])){
		 switch ($_GET['page']) {
		 	case 'listeParties':include 'listeParties.php';break;
		 	case 'partie':include 'partie.php';break;
			case 'profil':include 'profil.php';break;
		 	default: include 'accueil.php';break;
		 }
	 }
	 else{
		 include 'accueil.php';
	 }
	include 'footer.php'; ?>
</body>
</html>
