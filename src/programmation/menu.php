<?php

	function getPlantOf($user) {
		// get datas
		
		// require listPossededPlants, which will no longer get datas
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
		
		switch($_REQUEST['action']) {
			
		}
	}
