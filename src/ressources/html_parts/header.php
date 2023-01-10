<header>
	<div id="title_account">
		
		<a href="/index.php">
			<img id="logo_fleurymoi" src="ressources/images/logo_fleurymoi.svg" alt="fleurYmoi">
		<a>
		
		<div id="account">
			<a href="/views/connexion.php">
				<?php
					
					// if profile picture is set, we set this to src, else default used
					if(isset($_SESSION['profile_picture']) && !empty($_SESSION['profile_picture']))
						echo '<img id="pp_account" src="' . $_SESSION['profile_picture'] . '" alt="Profile Picture">';
					else
						echo '<img id="pp_account" src="/ressources/images/user_profile_picture/default.svg" alt="Profile Picture">';
					
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
