<?php

	function disconnect() {
		unset($_SESSION['profile_picture']);
		unset($_SESSION['userName']);
		unset($_SESSION['isBirthdayToday']);
		$_SESSION['connected'] = false;
	}

	function connect($serverDBName, $userNameDB, $passwordDB, $DBName, $emailUser, $passwordUser) {
		$dbContact = connectToDB($serverDBName, $userNameDB, $passwordDB, $DBName);

		if($dbContact && isset($emailUser) && isset($passwordUser)) {
			
			$result = executeQuery("SELECT * FROM utilisateur WHERE email='$emailUser'", $dbContact); // get user account if existing
			
			if($result && count($result) == 1 && $result[0]["password"] == $passwordUser) {
				$_SESSION['connected'] = true;
				// TODO: determine if it's birday'
				$_SESSION['isBirthdayToday'] = false;
				$_SESSION['userName'] = $result[0]["name"];
				$_SESSION['profile_picture'] = $result[0]["path_profile_picture"];
				
				return true;
				
			} else { // prefer to make else more general, to not inform that a email has been found with separated message if password bad
				global $errors;
				$errors[] = "Pas de correspondance d'utilisateur avec l'email $emailUser, ou le mot de passe";
			}
			
			disconnectFromDB($dbContact);
			
		} else {
			global $errors;
			$errors[] = "Connexion à la base de donnée temporairement impossible";
			// TODO: afficher une vue erreur avec le tableau d'afficher
		}
		
		return false;
	}
