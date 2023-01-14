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
	$linkDefaultColor = '#189fa8';
	$linkDefaultDarkerColor = '#117278';
	$successColor = '#b8ddab';
	$errorColor = '#f48282';
	
	function getColors() {
		global $primaryColor, $primaryLighterColor, $primaryBackgroundLighter, $secondaryColor, $secondaryDarkerColor,
			$interactibleColor, $interactibleLighterColor, $interactibleSecondaryColor, $linkDefaultColor,
			$linkDefaultDarkerColor, $successColor, $errorColor;
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
			'link-default' => $linkDefaultColor,
			'link-default-darker' => $linkDefaultDarkerColor,
			'success' => $successColor,
			'error' => $errorColor
		);
		
		echo json_encode($colors); // we return to caller the colors, in JSON format
    }
	
	if(isset($_GET["fetchTheme"]) && $_GET["fetchTheme"] == true) // run func only if contact is to fetch theme, requested by get
		getColors();

	

	$actionList = ['accueil', 'inscription', 'connexion', 'deconnexion', 'account', 'newInscription', 'sessionCreate', 'modifyAccount'];

	$serverName = 'localhost';
	$userName = 'access_fleurYmoi';
	$password = 'fleurYmoi63&';
	$dbName = 'fleurYmoi';
	
	$errors = []; // table having all errors messages related to requests
	$success = []; // table having all success messages related to requests
