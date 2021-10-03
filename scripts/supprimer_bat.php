<?php
include('connection_db.php');

$id = $_GET['id'];

$bdd->query("DELETE FROM batiment WHERE id=".$id."");
header('Location: ../index.php?suppr=ok');
exit();

?>