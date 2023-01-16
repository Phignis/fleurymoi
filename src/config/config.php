<?php

	// define theme colors, modifiate here to modify everything
	$primaryColor = '#10492a';
	$primaryLighterColor = '#d6f5e3';
	$primaryBackgroundLighter = '#eafaf1';
	$secondaryColor = '#f3e8ee';
	$secondaryDarkerColor = '#e4abc1';
	$interactibleColor = '#776258';
	$interactibleLighterColor = '#9d8174';
	$interactibleSecondaryColor = '#dad6d6';
	$interactibleBackgroundColor = '#f2f2f2';
	$interactibleBackgroundActiveColor = '#fff';
	$linkDefaultColor = '#189fa8';
	$linkDefaultDarkerColor = '#117278';
	$successColor = '#b8ddab';
	$errorColor = '#f48282';
	
	$actionList = ['accueil', 'inscription', 'connexion', 'deconnexion', 'account', 'newInscription', 'sessionCreate', 'modifyAccount'];

	$serverName = 'localhost';
	$userName = 'access_fleurYmoi';
	$password = 'fleurYmoi63&';
	$dbName = 'fleurYmoi';
	
	$errors = []; // table having all errors messages related to requests
	$success = []; // table having all success messages related to requests
	
	function getColors() {
		global $primaryColor, $primaryLighterColor, $primaryBackgroundLighter, $secondaryColor, $secondaryDarkerColor,
			$interactibleColor, $interactibleLighterColor, $interactibleSecondaryColor, $interactibleBackgroundColor,
			$interactibleBackgroundActiveColor, $linkDefaultColor, $linkDefaultDarkerColor, $successColor, $errorColor;
		// format all var to an object
		$colors = array(
			'primary' => $primaryColor,
			'primary-lighter' => $primaryLighterColor,
			'primary-background-lighter' => $primaryBackgroundLighter,
			'secondary' => $secondaryColor,
			'secondary-darker' => $secondaryDarkerColor,
			'interactible' => $interactibleColor,
			'interactible-lighter' => $interactibleLighterColor,
			'interactible-secondary' => $interactibleSecondaryColor,
			'interactible-background' => $interactibleBackgroundColor,
			'interactible-background-active' => $interactibleBackgroundActiveColor,
			'link-default' => $linkDefaultColor,
			'link-default-darker' => $linkDefaultDarkerColor,
			'success' => $successColor,
			'error' => $errorColor
		);
		
		echo json_encode($colors); // we return to caller the colors, in JSON format
    }
    
    function getPlant() { // intended to be called with origin set here
		if(session_status() == PHP_SESSION_NONE) session_start();
		
		global $serverName, $userName, $password, $dbName, $errors, $success; // get global variables
		if(file_exists("session.php")) {
			// called from indexs.php
			require("session.php"); // origin here, if not, let app crash
			require("../database/dataBase.php");
			require("../programmation/plants.php");
		} else { // may be context from index.php, if not require will end app
			require("programmation/plants.php");
		}
		
		$conn = connectToDB($serverName, $userName, $password, $dbName);
		if($conn) {
			echo json_encode(getDetailledInformation($conn, ...formatAsQueryArgs($_SESSION["email"],
				$_GET["botanical_name"])));
			disconnectFromDB($conn);
		} else {
			$errors[] = "connexion à la base de données impossible";
			echo json_encode(false);
		}
		$_SESSION["errors"] = $errors; // save tabs for future display
		$_SESSION["success"] = $success;
	}
	
	function getAddablePlants() {
		if(session_status() == PHP_SESSION_NONE) session_start();
	
		global $serverName, $userName, $password, $dbName, $errors, $success; // get global variables
		if(file_exists("session.php")) {
			// called from indexs.php
			require("session.php"); // origin here, if not, let app crash
			require("../database/dataBase.php");
			require("../programmation/plants.php");
		} else { // may be context from index.php, if not require will end app
			require("programmation/plants.php");
		}
		$conn = connectToDB($serverName, $userName, $password, $dbName);
		if($conn) {
			echo json_encode(getNonPossededPlants($conn, ...formatAsQueryArgs($_SESSION["email"])));
			disconnectFromDB($conn);
		} else {
			$errors[] = "connexion à la base de données impossible";
			echo json_encode(false);
		}
		$_SESSION["errors"] = $errors; // save tabs for future display
		$_SESSION["success"] = $success;
	}
	
	if(isset($_GET["fetchTheme"]) && $_GET["fetchTheme"] == true) // run func only if contact is to fetch theme, requested by get
		getColors();
	
	if(isset($_GET["getPlant"]) && $_GET["getPlant"] == true
		&& isset($_GET["botanical_name"]) && !empty($_GET["botanical_name"]))
		getPlant();
		
	if(isset($_GET["getNonPossededPlants"]) && $_GET["getNonPossededPlants"] == true)
		getAddablePlants();
