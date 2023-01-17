<?php
	function displayFlower(string $botanicalName, string $name, string $familyName,
		float $heigth, float $width, int $quantity, string $pathToImg) : void {
			?>
			<div class="plant_tile <?php echo $familyName; // to filter by family in future ?> flex-column-start-center"
				onClick="showDetailledInfoOfPlant(<?php echo "'$botanicalName'"; ?>);">
				<img src="<?php echo $pathToImg; ?>" alt="<?php echo $botanicalName ?>">
				<div class="flex-column-sparound-center div-info">
					<div>
						<p class="main-info"><?php echo $name; ?></p>
						<p><?php echo $botanicalName; ?></p>
					</div>
					<div>
						<p><?php echo "$heigth x $width (h x L)"; ?></p>
						<p class="quantity">x<?php echo $quantity; ?></p>
					</div>
					<p class="family main-info"><?php echo $familyName; ?></p>
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
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	</head>
	
	<body>
		<?php require("ressources/html_parts/header.php"); ?>
		
		<div id="messages" class="hidden"></div>
		
		<section id="page_content">
		
			<h1 class="page_title">
				Plantes possédées
			</h1>
			
			<section id="plant_modal" class="hidden">
				<div class="flex-row-spbetween-center">
					<h3>No plant selected</h3>
					<button type="button" class="closing_button"
						onClick="deletePossededPlant(this)"><span class="material-icons">delete</span></button>
					<button type="button" class="closing_button"
						onClick="closeElementByButton(this, 2)"><span class="material-icons">close</span></button>
					<script src="ressources/js/plant_modal/deletePossededPlant.js"></script>
					<script src="ressources/js/closeElementByButton.js"></script>
				</div>
				<div id="modal_content" class="flex-row-start-center">
				</div>
			</section>
			
			<script src="ressources/js/plant_modal/showDetailledInfoOfPlant.js"></script>
			
			<div id="tiles-container" class="flex-row-sparound-center">
				<?php
					if(isset($plants) && is_array($plants) && count($plants) > 0) {
						foreach($plants as &$plant)
							displayFlower($plant['botanical_name'], $plant['name'], $plant['family_name'],
								$plant['heigth'], $plant['width'], $plant['quantity'], $plant['path_picture']);
					} else {
						
						echo "<p>Vous ne possédez pas encore de plantes</p>";
					}
					
				?>
			</div>
			
		</section>
		
		<div class="fixed-bottom-right flex-row-start-center" id="add_posseded_plant">
			<form id="add_posseded_plant_form" class="right-hidden-padding">
				<select name="plant_name" disabled
					onmousedown="if(this.options.length>3){this.size=3;}">
				</select>
				<input type="number" min="1" max="99999" name="quantity" disabled>
			</form>
			<button type="button" onClick="getPlants()"
			 id="button_non_posseded"><span class="material-icons">add</span></button>
		</div>
		
		<script src="ressources/js/plant_modal/addOrUpdatePlantOfUser.js"></script>
		<script src="ressources/js/plant_modal/getPlants.js"></script>
		
		<script src="ressources/js/displayMessages.js"></script>
	</body>
</html>
