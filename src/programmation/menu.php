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
			}
		} else {
			// TODO: erreur action non reconnu
		}
	}
