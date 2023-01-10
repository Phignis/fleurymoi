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
			$_SESSION['user'] = 'Toto';
			$_SESSION['connected'] = true;
			require("ressources/html_parts/header.php");
		?>
		
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
					$query = "SELECT * FROM Utilisateur";
					$result = $conn->query($query);
					
					if(!$result) {
						echo "recuperation donnees impossible <br>";
					} else {
						while($row = $result->fetch_assoc()) {
							 echo "uid:" . $row["uid"] . " name: " . $row["name"] ." password: " . $row["password"] .
								" birthdate: " . $row["birthdate"] ." <br>";
						 }
					}
					
					if(disconnectFromDB($conn)) {
						echo "GG";
					}
				}
			?>
		</p>
		
		<?php include("ressources/html_parts/footer.php"); // we can print page without footer (no important infos) ?>
	</body>
</html>
