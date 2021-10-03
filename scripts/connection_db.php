<?php
try
{
// Préparation des paramètres du constructeur
$user="passi1614852";
$password="passi1614852"; //mot de passe de MySQL
$base="passi1614852";
$host="91.216.107.183";
$SGBD="mysql:host=$host;dbname=$base";
$options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION; //Captage des exceptions
$bdd = new PDO($SGBD, $user, $password, $options); //construction de $bdd
//echo "Ouverture de la base $base : OK";
//echo "<br>ouverture BDD<br>";
}
catch (Exception $e)
{
die("Erreur : ".$e->getMessage());
}


?>
