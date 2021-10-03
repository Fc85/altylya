<!DOCTYPE html>
<html>
<head>
	<?php include('header.php'); ?>
	<link rel="stylesheet" type="text/css" media="screen" href="/style/index.css" />
	<script src="/scripts/Chart.js"></script>
	
</head>

<body>

	<?php
	if(isset($_GET['add'])){
		if($_GET['add']=='ok'){?>

		<div class="retour_ok">
		<b>Ajout du batiment effectué avec succès.</b>
		</div>

	<?php 
		}
	}

	if(isset($_GET['suppr'])){
		if($_GET['suppr']=='ok'){?>

		<div class="retour_ok">
		<b>Suppression du batiment effectuée avec succès.</b>
		</div>

	<?php 
		}
	}

	if(isset($_GET['mod'])){
		if($_GET['mod']=='ok'){?>

		<div class="retour_ok">
		<b>Modification des seuils effectuée avec succès.</b>
		</div>

	<?php 
		}
	} ?>
	
	<?php

	$batiment = $bdd->query('SELECT * FROM batiment ORDER BY id');

	for($boucle=0; $data_bat = $batiment->fetch(); $boucle++){
		if($data_bat['id']){
	
			$capteur = $bdd->query('SELECT * FROM capteur WHERE id_bat='.$data_bat['id'].' ORDER BY id DESC LIMIT 1');
			$data_cap = $capteur->fetch();

			if ($data_cap['poussiere'] <= (0.25 * $data_bat['seuil_poussiere'])){
				$color_poussiere = "#1EE90D";
			}else{
				if($data_cap['poussiere'] <= (0.5 * $data_bat['seuil_poussiere'])){
					$color_poussiere = "#CEE90D";
				}else{
					if($data_cap['poussiere'] <= (0.75 * $data_bat['seuil_poussiere'])){
						$color_poussiere = "#E9780D";
					}else{
						$color_poussiere = "#E9170D";
					}
				}
			}

			if ($data_cap['humi'] <= (0.25 * $data_bat['seuil_humi'])){
				$color_humi = "#1EE90D";
			}else{
				if($data_cap['humi'] <= (0.5 * $data_bat['seuil_humi'])){
					$color_humi = "#CEE90D";
				}else{
					if($data_cap['humi'] <= (0.75 * $data_bat['seuil_humi'])){
						$color_humi = "#E9780D";
					}else{
						$color_humi = "#E9170D";
					}
				}
			}

			if ($data_cap['ammoniac'] <= (0.25 * $data_bat['seuil_ammoniac'])){
				$color_ammoniac = "#1EE90D";
			}else{
				if($data_cap['ammoniac'] <= (0.5 * $data_bat['seuil_ammoniac'])){
					$color_ammoniac = "#CEE90D";
				}else{
					if($data_cap['ammoniac'] <= (0.75 * $data_bat['seuil_ammoniac'])){
						$color_ammoniac = "#E9780D";
					}else{
						$color_ammoniac = "#E9170D";
					}
				}
			}

			if ($data_cap['temp'] <= 0){
				if($data_cap['temp'] >= (0.25 * $data_bat['temp_min'])){
					$color_temp = "#0DE9D5";
				}else{
					if($data_cap['temp'] >= (0.5 * $data_bat['temp_min'])){
						$color_temp = "#0DBAE9";
					}else{
						if($data_cap['temp'] >= (0.75 * $data_bat['temp_min'])){
							$color_temp = "#0D67E9";
						}else{
							$color_temp = "#0D1EE9";
						}
					}
				}
			}else{
				if($data_cap['temp'] <= (0.25 * $data_bat['temp_max'])){
					$color_temp = "#1EE90D";
				}else{
					if($data_cap['temp'] <= (0.5 * $data_bat['temp_max'])){
						$color_temp = "#CEE90D";
					}else{
						if($data_cap['temp'] <= (0.75 * $data_bat['temp_max'])){
							$color_temp = "#E9780D";
						}else{
							$color_temp = "#E9170D";
						}
					}
				}
			}?>


			<div class="charts">
				<h3><?php echo $data_bat['nom']; ?></h3>
				
				<canvas height="100%" id="poussiere<?php echo $data_bat['id']; ?>"></canvas>
				<?php
					if($data_cap['poussiere'] >= $data_bat['seuil_poussiere']){
						echo "<img style='width: 15%;' src='/assets/seuil.png'>";
					}
				?>

				<canvas height="100%" id="humidite<?php echo $data_bat['id']; ?>"></canvas>
				<?php
					if($data_cap['humi'] >= $data_bat['seuil_humi']){
						echo "<img style='width: 15%;' src='/assets/seuil.png'>";
					}
				?>

				<canvas height="100%" id="ammoniaque<?php echo $data_bat['id']; ?>"></canvas>
				<?php
					if($data_cap['ammoniac'] >= $data_bat['seuil_ammoniac']){
						echo "<img style='width: 15%;' src='/assets/seuil.png'>";
					}
				?>

				<canvas height="80%" id="temperature<?php echo $data_bat['id']; ?>"></canvas>
				<?php
					if($data_cap['temp'] >= $data_bat['temp_max']){
						echo "<img style='width: 15%;' src='/assets/seuil.png'>";
					}
					if($data_cap['temp'] <= $data_bat['temp_min']){
						echo "<img style='width: 15%;' src='/assets/seuil.png'>";
					}
				?>

				<?php include('scripts/graphiques_index.php'); ?>
				
				<p style=" font-size: 120%;"><b><?php echo $data_cap['temp'];?>°C</b><p>

				<form name="gestion" action="gestion.php?id=<?php echo $data_bat['id']; ?>" method="post">
					<input class="bouton_gestion" type="submit" value="Gestion">
				</form>

				<button onclick="suppression()" class="bouton_supprimer">Supprimer</button>

			</div>

			<script language="Javascript">

			var id = '<?php echo $data_bat["id"]; ?>';

			function suppression(){ 
				// le résultat va être stocké dans une variable appelée resultat 
				resultat=confirm('Etes vous sur de vouloir supprimer <?php echo $data_bat['nom']; ?> ?'); 
				// On compare le résultat par rapport à 1. 1=OK 
				if(resultat =="1"){
					document.location.href="/scripts/supprimer_bat.php?id=<?php echo $data_bat['id']; ?>";
				}
			} 
			</script>

<?php			
		}
	}?>

<a class="ajout_bat" href="batiment.php">
	<div style="border: 0px;" class="charts">
		<h2>Ajouter un batiment</h2>
		<img src="/assets/plus.png"/>
	</div>
</a>
</body>

</html>