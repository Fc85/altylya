<script>
	
	Chart.pluginService.register({
		beforeDraw: function (chart) {
			if (chart.config.options.elements.center) {
        //Get ctx from string
        var ctx = chart.chart.ctx;
        
				//Get options from the center object in options
        var centerConfig = chart.config.options.elements.center;
      	var fontStyle = centerConfig.fontStyle || 'Arial';
				var txt = centerConfig.text;
        var color = centerConfig.color || '#000';
        var sidePadding = centerConfig.sidePadding || 20;
        var sidePaddingCalculated = (sidePadding/100) * (chart.innerRadius * 2)
        //Start with a base font of 30px
        ctx.font = "30px " + fontStyle;
        
				//Get the width of the string and also the width of the element minus 10 to give it 5px side padding
        var stringWidth = ctx.measureText(txt).width;
        var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;

        // Find out how much the font can grow in width.
        var widthRatio = elementWidth / stringWidth;
        var newFontSize = Math.floor(30 * widthRatio);
        var elementHeight = (chart.innerRadius * 2);

        // Pick a new font size so it will not be larger than the height of label.
        var fontSizeToUse = Math.min(newFontSize, elementHeight);

				//Set font settings to draw it correctly.
        ctx.textAlign = 'center';
				ctx.textBaseline = 'top';
        var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
        var centerY = (chart.chartArea.top * 3);
        ctx.font = fontSizeToUse+"px " + fontStyle;
        ctx.fillStyle = color;
        
        //Draw text in center
        ctx.fillText(txt, centerX, centerY);
			}
		}
	});


		var config_poussiere = {
			type: 'doughnut',
			data: {
				labels: [
					"Taux de poussière",
					"Marge"
				],
				datasets: [{
					data: [<?php echo $data_cap['poussiere']; ?>, <?php echo ($data_bat['seuil_poussiere'] - $data_cap['poussiere']); ?>],
					backgroundColor: [
						"<?php echo $color_poussiere; ?>",
						"rgb(192, 192, 192, 0.6)"
					],
					borderColor: [
						"<?php echo $color_poussiere; ?>",
						"rgb(192, 192, 192, 1)"
					],
					hoverBackgroundColor: [
						"<?php echo $color_poussiere; ?>",
						"rgb(192, 192, 192, 1)"
					]
				}]
			},
			options: {
				circumference: Math.PI,
				rotation: 1 * Math.PI,
				elements: {
					center: {
						text: '<?php echo $data_cap['poussiere']; ?> ppm',
						color: '#000000', // Default is #000000
						fontStyle: 'Roboto', // Default is Arial
						sidePadding: 30 // Defualt is 20 (as a percentage)
					}
				}
			}
		};


		var config_humidite = {
			type: 'doughnut',
			data: {
				labels: [
					"Taux d'humidité",
					"Marge"
				],
				datasets: [{
					data: [<?php echo $data_cap['humi']; ?>, <?php echo ($data_bat['seuil_humi'] - $data_cap['humi']); ?>],
					backgroundColor: [
						"<?php echo $color_humi; ?>",
						"rgb(192, 192, 192, 0.6)"
					],
					borderColor: [
						"<?php echo $color_humi; ?>",
						"rgb(192, 192, 192, 1)"
					],
					hoverBackgroundColor: [
						"<?php echo $color_humi; ?>",
						"rgb(192, 192, 192, 1)"
					]
				}]
			},
			options: {
				circumference: Math.PI,
				rotation: 1 * Math.PI,
				elements: {
					center: {
						text: '<?php echo $data_cap['humi']; ?> %',
						color: '#000000', // Default is #000000
						fontStyle: 'Roboto', // Default is Arial
						sidePadding: 50 // Defualt is 20 (as a percentage)
					}
				}
			}
		};


		var config_ammoniaque = {
			type: 'doughnut',
			data: {
				labels: [
					"Taux d'ammoniaque",
					"Marge"
				],
				datasets: [{
					data: [<?php echo $data_cap['ammoniac']; ?>, <?php echo ($data_bat['seuil_ammoniac'] - $data_cap['ammoniac']); ?>],
					backgroundColor: [
						"<?php echo $color_ammoniac; ?>",
						"rgb(192, 192, 192, 0.6)"
					],
					borderColor: [
						"<?php echo $color_ammoniac; ?>",
						"rgb(192, 192, 192, 1)"
					],
					hoverBackgroundColor: [
						"<?php echo $color_ammoniac; ?>",
						"rgb(192, 192, 192, 1)"
					]
				}]
			},
			options: {
				circumference: Math.PI,
				rotation: 1 * Math.PI,
				elements: {
					center: {
						text: '<?php echo $data_cap['ammoniac']; ?> µg/m3',
						color: '#000000', // Default is #000000
						fontStyle: 'Roboto', // Default is Arial
						sidePadding: 20 // Defualt is 20 (as a percentage)
					}
				}
			}
		};
		
		var config_temperature = {
			type: 'horizontalBar',
			data: {
				labels: [
					"°C"
				],
				datasets: [{
						label: "Température",
						data: [<?php echo $data_cap['temp'];?>],
						backgroundColor: ["<?php echo $color_temp; ?>"]
				}]
			},
			options: {
				scales: {
					xAxes: [{
						ticks: {
							max: <?php echo $data_bat['temp_max'];?>,
							min: <?php echo $data_bat['temp_min'];?>
						}
					}],
					yAxes: [{
						stacked: true
					}]
				}
			}
		};

		var ctx = document.getElementById("poussiere<?php echo $data_bat['id']; ?>").getContext("2d");
		var poussiere = new Chart(ctx, config_poussiere);

		var ctx = document.getElementById("humidite<?php echo $data_bat['id']; ?>").getContext("2d");
		var humidite = new Chart(ctx, config_humidite);

		var ctx = document.getElementById("ammoniaque<?php echo $data_bat['id']; ?>").getContext("2d");
		var ammoniaque = new Chart(ctx, config_ammoniaque);

		var ctx = document.getElementById("temperature<?php echo $data_bat['id']; ?>").getContext("2d");
		var temperature = new Chart(ctx, config_temperature);

</script>