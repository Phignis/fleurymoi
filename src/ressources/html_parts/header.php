<header>
	<div id="title_account">
		
		<a href="index.php">
			<?php include("ressources/images/logos/logo_fleurymoi.php") ?>
		<a>
		
		<div id="account">
			<?php $_GET['action'] = 'accueil'; ?>
			<a href="index.php">
				<?php
					
					// if profile picture is set, we set this to src, else default used
					if(isset($_SESSION['profile_picture']) && !empty($_SESSION['profile_picture']))
						echo '<img id="pp_account" src="' . $_SESSION['profile_picture'] . '" alt="Profile Picture">';
					else
						include('ressources/images/user_profile_picture/default.php');
					
					if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
						echo "<p>" . $_SESSION['user'] . " connected!</p>";
					} else {
						?>
							<p>user not connected</p>
						<?php
					}
				?>
			</a>
		</div>
	</div>
	<div id="filters">
		
	</div>
</header>
