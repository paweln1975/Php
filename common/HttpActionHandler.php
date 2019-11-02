<?php
require_once 'MyLogger.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HttpActionHandler
 *
 * @author pawel
 */
abstract class HttpActionHandler {
    private $logger;
    //put your code here
    public abstract function map_to_dao_post_method ($pDao);
    
    private $method = "GET";
    public function get_method() {
        return $this->method;
    }
    public function __construct($pDAO) {
        $this->logger = new class() extends MyLogger {
                public function getName() { return "HttpActionHandler";}
            };
            
        $request_method = filter_input(INPUT_SERVER, "REQUEST_METHOD");
        $this->logger->getLogger()->debug("Request method = " . $request_method);
        
        if ($request_method == "GET") {
            $id = filter_input(INPUT_GET, "id");
            // read mode - formular
            $pDAO->read_by_id($id);
                
        } elseif ($request_method == "POST") {
            $id = filter_input(INPUT_POST, "id");
                
            // delete case
            $delete_mode = filter_input(INPUT_POST, "_method");
                
            if ($delete_mode === "delete") {
                $this->method = "DELETE";
                $pDAO->delete_by_id ($id);
            } else {
                
                    $this->map_to_dao_post_method($pDAO);
               
                    if (!empty($id)) {
                        // update mode
                        $this->method = "POST";
                        $pDAO->update_by_id($id);
                        $pDAO->read_by_id($id);
                    } else {
                        $this->method = "PUT";
                        if ($pDAO->insert()) {
                            $id = $pDAO->get_id();
                            $pDAO->read_by_id($id);
                        } else {
                            die ("Insert failed.");
                        }
                    }
                }
            } 
            else {
                die ('Not supported mode.');
            }
    }
}

?>
