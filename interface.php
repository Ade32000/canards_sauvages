<?php 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<title>Where are the wild ducks ?</title>
</head>
<body id="bodyinter">
	<header>
		<div id="entete">
			<div class="head">
				<img id="logo" src="canard_logo.png"><img src="logo.png">
			</div>
		</div>
	</header>

	<div id="presentation">
		<h3>Avis à la population Gersoise !</h3>
		<h4>L'opération : " Balance ton canard sauvage est lancée! "</h4>

		<p>
			<b>Objectif : </b>
			<ul>
				<li>Recenser le volatile en question.</li>
				<li>Avoir une vision globale des lieux traversés par ce dernier et à quels moments.</li>
			</ul>
		</p>
		<p>
			<b>Pour rappel : </b>
			<ul>
				<li><p><b>Qu'est-ce-qu'un canard ?</b> Oiseau aquatique ansériforme, au cou court, au large bec jaune, aplati, aux très courtes pattes palmées et aux longues ailes pointues.</p></li>
				<li><p><b>Qu'est-ce-que sauvage ?</b> Non détenu ou élevé dans une exploitation.</p></li>
			</ul>
			<h4>Alors, toi aussi, balances ton canard !!!</h4>
		</p>
	</div>
	<a id="btn" href="#formulaire"><button id="btnbtn">J'ai aperçu un canard sauvage!</button></a>



	<?php 


	$lieu = $_POST['lieu'];
	$date = $_POST['date'];
	$nombre = $_POST["nombre"];
	$heure = $_POST["heure"];

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
	$req = $bdd->prepare('INSERT INTO recensement(lieu, date, heure, nombre) VALUES(:lieu, :date, :heure, :nombre)');
	$req->execute(array(
		'lieu' => $lieu,
		'date' => $date,
		'heure' => $heure,
		'nombre' => $nombre

	));

	?>


	<table class="table"> 
		<thead>
			<th>Date</th>
			<th>Heure</th>
			<th>Lieu</th>
			<th>Quantité</th>
		</thead>


		<?php 
		$reponse = $bdd->query('SELECT * FROM recensement');
		while($donnees=$reponse->fetch())
		{
			echo '<tr><td>'.$donnees['date'].'</td><td>'.$donnees['heure'].'</td><td>'.$donnees['lieu'].'</td><td>'.$donnees['nombre'].'</td></tr>';
		}
		?>

	</table> 



	<form id="formulaire" method="post" action="">
		<h2 id="titreform">J'ai aperçu un/plusieurs volatile(s) !</h2>


		<label class="form" for="lieu">Lieu :</label>
		<input class="form" type="text" name="lieu" placeholder="ex : Auch">

		<label class="form" for="date">Date :</label>
		<input class="form" type="date" name="date" placeholder="ex : 16/08/2018">

		<label class="form" for="heure">Heure :</label>
		<input class="form" type="time" name="heure" placeholder="ex : 16h30">

		<label class="form" for="nombre">Nombre :</label>
		<input class="form" type="number" name="nombre" placeholder="ex : 3">

		<input id="valider" class="form" type="submit" name="ok" value="Envoyer">
		<a href="interface.php"><button class="form" >J'ai confondu, ce n'était pas un canard !</button></a>
	</form>

	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap.min.js"></script>

	<script type="text/javascript">

		$('#valider').click(function()
		{
			$('#presentation').show();
			callback()
		});
		
		$('#btnbtn').click(function(callback)
		{
			// $('#presentation').hide();
			$('.table').hide();
			$('#formulaire').show();
			callback();
		});

		function callback()
		{
			$('#presentation').hide();
		};



	</script>
</body>
</html>