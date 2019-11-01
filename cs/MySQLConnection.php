<?php

	class MySQLConnection {
		
		var $conn;
		
		function MySQLConnection ($server, $dbname, $user, $password) {
			
			$this->conn = mysqli_connect($server,$user,$password,$dbname);
			if (mysqli_connect_errno()) {
				echo "<p>DB connection error</p><br>";
				error_log ("database connection failed");
			} else {
				echo "</p>DB connection ok</p><br>";
			}
		}
		
		function getConnection() {
			return $this->conn;
		}
		
		function disconnect() {
			mysqli_close($this -> conn);
		}
	}

?>