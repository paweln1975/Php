<?php
    require_once 'MySQLConnection.php';
    require_once 'MyLogger.php';
    
    abstract class GenericDAO {
        protected abstract function getTableName();
        
        protected abstract function bindParams ($stmt);


        private $conn;
        private $logger;
        private $last_err_msg;
        private $id;
        
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
        
        function getLastErrMessage() {
            return $this->last_err_msg;
        }
        
        function getID() {
            return $this->id;
        }
        
        function getValue($pColumnName) {
            return $this->values[$pColumnName];
        }
        
        function init_column_names() {
            $sql = "SHOW COLUMNS FROM {$this->getTableName()}";
            $res = mysqli_query($this->conn->getConnection(), $sql);
            
            $this->last_err_msg = mysqli_error($this->conn->getConnection());
            if ( $this->last_err_msg != "") {
                $this->logger->getLogger()->error($this->last_err_msg);
                return false;
            }

            while($row = $res->fetch_assoc()){
                $this->columns[] = $row['Field'];
            }
            
            foreach ($this->columns as $item) {
                $this->logger->getLogger()->debug("Column " . $item);   
            }
            
            return true;
        }
        
        function read_by_id ($pKey) {
            $sql = "select * from {$this->getTableName()} where id={$pKey};";
            $this->logger->getLogger()->debug("Executing SQL: " . $sql);
            $result = mysqli_query($this->conn->getConnection(), $sql);
            
            $this->last_err_msg = mysqli_error($this->conn->getConnection());
            if ( $this->last_err_msg != "") {
                $this->logger->getLogger()->error($this->last_err_msg);
                return false;
            }
            
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
            return true;
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
                     
            $this->bindParams($stmt);
            
            mysqli_stmt_execute($stmt);
            
            $this->last_err_msg = mysqli_error($this->conn->getConnection());
            if ( $this->last_err_msg != "") {
                $this->logger->getLogger()->error($this->last_err_msg);
                return false;
            }
            
            return true;
   
	}
        
        public function insert () {
            $sql = "insert into {$this->getTableName()} (";
            $inserts = array();
            $params = array();
            
            foreach ($this->columns as $column) {
                if ($column != 'id') {
                    $inserts[] = "$column";
                    $params[] = "?";
                }
            }
            $sql .= implode(',', $inserts);
            $sql .= ") values (";
            $sql .= implode(',', $params);
            $sql .= ");";
            
            $this->logger->getLogger()->debug("Inserting record sql=" . $sql);
            $stmt = mysqli_prepare($this->conn->getConnection(), $sql);
            
            $this->bindParams($stmt);
            
            mysqli_stmt_execute($stmt);
            
            $this->last_err_msg = mysqli_error($this->conn->getConnection());
            if ( $this->last_err_msg != "") {
                $this->logger->getLogger()->error($this->last_err_msg);
                return false;
            }
            
            $this->id = mysqli_insert_id($this->conn->getConnection());
            
            return true;
        }
        
    }

?>