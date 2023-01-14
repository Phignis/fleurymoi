<?php
	function displayFlower(string $botanicalName, string $name, string $familyName,
		float $heigth, float $width) : void {
			?>
			<div class="plant_tile <?php echo $familyName; // to filter by family in future ?>
				flex-column-start-center">
				<img src="ressources/images/plant_images/geranium_spp.jpg" alt="geranium spp">
				<div class="flex-column-sparound-center" id="div-text">
					<p><?php echo $name; ?></p>
					<p><?php echo $botanicalName; ?></p>
					<p><?php echo "$heigth x $width (h x L)"; ?></p>
					<p><?php echo $familyName; ?></p>
				</div>
			</div>
			<?php
	}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		
		<title>fleurYmoi</title>
		
		<script src="ressources/js/fetchConfig.js"></script>
		
		<link rel="icon" href="ressources/images/logos/min_logo_fleurYmoi.ico">
		
		<meta name="description" content="Avoir des infos sur des plantes">
		<meta name="keywords" content="fleurs, plantes, informations, infos, fleurYmoi, fleurymoi">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		
		<link rel="stylesheet" href="ressources/styles/classic/main.css">
		<link rel="stylesheet" href="ressources/styles/classic/listPossededPlants.css">
		<link rel="stylesheet" href="ressources/styles/layout.css">
		<link rel="stylesheet" href="ressources/styles/classic/header.css">
		
	</head>
	
	<body>
		<?php require("ressources/html_parts/header.php"); ?>
		
		
		<div id="messages" class="hidden"></div>
		
		<section id="page_content">
		
			<h1 class="page_title">
				Plantes possédées
			</h1>
			
			<div id="tiles-container">
				<?php displayFlower("Geranium spp.", "Géranium Vivace", "Géraniacées", 1.5, 0.8); ?>
			</div>
			
		</section>
		
		
		<?php include("ressources/html_parts/footer.php"); // we can print page without footer (no important infos) ?>
		
		<script src="ressources/js/displayMessages.js"></script>
	</body>
</html>
