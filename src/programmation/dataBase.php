<?php
	
	function createConnection($serverName, $userName, $password, $dbName) {
		
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

	
