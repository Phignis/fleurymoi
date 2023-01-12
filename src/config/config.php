<?php

	// define theme colors, modifiate here to modify everything
	$primaryColor = '#10492a';
	$primaryLighterColor = '#d6f5e3';
	$secondaryColor = '#f3e8ee';
	$secondaryDarkerColor = '#e4abc1';
	$interactibleColor = '#776258';
	$linkDefault = '#189fa8';
	$linkDefaultDarker = '#117278';
	
	function getColors() {
		global $primaryColor, $primaryLighterColor, $secondaryColor, $secondaryDarkerColor,
			$interactibleColor, $linkDefault, $linkDefaultDarker;
		// format all var to an object
		$colors = array(
			"primary" => $primaryColor,
			"primary-lighter" => $primaryLighterColor,
			"secondary" => $secondaryColor,
			"secondary-darker" => $secondaryDarkerColor,
			"interactible" => $interactibleColor,
			"link-default" => $linkDefault,
			"link-default-darker" => $linkDefaultDarker
		);
		
		echo json_encode($colors); // we return to caller the colors, in JSON format
    }
	
	if(isset($_GET["fetchTheme"]) && $_GET["fetchTheme"] == true) // run func only if contact is to fetch theme, requested by get
		getColors();

	

	$actionList = ['accueil', 'inscription', 'connexion', 'deconnexion', 'newInscription', 'sessionCreate'];

	$serverName = 'localhost';
	$userName = 'access_fleurYmoi';
	$password = 'fleurYmoi63&';
	$dbName = 'fleurYmoi';


	$errors = []; // table having all success messages related to request
	$success = []; // table having all success messages related to request
