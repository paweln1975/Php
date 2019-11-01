<?php
    require_once 'MyLogger.php';
	class MySQLConnection {
		
		private $conn;
                private $logger;
		
		function MySQLConnection ($server, $dbname, $user, $password) {
			
                    $this->logger = new class() extends MyLogger {
                        public function getName() { return "MySQLConnection";}
                    };
                    
                    $this->conn = mysqli_connect($server,$user,$password,$dbname);
			if (mysqli_connect_errno()) {
                            $this->logger->getLogger()->error("database connection failed");
			} else {
                            $this->logger->getLogger()->debug("connection to db established successfully");
			}
		}
		
		function getConnection() {
                    return $this->conn;
		}
		
		function disconnect() {
                    if (mysqli_close($this->conn)) {
                        $this->logger->getLogger()->debug("database connection closed successfully");
                    } else {
                        $this->logger->getLogger()->error("connection to db close failed");
                    }
		}
	}

?>