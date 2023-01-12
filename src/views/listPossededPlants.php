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
		<link rel="stylesheet" href="ressources/styles/classic/header.css">
		
	</head>
	
	<body>
		<?php
			require("ressources/html_parts/header.php");
		?>
		
		<section id="page_content">
		
			<h1 class="page_title">
				Plantes
			</h1>
			
			<p>
				Site en construction...
			</p>
			
			<hr>
			<h3>Liste des utilisateurs déjà inscrits (que faites vous là? il n'y a rien!)</h3>
			<p>
				<?php
					global $serverName, $userName, $password, $dbName; // get global variables
					
					$conn = connectToDB($serverName, $userName, $password, $dbName);
					if($conn) {
						$query = "SELECT * FROM utilisateur";
						
						$result = executeQuery($query, $conn);
						
						
						
						if(!$result) {
							echo "recuperation donnees impossible <br>";
						} else {
								 echo "email:" . $result[0]["email"] . " name: " . $result[0]["name"] ." password: " . $result[0]["password"] .
									" birthdate: " . $result[0]["birthdate"] ." <br>";
						}
						
						if(disconnectFromDB($conn)) {
							echo "GG";
						}
					}
				?>
			</p>
		</section>
		
		<?php include("ressources/html_parts/footer.php"); // we can print page without footer (no important infos) ?>
	</body>
</html>
