<?php

	function disconnect() : void {
		unset($_SESSION['profile_picture']);
		global $success;
		$str = $_SESSION['userName'] ?? 'utilisateur';
		$str = $str . ' déconnecté';
		$success[] = $str;
		unset($_SESSION['userName']);
		unset($_SESSION['birthdate']);
		unset($_SESSION['email']);
		$_SESSION['connected'] = false;
	}

	function createUser($dbConnexion, $emailNewUser, $nameNewUser, $passwordNewUser, $birthNewUser, $pathPicture) {

		if(isset($emailNewUser) && isset($passwordNewUser) && isset($nameNewUser)) {
			$query = "INSERT INTO utilisateur VALUES($emailNewUser, $nameNewUser, $passwordNewUser, $birthNewUser, $pathPicture)";
			$result = executeQuery($query, $dbConnexion);
			if($result) {
				return true;
			} else {
				global $errors;
				$errors[] = "mail déjà utilisé";
			}
		} else {
			global $errors;
			$errors[] = "Informations manquantes";
		}
		return false;
	}

	function connect(mysqli $dbConnexion, string $emailUser, string $passwordUser) : bool {

		if(isset($emailUser) && isset($passwordUser)) {
			
			$result = executeQuery("SELECT * FROM utilisateur WHERE email=$emailUser", $dbConnexion); // get user account if existing
			
			if($result && count($result) == 1 && $result[0]["password"] == unformatFromQueryArgs($passwordUser)[0]) {
				$_SESSION['connected'] = true;
				// TODO: determine if it's birday'
				$_SESSION['birthdate'] = $result[0]["birthdate"];
				$_SESSION['email'] = $result[0]["email"];
				$_SESSION['userName'] = $result[0]["name"];
				$_SESSION['profile_picture'] = $result[0]["path_profile_picture"];
				
				
				
				return true;
				
			} else { // prefer to make else more general, to not inform that a email has been found with separated message if password bad
				global $errors;
				$errors[] = "Compte inconnu. Connexion impossible";
			}
			
			//~ disconnectFromDB($dbConnexion);
			
		} else {
			global $errors;
			$errors[] = "Informations données incorrectes";
			// TODO: afficher une vue erreur avec le tableau d'afficher
		}
		
		return false;
	}
