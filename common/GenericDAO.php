<?php
    require_once 'MySQLConnection.php';
    require_once 'MyLogger.php';
    require_once 'DAOInterface.php';
    
    abstract class GenericDAO implements DAOInterface {
        protected abstract function get_table_name();
        
        protected abstract function bind_params ($stmt);


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
        
        function get_last_error_message() {
            return $this->last_err_msg;
        }
        
        function get_id() {
            return $this->id;
        }
        
        function get_value($pColumnName) {
            return $this->values[$pColumnName];
        }
        
        function init_column_names() {
            $sql = "SHOW COLUMNS FROM {$this->get_table_name()}";
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
        
        function read_by_id ($pId) {
            $sql = "select * from {$this->get_table_name()} where id={$pId};";
            $this->logger->getLogger()->debug("Executing SQL: " . $sql);
            $result = mysqli_query($this->conn->getConnection(), $sql);
            
            $this->last_err_msg = mysqli_error($this->conn->getConnection());
            if ( $this->last_err_msg != "") {
                $this->logger->getLogger()->error($this->last_err_msg);
                return false;
            }
            
            $rows = mysqli_num_rows($result); 
            
            if ($rows == 1) {
                $this->logger->getLogger()->debug("Record id={$pId} retrieved successfully");
                $row = mysqli_fetch_array($result);
                
                foreach ($this->columns as $column) {
                    $this->logger->getLogger()->debug ($column . "=" . $row[$column]);
                    $this->values[$column] = $row[$column];
                }
                
            } else {
                $this->logger->getLogger()->warn("0 or more then one records retrieved for id={$pId}");
            }
            return true;
        }
        
        public function update_by_id ($pId){
            $sql = "update {$this->get_table_name()} set ";
            $updates = array();
		
            foreach ($this->columns as $column) {
                if ($column != 'id') {
                    $updates[] = "{$column}=?";
                }
            }
		
            $sql .= implode(',', $updates);
            $sql .= " where id={$pId};";
            
            $this->logger->getLogger()->debug("Updating record sql=" . $sql);
            $stmt = mysqli_prepare($this->conn->getConnection(), $sql);
                     
            $this->bind_params($stmt);
            
            mysqli_stmt_execute($stmt);
            
            $this->last_err_msg = mysqli_error($this->conn->getConnection());
            if ( $this->last_err_msg != "") {
                $this->logger->getLogger()->error($this->last_err_msg);
                return false;
            }
            
            return true;
   
	}
        
        public function insert () {
            $sql = "insert into {$this->get_table_name()} (";
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
            
            $this->bind_params($stmt);
            
            mysqli_stmt_execute($stmt);
            
            $this->last_err_msg = mysqli_error($this->conn->getConnection());
            if ( $this->last_err_msg != "") {
                $this->logger->getLogger()->error($this->last_err_msg);
                return false;
            }
            
            $this->id = mysqli_insert_id($this->conn->getConnection());
            
            return true;
        }
        
        public function delete_by_id ($pId) {
            $sql = "delete from {$this->get_table_name()} where id={$pId};";
            $this->logger->getLogger()->debug("Deleting record sql=" . $sql);
            $stmt = mysqli_prepare($this->conn->getConnection(), $sql);
            
            mysqli_stmt_execute($stmt);
            
            $this->last_err_msg = mysqli_error($this->conn->getConnection());
            if ( $this->last_err_msg != "") {
                $this->logger->getLogger()->error($this->last_err_msg);
                return false;
            }
            
            return true;
        }
        
    }

?>