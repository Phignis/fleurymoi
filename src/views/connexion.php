<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		
		<title>Connexion</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<script src="ressources/js/fetchConfig.js"></script>
		
		<link rel="icon" href="ressources/images/logos/min_logo_fleurYmoi.ico">
		
		
		<link rel="stylesheet" href="ressources/styles/classic/main.css">
		<link rel="stylesheet" href="ressources/styles/classic/connexion.css">
		<link rel="stylesheet" href="ressources/styles/layout.css">
		<link rel="stylesheet" href="ressources/styles/classic/header.css">
	</head>
	
	<body>
		<?php require("ressources/html_parts/header.php"); ?>
		
		
		<div id="messages" class="hidden"></div>
		
		<section id="page_content" class="flex-column-start-left">
			<h1 class="page_title">
				Connexion
			</h1>
			<div class="flex-row-start-center connexion_part">
				<form id="connect_form" class="flex-column-start-left" name="connect_form" method="post" action="index.php?action=sessionCreate">
					<div class="spaced">
						<label for="email">Email :</label>
						<input type="email" name="email" id="email" placeholder="email" size="30" maxlength="40">
					</div>
					<div class="spaced">
						<label for="password">Mot de passe :</label>
						<input type="password" name="password" id="password" placeholder="password" size="40">
					</div>
					<input type="submit" class="interactible-button" id="connect_button" value="Se connecter">
				</form>
				<div>
					<a href="index.php?action=inscription" class="link-default">
						vous n'avez pas de compte?
					</a>
				</div>
			</div>
		</section>
		
		
		<?php include("ressources/html_parts/footer.php");?>
		
		<script src="ressources/js/displayMessages.js"></script>
	</body>
</html>
