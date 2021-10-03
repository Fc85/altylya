<?php
include('connection_db.php');

$nom = $_POST['nom_bat'];
$surface= $_POST['surface'];
$volume= $_POST['volume'];
$temp_min= $_POST['temp_min'];
$temp_max= $_POST['temp_max'];
$seuil_humi= $_POST['seuil_humi'];
$seuil_ammoniac= $_POST['seuil_ammo'];
$seuil_poussiere= $_POST['seuil_poussiere'];

$bdd->query("INSERT INTO batiment (nom, surface, volume, temp_min, temp_max, seuil_humi, seuil_ammoniac, seuil_poussiere) VALUES ('".$nom."', '".$surface."', '".$volume."', '".$temp_min."', '".$temp_max."', '".$seuil_humi."', '".$seuil_ammoniac."', '".$seuil_poussiere."')");
header('Location: ../index.php?add=ok');
exit();

?>