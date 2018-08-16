<?php 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<title></title>
</head>
<body>


	<?php 


	$lieu = $_POST['select'];
	$date = $_POST['titre'];
	$nombre = $_POST["photo"];

	//on se connecte à mysql :
	try  
	{
		$bdd = new PDO('mysql:host=localhost;dbname=canards;charset=utf8', 'annie', '12345678');
	}
	// en cas d'erreur on affiche un message :
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}


	//insertion dans la bdd
	$req = $bdd->prepare('INSERT INTO recensement(lieu, date, nombre) VALUES(:lieu, :date, :nombre)');
	$req->execute(array(
		'lieu' => $lieu,
		'date' => $date,
		'nombre' => $nombre
	));

	?>

	<script type="text/javascript" src="bootstrap.min.js"></script>
</body>
</html>