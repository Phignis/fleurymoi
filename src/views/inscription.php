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
		
		
		<section id="messages" class="hidden"></section>
		
		<section id="page_content" class="flex-column-start-left">
			<h1 class="page_title">
				Inscription
			</h1>
			<form id="inscription_form" class="flex-column-start-left" name="inscription_form" method="post" action="index.php?action=newInscription">
				<div class="spaced">
					<label for="name">Nom : *</label>
					<input type="text" name="name" placeholder="name" size="30" maxlength="50" />
				</div>
				<div class="spaced">
					<label for="email">Email : *</label>
					<input type="email" name="email" placeholder="email" size="30" maxlength="40" />
				</div>
				<div class="spaced">
					<label for="password">Mot de passe : *</label>
					<input type="password" name="password" placeholder="password" size="40" />
				</div>
				<div class="spaced">
					<label for="birthdate">Date de naissance :</label>
					<input type="date" name="birthdate" placeholder="birthdate" />
					<p class="legend" id="birthLegend">des surprises pourraient vous attendre...</p>
				</div>
				<input type="submit" class="primary_button" id="connect_button" value="S'inscrire" />
			</form>
		</section>
		
		
		
		<hr>
		<?php include("ressources/html_parts/footer.php"); ?>
		
		<?php include("ressources/js/displayMessages.php"); ?>
	</body>
</html>

