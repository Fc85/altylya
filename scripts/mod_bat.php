<?php
include('connection_db.php');

$id= $_GET['id'];
$temp_min= $_POST['temp_min'];
$temp_max= $_POST['temp_max'];
$seuil_humi= $_POST['seuil_humi'];
$seuil_ammoniac= $_POST['seuil_ammo'];
$seuil_poussiere= $_POST['seuil_poussiere'];

if($temp_min != ""){
    $bdd->query("UPDATE batiment SET temp_min=".$temp_min." WHERE id=".$id."");
}
if($temp_max != ""){
    $bdd->query("UPDATE batiment SET temp_max=".$temp_max." WHERE id=".$id."");
}
if($seuil_humi != ""){
    $bdd->query("UPDATE batiment SET seuil_humi=".$seuil_humi." WHERE id=".$id."");
}
if($seuil_ammoniac != ""){
    $bdd->query("UPDATE batiment SET seuil_ammoniac=".$seuil_ammoniac." WHERE id=".$id."");
}
if($seuil_poussiere != ""){
    $bdd->query("UPDATE batiment SET seuil_poussiere=".$seuil_poussiere." WHERE id=".$id."");
}
header('Location: ../index.php?mod=ok');
exit();

?>