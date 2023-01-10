<?php
	
	function connectToDB($serverName, $userName, $password, $dbName) {
		
		if(isset($serverName) && isset($userName) && isset($password)
			&& isset($dbName)) {
				
			$conn = new mysqli($serverName, $userName, $password, $dbName);
			
			// Check connection
			if (!($conn->connect_error)){
				echo "contact réussi de $serverName/$dbName!<br>";
				
				return $conn;
			}
		}
		
		return NULL; // no valid datas, or there was an error when connecting to sql
	}
	
	function disconnectFromDB($openConnection) {
		
		if(isset($openConnection) && gettype($openConnection) && $openConnection instanceof mysqli) {
				
			$openConnection->close();
			
			return true;
		}
		
		return false; // no valid datas, or there was an error when connecting to sql
	}

	function executeQuery($query) {
		if(isset($query) && !empty($query) && is_string($query)) {
			
			// TODO: Sanitize string : https://www.php.net/manual/en/mysqli.query.php
			
			$result = $conn->query($query);
			
			if($result) {
				return $result->fetch_all(MYSQLI_ASSOC); // get all datas in associative array
			}
		}
		return false;
	}
