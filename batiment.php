<!DOCTYPE html>
<html>
<head>
	<?php include('header.php'); ?>
	<link rel="stylesheet" type="text/css" media="screen" href="/style/batiment.css" />
	<script src="/scripts/Chart.js"></script>
</head>

<body>

  <div class='div_formulaire'>
      <b><form action="/scripts/add_bat.php" method="post">

        <p><li><label for="nom_bat">Nom du batiment:</label></li>
        <li><input type="text" id="nom_bat" name="nom_bat" placeholder="Ex: Poulailler" required></li><p>

        <p><li><label for="surface">Surface(en m2) :</label></li>
        <li><input type="number" id="surface" name="surface" placeholder="Ex: 1500" required></li></p>

        <p><li><label for="volume">Volume(en m3) :</label></li>
        <li><input type="number" id="volume" name="volume" placeholder="Ex: 4500" required></li></p>

        <p><li><label for="temp_min">Température minimale(en °C) :</label></li>
        <li><input type="number" id="temp_min" name="temp_min" placeholder="Ex: -15" required></li></p>

        <p><li><label for="temp_max">Température maximale(en °C) :</label></li>
        <li><input type="number" id="temp_max" name="temp_max" placeholder="Ex: 35" required></li></p>

        <p><li><label for="seuil_humi">Seuil humidité(en %) :</label></li>
        <li><input type="number" id="seuil_humi" name="seuil_humi" placeholder="Ex: 75" required></li></p>

        <p><li><label for="seuil_ammo">Seuil ammoniaque(en µg/m3) :</label></li>
        <li><input type="number" id="seuil_ammo" name="seuil_ammo" placeholder="Ex: 25" required></li></p>
        
        <p><li><label for="seuil_poussiere">Seuil poussière(en ppm) :</label></li>
        <li> <input type="number" id="seuil_poussiere" name="seuil_poussiere" placeholder="Ex: 25" required></li></p>

        <input class="bouton_ajouter" type="submit" value="Ajouter">

      </form></b>
  </div>
</body>

</html>