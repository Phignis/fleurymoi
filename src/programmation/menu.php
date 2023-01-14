<?php

	function getSessionMessages() : string {		
		$errors = $_SESSION["errors"] ?? [];
		$success = $_SESSION["success"] ?? [];
		
		return json_encode([$errors, $success]);
	}
	
	function menu() : void {
		
		global $actionList, $errors, $success;
		
		// starting session if not set in order to use $_SESSION
		if(session_status() == PHP_SESSION_NONE) session_start();
		
		$errors = $_SESSION["errors"] ?? [];
		$success = $_SESSION["success"] ?? [];

		
		if(!isset($_REQUEST['action']) || empty($_REQUEST['action'])) { // first time going into website
			// $_REQUEST seach in both $_GET and $_POST method
			require('./views/listPossededPlants.php');
		} else {
			// switch sur les actions possibles
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
					case 'account':
						require('./views/account.php');
						break;
					case 'newInscription' :
						global $serverName, $userName, $password, $dbName; // get global variables
						require("./config/session.php");
						
						$conn = connectToDB($serverName, $userName, $password, $dbName);
						if($conn) {
							$args = formatAsQueryArgs($_REQUEST["email"], $_REQUEST["name"],
								$_REQUEST["birthdate"], null);
						
							// unpack array returned by formatAsQueryArgs
							if(!createUser($conn, $_REQUEST["password"], ...$args)) {
									// error occured, errors contains error message
									// add effect of this error
									$errors[] = "utilisateur non créé!";
									require("views/inscription.php");
							} else {
								$success[] = "Inscription réussie";
								if(connect($conn,
									...formatAsQueryArgs($_REQUEST["email"], $_REQUEST["password"]))) {
									$success[] = "Connexion réussie";
									require('./views/listPossededPlants.php');
								} else {
									require("views/inscription.php");
								}
							}
							
							disconnectFromDB($conn);
							
						} else {
							$errors[] = "Connexion à la base de donnée impossible";
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
							} else {
								require('./views/connexion.php');
							}
							disconnectFromDB($conn);
						} else {
							$errors[] = "Connexion à la base de donnée impossible";
							require("views/connexion.php");
						}
						break;
					case 'modifyAccount':
						global $serverName, $userName, $password, $dbName; // get global variables
						require("./config/session.php");
						
						$conn = connectToDB($serverName, $userName, $password, $dbName);
						
						if($conn) {
							// format password is not necessary, but unpacking operation has to be last param
							if(modifyUser($conn, $_REQUEST["email"], $_REQUEST["name"], $_REQUEST["password"],
								$_REQUEST["birthdate"], null)) {
								// success
								$success[] = "modification prise en compte";
								require('./views/account.php');
							} else {
								require('./views/account.php');
							}
							disconnectFromDB($conn);
						} else {
							$errors[] = "Connexion à la base de donnée impossible";
							require("views/connexion.php");
						}
						break;
				}
			} else {
				$errors[] = "Action non reconnue, mauvaise addresse.";
				require("views/listPossededPlants.php");
			}
		}
		
		
		// save in $_SESSION the arrays to display by js, and keep to other transaction if not displayed		
		$_SESSION["errors"] = $errors;
		$_SESSION["success"] = $success;
	}
	
	if(isset($_GET["fetchMessages"]) && $_GET["fetchMessages"] == true) { // run func only if contact is to fetch messages, requested by get
		if(session_status() == PHP_SESSION_NONE) session_start(); // starting session if not set in order to use $_SESSION
		
		$toReturn = getSessionMessages();
		// remove all messages given to js
		$_SESSION["errors"] = []; // can unset too, here set to empty arrays
		$_SESSION["success"] = [];
		// give messages to js
		echo $toReturn;
	}
