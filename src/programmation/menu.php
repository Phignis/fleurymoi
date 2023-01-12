<?php

	function getPlantOf($user) {
		// get datas
		
		// require listPossededPlants, which will no longer get datas
		require('./views/listPossededPlants.php');
		
		return;
	}
	
	function menu() {
		
		if(session_status() == PHP_SESSION_NONE) session_start(); // on start la session si non existante, pour utiliser le tableau $_SESSION
		
		
		if(!isset($_REQUEST['action']) || empty($_REQUEST['action'])) { // on arrive pour la première fois sur le site, on arrive sur l'accueil
			// request seach in both $_GET and $_POST
			require('./views/listPossededPlants.php');
			
			return;
		}
		
		// switch sur les actions possibles
		
		global $actionList;
		
		if (in_array($_REQUEST['action'], $actionList)){
			switch($_REQUEST['action']) {
				case 'connexion':
					require('./views/connexion.php');
					break;
				case 'sessionCreate':
					global $serverName, $userName, $password, $dbName; // get global variables
					require("./config/session.php");
					if(connect($serverName, $userName, $password, $dbName, $_REQUEST["email"], $_REQUEST["password"])) {
						//success
						require('./views/listPossededPlants.php');
					} else {
						global $errors;
						//error occured, errors contains error message
						echo $errors[0];
					}
					break;
				case 'deconnexion' :
					require("./config/session.php");
					
					disconnect();
					require('./views/listPossededPlants.php');
					break;
			}
		} else {
			// TODO: erreur action non reconnu
			$errors[] = "Action non reconnue, mauvaise addresse.";
		}
	}
