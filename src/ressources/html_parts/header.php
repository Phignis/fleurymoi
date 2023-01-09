<header>
	<div id="title_account">
		<h1>fleurYmoi</h1>
		<div id="account">
			<?php
				if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
					echo $_SESSION['user'] . " connected!";
				} else {
					?>
						user not connected
					<?php
				}
			?>
		</div>
	</div>
</header>
