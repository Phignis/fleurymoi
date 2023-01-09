<?php
	require_once("config/config.php"); // get all global variables
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		
		<title>fleurYmoi</title>
		
		<meta name="description" content="Avoir des infos sur des plantes">
		<meta name="keywords" content="fleurs, plantes, informations, infos">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		
	</head>
	<body>
		<?php
			$_SESSION['user'] = 'Toto';
			require("ressources/html_parts/header.php"); ?>
		
		<p>
			Site en construction...
		</p>
		<h3>Liste des utilisateurs déjà inscrits (que faites vous là? il n'y a rien!)</h3>
		<p>
			<?php
				$conn = new mysqli($serverName, $userName, $password, $dbName);
				// Check connection
				if ($conn->connect_error) {
					exit("Connection failed: " . $conn->connect_error);
				} else {
					echo "contact réussi de $serverName/$dbName!<br>";
				}
				
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
				
				$conn->close();
			?>
		</p>
		
		<?php require("ressources/html_parts/footer.php"); ?>
	</body>
</html>
