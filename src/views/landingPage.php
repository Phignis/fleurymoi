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
		<link rel="stylesheet" href="ressources/styles/layout.css">
		<link rel="stylesheet" href="ressources/styles/classic/header.css">
		
	</head>
	
	<body>
		<?php require("ressources/html_parts/header.php"); ?>
		
		
		<div id="messages" class="hidden"></div>
		
		<section id="page_content">
		
			<h1 class="page_title">
				fleurYmoi
			</h1>
			
			<p>
				Connecte toi ou inscrit toi pour découvrir des informations sur tes plantes!
			</p>
		</section>
		
		
		<?php include("ressources/html_parts/footer.php"); // we can print page without footer (no important infos) ?>
		
		<script src="ressources/js/displayMessages.js"></script>
	</body>
</html>
