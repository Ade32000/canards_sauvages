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
		$bdd = new PDO('mysql:host=localhost;dbname=adeline;charset=utf8', 'benji', 'aqwsedcft7777');
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

	<form method="post">
		<div class="input-group">
			<select class="custom-select" name="trier" aria-label="Example select with button addon">
				<option value="trier1">Nombre croissant</option>
				<option value="trier2">Nombre décroissant</option>
				<option value="trier3">Ville</option>
				<option value="trier4">Le plus récent</option>
				<option value="trier5">Le plus ancien</option>
			</select>
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="submit">Valider</button>
			</div>
		</div>
	</form>

	<table class="table"> 
		<thead>
			<th>Date</th>
			<th>Heure</th>
			<th>Lieu</th>
			<th>Quantité</th>
		</thead>


		<?php
		$tri = $_POST['trier'];                    

		if(empty($tri))
		{
			$tri = "trier1";
		}
		if ($tri == "trier1")
		{

			$reponse = $bdd->query('SELECT * FROM recensement ORDER BY nombre') ;
			while($donnees=$reponse->fetch())
			{
				echo '<tr>
				<td>'.$donnees['date'].'</td>
				<td>'.$donnees['heure'].'</td>
				<td>'.$donnees['lieu'].'</td>
				<td>'.$donnees['nombre'].'</td>
				</tr>';
			}
		}                    

		if ($tri == "trier2")
		{

			$reponse = $bdd->query('SELECT * FROM recensement ORDER BY nombre DESC') ;
			while($donnees=$reponse->fetch())
			{
				echo '<tr>
				<td>'.$donnees['date'].'</td>
				<td>'.$donnees['heure'].'</td>
				<td>'.$donnees['lieu'].'</td>
				<td>'.$donnees['nombre'].'</td>
				</tr>';
			}
		}                   

		if ($tri == "trier3")
		{

			$reponse = $bdd->query('SELECT * FROM recensement ORDER BY lieu ASC') ;
			while($donnees=$reponse->fetch())
			{
				echo '<tr>
				<td>'.$donnees['date'].'</td>
				<td>'.$donnees['heure'].'</td>
				<td>'.$donnees['lieu'].'</td>
				<td>'.$donnees['nombre'].'</td>
				</tr>';
			}
		}                    

		if ($tri == "trier4")
		{

			$reponse = $bdd->query('SELECT * FROM recensement ORDER BY date ASC') ;
			while($donnees=$reponse->fetch())
			{
				echo '<tr>
				<td>'.$donnees['date'].'</td>
				<td>'.$donnees['heure'].'</td>
				<td>'.$donnees['lieu'].'</td>
				<td>'.$donnees['nombre'].'</td>
				</tr>';
			}
		}                    



		if ($tri == "trier5")
		{

			$reponse = $bdd->query('SELECT * FROM recensement ORDER BY date DESC') ;
			while($donnees=$reponse->fetch())
			{
				echo '<tr>
				<td>'.$donnees['date'].'</td>
				<td>'.$donnees['heure'].'</td>
				<td>'.$donnees['lieu'].'</td>
				<td>'.$donnees['nombre'].'</td>
				</tr>';
			}

		}
	
		?>
	
	</table> 

	<form id="formulaire" method="post" action="">


		<h2 id="titreform">J'ai aperçu un/plusieurs volatile(s) !</h2>

		<div class="form-group row">
			<label class="col-sm col-form-label" for="lieu">Lieu :</label>
			<div class="col-sm">
				<input class="form-control" type="text" name="lieu" placeholder="ex : Auch">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm col-form-label" for="date">Date :</label>
			<div class="col-sm">
				<input class="form-control" type="date" name="date" placeholder="ex : 16/08/2018">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm col-form-label" for="heure">Heure :</label>
			<div class="col-sm">
				<input class="form-control" type="time" name="heure" placeholder="ex : 16h30">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm col-form-label" for="nombre">Nombre :</label>
			<div class="col-sm">
				<input class="form-control" type="number" name="nombre" placeholder="ex : 3">
			</div>
		</div>

		<input id="valider" class="form" type="submit" name="ok" value="Envoyer">
		<a href="interface.php"><button class="btn btn-primary btn-lg btn-block" >J'ai confondu, ce n'était pas un canard !</button></a>
	</form>

	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap.min.js"></script>

	<script type="text/javascript">

		
		function callback()
		{
			$('#presentation').hide();
		};

		$('#valider').click(function firstclick()
		{
			$('#presentation').empty();
			// $('#presentation').show();
			callback();
		});
		
		$('#btnbtn').click(function zakiaclick(callback)
		{
			$('#presentation').hide();
			$('.table').hide();
			$('#formulaire').show();
			callback();
		});




	</script>
</body>
</html>