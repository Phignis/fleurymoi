<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		
		<title>Inscription</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<script src="ressources/js/fetchConfig.js"></script>
		
		<link rel="icon" href="ressources/images/logos/min_logo_fleurYmoi.ico">
		
		
		<link rel="stylesheet" href="ressources/styles/classic/main.css">
		<link rel="stylesheet" href="ressources/styles/classic/account.css">
		<link rel="stylesheet" href="ressources/styles/layout.css">
		<link rel="stylesheet" href="ressources/styles/classic/header.css">
	</head>
	<body>
		<?php require("ressources/html_parts/header.php"); ?>
		
		
		<div id="messages" class="hidden"></div>
		
		<section id="page_content" class="flex-column-start-left">
			<h1 class="page_title">
				Compte
			</h1>
			<div class="flex-row-spbetween-end">
				<form id="inscription_form" class="flex-column-start-left" name="inscription_form" method="post" action="index.php?action=modifyAccount">
					<div class="spaced">
						<label for="name">Nom : *</label>
						<input type="text" name="name" id="name" placeholder="name" size="30" maxlength="50"
							<?php if(isset($_SESSION['userName']) && !empty($_SESSION['userName'])) echo 'value="' . $_SESSION['userName'] . '"'; ?>>
					</div>
					<div class="spaced">
						<label for="email">Email : *</label>
						<input type="email" name="email" id="email" placeholder="email" size="30" maxlength="40"
						<?php if(isset($_SESSION['email']) && !empty($_SESSION['email'])) echo 'value="' . $_SESSION['email'] . '"'; ?>>
					</div>
					<div class="spaced">
						<label for="password">Mot de passe : *</label>
						<input type="password" name="password" id="password" placeholder="password" size="40">
					</div>
					<div class="spaced">
						<label for="birthdate">Date de naissance :</label>
						<input type="date" name="birthdate" id="birthdate"
							<?php if(isset($_SESSION['birthdate']) && !empty($_SESSION['birthdate'])) echo 'value="' . $_SESSION['birthdate'] . '"'; ?>>
						<p class="legend" id="birthLegend">ne triche pas... ou pas de surprise!</p>
					</div>
					<input type="submit" class="primary_button" id="connect_button" value="Modifier les informations">
				</form>
				<div id="pp_container">
					<?php
						// if profile picture is set, we set this to src, else default used
						if(isset($_SESSION['profile_picture']) && !empty($_SESSION['profile_picture']))
							echo '<img class="pp_account" src="' . $_SESSION['profile_picture'] . '" alt="Profile Picture">';
						else
							include('ressources/images/user_profile_picture/default.php');
						
					?>
				</div>
			</div>
		</section>
		
		
		<?php include("ressources/html_parts/footer.php"); ?>
		
		<script src="ressources/js/displayMessages.js"></script>
	</body>
</html>
