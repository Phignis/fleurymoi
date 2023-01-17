<?php
	function getPossededPlants(mysqli $dbConnexion, string $emailPossessor) {		
		/*
		 * inner join allows us to join the plant data if botanical name are equals
		 */
		$query = "SELECT p.botanical_name, p.name, p.family_name, p.heigth, p.width, p.path_picture, pp.quantity FROM posseded_plant_tj pp" .
			" INNER JOIN plant_t p ON p.botanical_name=pp.botanical_name" .
			" WHERE pp.email_possessor=$emailPossessor";
		$result =  executeQuery($query, $dbConnexion);
		
		if(is_array($result)) {
			global $success;
			$success[] = "plantes récupérées avec succès";
		} else {
			global $errors;
			$errors[] = "email non existant";
		}
		
		return $result;
	}
	
	function getPlantsNames(mysqli $dbConnexion) {
		$query = "SELECT botanical_name, name FROM plant_t";
		
		return executeQuery($query, $dbConnexion);
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
	
	function pushPlantPossededInfo(mysqli $dbConnexion, string $emailPossessor, string $botanicalName, $quantity) : bool {
		$query = "INSERT INTO posseded_plant_tj VALUES($emailPossessor, $botanicalName, $quantity)";
		
		global $success;
		
		if(executeQuery($query, $dbConnexion)) {
			$success[] = "$botanicalName bien inséré!";
			return true;
		} else { // maybe it is for update
			$query = "UPDATE posseded_plant_tj SET quantity=$quantity WHERE email_possessor=$emailPossessor AND botanical_name=$botanicalName";
			if(executeQuery($query, $dbConnexion)) { // always true -> update always work
				$success[] = "quantité de $botanicalName bien modifié!";
				return true;
			} else {
				global $errors;
				$errors[] = "erreur lors de l'ajout des données";
			}
		}
		
		return false;
	}
	
	function removePossededPlant(mysqli $dbConnexion, string $emailPossessor, string $botanicalName) : bool {
		$query = "DELETE FROM posseded_plant_tj WHERE email_possessor=$emailPossessor AND botanical_name=$botanicalName";
		
		$result = executeQuery($query, $dbConnexion);
		
		if($result) {
			global $success;
			$success[] = "$botanicalName n'est plus possédé!";
		} else {
			global $errors;
			$errors[] = "$botanicalName n'a pas été supprimé!";
		}
		
		return $result;
	}
