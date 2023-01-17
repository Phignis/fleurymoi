<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		
		<title>Inscription</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<script src="ressources/js/fetchConfig.js"></script>
		
		<link rel="icon" href="ressources/images/logos/min_logo_fleurYmoi.ico">
		
		
		<link rel="stylesheet" href="ressources/styles/classic/main.css">
		<link rel="stylesheet" href="ressources/styles/classic/contact.css">
		<link rel="stylesheet" href="ressources/styles/layout.css">
		<link rel="stylesheet" href="ressources/styles/classic/header.css">
	</head>
	<body>
		<?php require("ressources/html_parts/header.php"); ?>
		
		
		<div id="messages" class="hidden"></div>
		
		<section id="page_content" class="flex-column-end-left">
			<h1 class="page_title">
				Contact
			</h1>
			<form class="flex-row-start-center" id="contact_form" action="mailto:qq@gmail.com" method="POST">
				<fieldset class="flex-column-start-center" >
					<legend>Coordonnées</legend>
					<label for="email">Email:</label>
					<input type="email" name="email" id="email" value="<?php echo $_SESSION["email"] ?? "" ?>"
						placeholder="email">
					<label for="name">Nom:</label>
					<input type="text" name="name" id="name" size="4" value="<?php echo $_SESSION["userName"] ?? "" ?>"
						placeholder="nom">
				</fieldset>
				<fieldset class="flex-column-start-center">
					<legend>Description de la raison</legend>
					<fieldset class="flex-column-start-center">
						<legend>Raison de contact</legend>
						<div class="flex-row-start-center">
							<label for="reason_feat">Ajout de fonctionnalités</label>
							<input type="radio" name="reason" id="reason_feat" value="Ajout de fonctionnalités">
						</div>
						<div class="flex-row-start-center">
							<label for="reason_bug">Bug à signaler</label>
							<input type="radio" name="reason" id="reason_bug" value="Problème dans le site">
						</div>
					</fieldset>
					<label for="prob_descript">Description du problème</label>
					<textarea rows ="4" cols ="50" id="prob_descript" name="prob_descript">
					</textarea>
				</fieldset>
				<input class="interactible-button" type="submit" name="send" value="Envoyer">
			</form>
		</section>
		
		<script src="ressources/js/displayMessages.js"></script>
	</body>
</html>
