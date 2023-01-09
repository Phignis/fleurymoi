<?php
	require_once("config/config.php"); // get all global variables
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>fleurYmoi</title>
	</head>
	<body>
		<?php require("ressources/html_parts/header.php") ?>
		
		<h1>fleurYmoi</h1>
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
		
		<?php require("ressources/html_parts/header.php") ?>
	</body>
</html>
