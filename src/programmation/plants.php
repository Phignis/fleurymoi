<?php
	function getPossededPlants(mysqli $dbConnexion, string $emailPossessor) : array {
		/*
		 * inner join allows us to join the plant data if botanical name are equals
		 */
		$query = "SELECT p.botanical_name, p.name, p.family_name, p.heigth, p.width, p.path_picture, pp.quantity FROM posseded_plant_tj pp" .
					" INNER JOIN plant_t p ON p.botanical_name=pp.botanical_name" .
					" WHERE pp.email_possessor=$emailPossessor";
		$result =  executeQuery($query, $dbConnexion);
		
		return $result;
	}
