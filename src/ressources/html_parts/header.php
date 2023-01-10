<header>
	<div id="title_account">
		
		<a href="index.php">
			<?php include("ressources/images/logos/logo_fleurymoi.php") ?>
		<a>
		
		<div id="account">
			<div id="session_actions">
				<a href="index.php?action=<?php echo (isset($_SESSION['connected']) && $_SESSION['connected'] == true) ? "compte" : "connexion"?>">
					<?php
						// if profile picture is set, we set this to src, else default used
						if(isset($_SESSION['profile_picture']) && !empty($_SESSION['profile_picture']))
							echo '<img id="pp_account" src="' . $_SESSION['profile_picture'] . '" alt="Profile Picture">';
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
				
			if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
				echo "<p>" . $_SESSION['user'] . " connected!</p>";
			} else {
				?>
					<p>user not connected</p>
				<?php
			}
		?>
		</div>
	</div>
	<div id="filters">
		
	</div>
</header>
