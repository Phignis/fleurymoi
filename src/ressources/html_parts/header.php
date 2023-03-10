<header>
	<div id="title_account">
		
		<a href="index.php">
			<?php include("ressources/images/logos/logo_fleurymoi.php");?>
		</a>
		
		<div id="account" class="flex-column-center-center">
			<div id="session_actions" class="flex-row-center-center">
				<a href="index.php?action=contact">
					<?php include('ressources/images/icons/mail.php'); ?>
				</a>
				<a href="index.php?action=<?php echo (isset($_SESSION['connected']) && $_SESSION['connected'] == true) ? "account" : "connexion"?>">
					<?php
						// if profile picture is set, we set this to src, else default used
						if(isset($_SESSION['profile_picture']) && !empty($_SESSION['profile_picture']))
							echo '<img class="pp_account" id="custom_pp_head" src="' . $_SESSION['profile_picture'] . '" alt="Profile Picture">';
						else
							include('ressources/images/user_profile_picture/default.php');
						
				echo "</a>";

				if(isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
					?>
						<a href="index.php?action=deconnexion"><?php
							include('ressources/images/icons/exit.php');
						?></a>
					<?php
				}
						
			echo "</div>";				
				
			if(isset($_SESSION['userName']) && !empty($_SESSION['userName'])) {
				echo "<p>" . $_SESSION['userName'] . " connecté(e)!</p>";
			} else {
				?>
					<p>non connecté(e)</p>
				<?php
			}
		?>
		</div>
	</div>
	<div id="filters">
		
	</div>
</header>
