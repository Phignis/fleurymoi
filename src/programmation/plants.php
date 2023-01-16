<?php
	function getPossededPlants(mysqli $dbConnexion, string $emailPossessor) {
		
		/*
		 * inner join allows us to join the plant data if botanical name are equals
		 */
		$query = "SELECT p.botanical_name, p.name, p.family_name, p.heigth, p.width, p.path_picture, pp.quantity FROM posseded_plant_tj pp" .
			" INNER JOIN plant_t p ON p.botanical_name=pp.botanical_name" .
			" WHERE pp.email_possessor=$emailPossessor";
		$result =  executeQuery($query, $dbConnexion);
		
		if($result) {
			global $success;
			$success[] = "plantes récupérées avec succès";
		} else {
			global $errors;
			$errors[] = "email non existant";
		}
		
		return $result;
	}
	
	function getDetailledInformation(mysqli $dbConnexion, string $emailPossessor, string $botanicalName) {
		 
		 $query = "SELECT p.*, pp.quantity, pf.description FROM posseded_plant_tj pp" .
			" INNER JOIN plant_t p ON p.botanical_name=pp.botanical_name" .
			" INNER JOIN plant_family_t pf ON pf.name=p.family_name".
			" WHERE pp.email_possessor=$emailPossessor AND p.botanical_name=$botanicalName";
		
		$result = executeQuery($query, $dbConnexion);
		
		if($result) {
			global $success;
			$success[] = "données récupérées";
		} else {
			global $errors;
			$errors[] = "email ou nom botanique invalide";
		}
		
		return $result;
	}
