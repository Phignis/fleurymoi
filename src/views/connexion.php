<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		
		<title>Connexion</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="icon" href="ressources/images/logos/min_logo_fleurYmoi.ico">
		
		
		<link rel="stylesheet" href="ressources/styles/classic/main.css">
		<link rel="stylesheet" href="ressources/styles/classic/header.css">
		
		<script src="ressources/js/session/startSession.js"></script>
	</head>
	
	<body>
		<?php require("ressources/html_parts/header.php"); ?>
		
		<section id="page_content">
			<h1 class="page_title">
				Connexion
			</h1>
			<form id="connect_form" name="connect_form" method="post" action="index.php?action=sessionCreate">
				
				<label for="email">Email :</label>
				<input type="email" name="email" placeholder="email" size="30" maxlength="40" />
				<label for="password">Mot de passe :</label>
				<input type="password" name="password" placeholder="password" size="40" />
				<input type="submit" class="primary_button" id="connect_button" value="connexion">Se connecter</button>
			</form>
		</section>
		
		
		
		<hr>
		<?php include("ressources/html_parts/footer.php");?>
	</body>
</html>
