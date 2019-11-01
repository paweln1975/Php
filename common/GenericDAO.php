<?php
    require_once 'MySQLConnection.php';
    require_once 'MyLogger.php';
    
    abstract class GenericDAO {
        protected abstract function getTableName();
        
        protected abstract function bindUpdateParams ($stmt);


        private $conn;
        private $logger;
        
        protected $columns = array();
        protected $values = array();
        
        function __construct() {
            $this->conn = new MySQLConnection("localhost", "ola", "ola", "ola321");
            $this->logger = new class() extends MyLogger {
                public function getName() { return "GenericDAO";}
            };
            
            $this->init_column_names();
        }
        
        function __destruct() {
            $this->conn->disconnect();
        }
        
        function getValue($pColumnName) {
            return $this->values[$pColumnName];
        }
        
        function init_column_names() {
            $sql = "SHOW COLUMNS FROM {$this->getTableName()}";
            $res = mysqli_query($this->conn->getConnection(), $sql);

            while($row = $res->fetch_assoc()){
                $this->columns[] = $row['Field'];
            }
            
            foreach ($this->columns as $item) {
                $this->logger->getLogger()->debug("Column " . $item);
                
            }
        }
        
        function read_by_id ($pKey) {
            $sql = "select * from {$this->getTableName()} where id={$pKey};";
            $this->logger->getLogger()->debug("Executing SQL: " . $sql);
            $result = mysqli_query($this->conn->getConnection(), $sql);
            $rows = mysqli_num_rows($result); 
            
            if ($rows == 1) {
                $this->logger->getLogger()->debug("Record id={$pKey} retrieved successfully");
                $row = mysqli_fetch_array($result);
                
                foreach ($this->columns as $column) {
                    $this->logger->getLogger()->debug ($column . "=" . $row[$column]);
                    $this->values[$column] = $row[$column];
                }
                
            } else {
                $this->logger->getLogger()->warn("0 or more then one records retrieved for id={$pKey}");
            }
        }
        
        public function update_by_id ($id){
            $sql = "update {$this->getTableName()} set ";
            $updates = array();
		
            foreach ($this->columns as $column) {
                if ($column != 'id') {
                    $updates[] = "{$column}=?";
                }
            }
		
            $sql .= implode(',', $updates);
            $sql .= " where id={$id};";
            
            $this->logger->getLogger()->debug("Updating record sql=" . $sql);
            $stmt = mysqli_prepare($this->conn->getConnection(), $sql);
                     
            $this->bindUpdateParams($stmt);
            
            mysqli_stmt_execute($stmt);
            
            
    
	}
        
    }

?>