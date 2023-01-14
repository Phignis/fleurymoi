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

	function createUser($dbConnexion, $passwordNewUser, $emailNewUser, $nameNewUser, $birthNewUser, $pathPicture) {
		// password before other elements cause other should be formated with formatAsQueryArgs -> can use unpack sugar syntax in call

		if(isset($emailNewUser) && isset($passwordNewUser) && isset($nameNewUser)) {
			// TODO: check sql injection & if data are valid
			/*
			 * password_hash($passwordUser, PASSWORD_BCRYPT) encode using bcrypt.
			 * All datas necessary to check equality (algorithm, salt)
			 * are attached to resulting string.
			 * Salt is by default integrated. Deprecated to setup custom salt from 7.0,
			 * custom salt ignored from 8.0
			*/
			$query = "INSERT INTO user_t VALUES($emailNewUser, $nameNewUser, '" . password_hash($passwordNewUser, PASSWORD_BCRYPT) . "', $birthNewUser, $pathPicture)";
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
	
	function modifyUser(mysqli $dbConnexion, ?string $emailUser, ?string $nameUser, ?string $passwordUser, ?string $birthUser, ?string $pathPicture) : bool {
		if(isset($_SESSION["email"]) && !empty($_SESSION["email"])) {
			// TODO: check sql injection & if data are valid
			
			$query = "UPDATE user_t SET email='";
			$query .= (isset($emailUser) && !empty($emailUser)) ? $emailUser : $_SESSION["email"];
			$query .= "'";
			if(isset($nameUser) && !empty($nameUser))
				$query .= ", name='" . $nameUser . "'";
			if(isset($passwordUser) && !empty($passwordUser))
				$query .= ", password='" . password_hash($passwordUser, PASSWORD_BCRYPT) . "'";
			if(isset($birthUser))
				$query .= ", birthdate=" . formatAsQueryArgs($birthUser)[0]; // transform to NULL str if empty
			if(isset($pathPicture) && !empty($pathPicture))
				$query .= ", path_profile_picture='" . $pathPicture . "'";
				
			$query .= " WHERE email='" . $_SESSION["email"] . "'";
			
			$result = executeQuery($query, $dbConnexion);
			
			if($result && $result == true) {
				if(isset($emailUser) && !empty($emailUser))
					$_SESSION['email'] = $emailUser;
				if(isset($birthUser))
					$_SESSION['birthdate'] = $birthUser;
				if(isset($nameUser) && !empty($nameUser))
					$_SESSION['userName'] = $nameUser;
				if(isset($pathPicture) && !empty($pathPicture))
					$_SESSION['profile_picture'] = $pathPicture;
				
				
				
				return true;
				
			} else { // prefer to make else more general, to not inform that a email has been found with separated message if password bad
				global $errors;
				$errors[] = "email déjà utilisé pour un autre compte";
				return false;
			}
		}
	}

	function connect(mysqli $dbConnexion, string $emailUser, string $passwordUser) : bool {

		if(isset($emailUser) && isset($passwordUser)) {
			
			$result = executeQuery("SELECT * FROM user_t WHERE email=$emailUser", $dbConnexion); // get user account if existing
			
			if($result && count($result) == 1 && password_verify(unformatFromQueryArgs($passwordUser)[0], $result[0]["password"])) {
				$_SESSION['connected'] = true;
				$_SESSION['birthdate'] = $result[0]["birthdate"];
				$_SESSION['email'] = $result[0]["email"];
				$_SESSION['userName'] = $result[0]["name"];
				$_SESSION['profile_picture'] = $result[0]["path_profile_picture"];
				
				
				
				return true;
				
			} else { // prefer to make else more general, to not inform that a email has been found with separated message if password bad
				global $errors;
				$errors[] = "Compte inconnu. Connexion impossible";
			}
			
		} else {
			global $errors;
			$errors[] = "Informations données incorrectes";
			// TODO: afficher une vue erreur avec le tableau d'afficher
		}
		
		return false;
	}
