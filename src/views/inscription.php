<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		
		<title>Inscription</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<script src="ressources/js/fetchConfig.js"></script>
		
		<link rel="icon" href="ressources/images/logos/min_logo_fleurYmoi.ico">
		
		
		<link rel="stylesheet" href="ressources/styles/classic/main.css">
		<link rel="stylesheet" href="ressources/styles/classic/inscription.css">
		<link rel="stylesheet" href="ressources/styles/layout.css">
		<link rel="stylesheet" href="ressources/styles/classic/header.css">
	</head>
	
	<body>
		<?php require("ressources/html_parts/header.php"); ?>
		
		
		<div id="messages" class="hidden"></div>
		
		<section id="page_content" class="flex-column-start-left">
			<h1 class="page_title">
				Inscription
			</h1>
			<div class="flex-row-start-center" id="inscription_part">
				<form id="inscription_form" class="flex-column-start-left" name="inscription_form" method="post" action="index.php?action=newInscription">
					<div class="spaced">
						<label for="name">Nom : *</label>
						<input type="text" name="name" id="name" placeholder="name" size="30" maxlength="50">
					</div>
					<div class="spaced">
						<label for="email">Email : *</label>
						<input type="email" name="email" id="email" placeholder="email" size="30" maxlength="40">
					</div>
					<div class="spaced">
						<label for="password">Mot de passe : *</label>
						<input type="password" name="password" id="password" placeholder="password" size="40">
					</div>
					<div class="spaced">
						<label for="birthdate">Date de naissance :</label>
						<input type="date" name="birthdate" id="birthdate">
						<p class="legend" id="birthLegend">des surprises pourraient vous attendre...</p>
					</div>
					<input type="submit" class="interactible-button" id="inscription_button" value="S'inscrire">
				</form>
				<div id="to_connection">
					<a href="index.php?action=connexion" class="link-default">
						déjà un compte?
					</a>
				</div>
			</div>
		</section>
		
		<script src="ressources/js/displayMessages.js"></script>
	</body>
</html>

