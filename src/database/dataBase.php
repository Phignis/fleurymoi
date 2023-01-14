<?php
	function formatAsQueryArgs(?string ...$paramsToFormat) : array {
		// in param part, ... allows you to pack numerous params given at function call in array
		foreach($paramsToFormat as &$toFormat) { // & allows to directly modify elements of array
			if($toFormat !== null && !empty($toFormat)) {
				if(!preg_match("/^'.*/", $toFormat)) {
					$toFormat = "'" . $toFormat;
				}
				if(!preg_match("/.*'$/", $toFormat)) {
					$toFormat = $toFormat . "'";
				}
			} else {
				$toFormat = 'NULL'; // add NULL in terms of SQL, has to be string
			}
		}
		return $paramsToFormat;
	}
	
	function unformatFromQueryArgs(?string ...$paramsToFormat) : array {
		// in param part, ... allows you to pack numerous params given at function call in array
		foreach($paramsToFormat as &$toFormat) { // & allows to directly modify elements of array
			if($toFormat !== null) {
				
				if(preg_match("/^'.*'$/", $toFormat)) {
					// remove first then last character : the simple quotes
					$toFormat = substr(substr($toFormat, 1), 0, strlen($toFormat) - 2); // - 2 cause index start from zero and last position is included
				}
				else throw new Exception("param non null ou ne correspondant pas à une query format");
			} else {
				$toFormat = null;
			}
		}
		return $paramsToFormat;
	}
	
	function connectToDB(string $serverName, string $userName, string $password, string $dbName) {
		
		if(!empty($serverName) && !empty($userName) && !empty($password)
			&& !empty($dbName)) {
				
			$conn = new mysqli($serverName, $userName, $password, $dbName);
			
			// Check connection
			if (!($conn->connect_error)){
				return $conn;
			}
		}
		
		return NULL; // no valid datas, or there was an error when connecting to sql
	}
	
	function disconnectFromDB(mysqli $openConnection) : bool {
		
		if(isset($openConnection) && $openConnection instanceof mysqli) {
			// instanceof works only on class, not primitive type
				
			$openConnection->close();
			
			return true;
		}
		
		return false; // no valid datas, or there was an error when connecting to sql
	}

	
	function executeQuery(string $query, mysqli $DBConnexion) {
		if(!empty($query) && is_string($query)) {
			
			// TODO: Sanitize string : https://www.php.net/manual/en/mysqli.query.php
			
			$result = $DBConnexion->query($query);
			
			if($result) {
				return (is_bool($result)) ? $result : $result->fetch_all(MYSQLI_ASSOC); // get all datas in associative array
			}
		}
		return false;
	}
