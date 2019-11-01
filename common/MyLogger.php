<?php
	require_once ("Logger.php");
	Logger::configure($_SERVER['DOCUMENT_ROOT'] . "/common/logger.xml");
	abstract class MyLogger {
		private $logger;
		private $rustart;
	
                public abstract function getName();

                public function __construct() {
			//$this->logger = Logger::getLogger(get_class($this));
                        $this->logger = Logger::getLogger($this->getName());
			$rustart = getrusage();
		}
    
		public function getLogger() {
			return $this->logger;
		}
		
		private function rutime($ru, $rus, $index) {
			return ($ru["ru_$index.tv_sec"]*1000 + intval($ru["ru_$index.tv_usec"]/1000))
				-  ($rus["ru_$index.tv_sec"]*1000 + intval($rus["ru_$index.tv_usec"]/1000));
		}
		
		public function logTime() {
			$ru = getrusage();
			
			$this->logger->debug("This process used " . $this->rutime($ru, $this->rustart, "utime") . " ms for its computations and spent " . $this->rutime($ru, $this->rustart, "stime") . " ms in system calls");
		}
	}
?>