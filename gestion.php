<!DOCTYPE html>
<html>
<head>
	<?php include('header.php'); ?> <!-- Importation de l'header -->
	<link rel="stylesheet" type="text/css" media="screen" href="/style/gestion.css" /> <!-- Importation de la feuille de style -->
	<script src="/scripts/Chart.js"></script> <!-- Importation de la bibliothèque chart.js -->
</head>

<body>

	<?php
	//Récupération des données du batiment en fonction de l'id
	$id_bat = $_GET['id'];
	$batiment = $bdd->query('SELECT * FROM batiment WHERE id='.$id_bat.'');
	$data_bat = $batiment->fetch();?>

	<h1><?php echo $data_bat['nom'];?></h1> <!-- Affichage du nom du batiment -->

	<h2>Seuils :</h2>

	<!-- Formulaire de modification de seuils -->
	<b><form action="/scripts/mod_bat.php?id=<?php echo $id_bat; ?>" method="post">

		<p><div><li><label for="temp_min">Température minimale(en °C) :</label></li>
		<li><input type="number" id="temp_min" name="temp_min" placeholder="Ex: -15"></li></div>

		<div><li><label for="temp_max">Température maximale(en °C) :</label></li>
		<li><input type="number" id="temp_max" name="temp_max" placeholder="Ex: 35"></li></div>

		<div><li><label for="seuil_humi">Seuil humidité(en %) :</label></li>
		<li><input type="number" id="seuil_humi" name="seuil_humi" placeholder="Ex: 75"></li></div></p>

		<p><div><li><label for="seuil_ammo">Seuil ammoniaque(en ppm) :</label></li>
		<li><input type="number" id="seuil_ammo" name="seuil_ammo" placeholder="Ex: 25"></li></div>
			
		<div><li><label for="seuil_poussiere">Seuil poussière(en µg/m3) :</label></li>
		<li> <input type="number" id="seuil_poussiere" name="seuil_poussiere" placeholder="Ex: 25"></li></div></p>

		<input class="bouton_modifier" type="submit" value="Modifier">

	</form></b>

	<h2>Graphiques :</h2>
	<div class="charts">
	<button type="button" onclick="toggle_graphs();" class="bouton_afficher">Afficher les graphiques</button> <!-- Afficher les graphiques -->
	<p><b>Cliquez sur la valeur en légende afin  d'arrêter son affichage.</b></p>
	<canvas id="journee" height="120%"></canvas> <!-- Canvas contenant un graphique -->
	<canvas id="semaine" height="120%"></canvas> <!-- Canvas contenant un graphique -->
	<canvas id="mois" height="120%"></canvas> <!-- Canvas contenant un graphique -->
	<canvas id="annee" height="120%"></canvas> <!-- Canvas contenant un graphique -->
	<div>
	<?php include('scripts/graphiques_gestion.php'); ?> <!-- Importation du script des graphiques -->
</body>
</html>