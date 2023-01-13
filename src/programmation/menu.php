<?php
	
	function menu() : void {
		
		if(session_status() == PHP_SESSION_NONE) session_start(); // on start la session si non existante, pour utiliser le tableau $_SESSION
		
		if(!isset($_REQUEST['action']) || empty($_REQUEST['action'])) { // on arrive pour la première fois sur le site, on arrive sur l'accueil
			// request seach in both $_GET and $_POST
			require('./views/listPossededPlants.php');
			
			return;
		}
		
		// switch sur les actions possibles
		
		global $actionList, $errors, $success;
		
		if (in_array($_REQUEST['action'], $actionList)){
			switch($_REQUEST['action']) {
				case 'inscription':
					require('./views/inscription.php');
					break;
					
				case 'connexion':
					require('./views/connexion.php');
					break;
					
				case 'deconnexion' :
					require("./config/session.php");
					
					disconnect();
					require('./views/listPossededPlants.php');
					break;
					
				case 'newInscription' :
					global $serverName, $userName, $password, $dbName; // get global variables
					require("./config/session.php");
					
					$conn = connectToDB($serverName, $userName, $password, $dbName);
					if($conn) {
						$args = formatAsQueryArgs($_REQUEST["email"], $_REQUEST["name"], $_REQUEST["password"],
							$_REQUEST["birthdate"], null);
					
						// unpack array returned by formatAsQueryArgs
						if(!createUser($conn, ...$args)) {
								// error occured, errors contains error message
								// add effect of this error
								$errors[] = "utilisateur non créé!";
						}
						
						if(connect($conn,
							...formatAsQueryArgs($_REQUEST["email"], $_REQUEST["password"]))) {
							$success[] = "Inscription réussie";
							require('./views/listPossededPlants.php');
						}
						
						disconnectFromDB($conn);
						
					} else {
						$errors[] = "Impossible de se connecter à la base de données pour l'instant";
						require("views/inscription.php");
					}
					break;
					
				case 'sessionCreate':
					global $serverName, $userName, $password, $dbName; // get global variables
					require("./config/session.php");
					
					$conn = connectToDB($serverName, $userName, $password, $dbName);
					
					if($conn) {
						
						// format password is not necessary, but unpacking operation has to be last param
						if(connect($conn, ...formatAsQueryArgs($_REQUEST["email"], $_REQUEST["password"]))) {
							// success
							$success[] = "connexion reussie";
							require('./views/listPossededPlants.php');
						}
						disconnectFromDB($conn);
					} else {
						$errors[] = "Impossible de se connecter à la base de données pour l'instant";
						require("views/connexion.php");
					}
					break;
			}
		} else {
			// TODO: erreur action non reconnu
			$errors[] = "Action non reconnue, mauvaise addresse.";
			require("view/listPossededPlants.php");
		}
		
		
	}
