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
		<?php
			require("ressources/html_parts/header.php");
		?>
		
		<section id="messages" class="hidden"></section>
		
		<section id="page_content">
		
			<h1 class="page_title">
				Plantes
			</h1>
			
			<p>
				Site en construction...
			</p>
			
			<hr>
			<h3>Liste des utilisateurs déjà inscrits (que faites vous là? il n'y a rien!)</h3>
			<p>
				
			</p>
		</section>
		
		<?php include("ressources/html_parts/footer.php"); // we can print page without footer (no important infos) ?>
		
		<script>
			let errors = <?php echo json_encode($errors)?>;
			let success = <?php echo json_encode($success)?>;
			
			// create a paragraph containing the message
			const createMessage = (content) => {
				let toReturn = document.createElement('p');
				toReturn.innerText = content;
				toReturn.classList.add("message");
				return toReturn;
			}
			
			if(errors.length || success.length) { // we have messages to display
				let messSec = document.getElementById("messages");
				
				messSec.classList.remove("hidden");
				messSec.classList.add("fixed-top");
				
				errors.forEach((message) => {
					let para = createMessage(message);
					para.classList.add("error");
					messSec.appendChild(para);
					setTimeout(() => {
						para.classList.add("message-out");
						para.style.opacity = 0;
					}, 2000);
				});
				success.forEach((message) => {
					let para = createMessage(message);
					para.classList.add("success");
					messSec.appendChild(para);
					setTimeout(() => {
						para.classList.add("message-out");
						para.style.opacity = 0;
					}, 2000);
				});
				
				<?php
					// clean up arrays, to make sure to not display it again later during transaction
					// useful if we save arrays in $_SESSION for future display
					$errors = [];
					$success = [];
				 ?>
			}
		</script>
		
	</body>
</html>
