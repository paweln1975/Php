<?php

/**
 *
 * @author pawel
 */
interface DAOInterface {
    public function get_last_error_message();
    public function get_id ();
    public function read_by_id ($pId);
    public function update_by_id ($pId);
    public function delete_by_id ($pId);
    public function insert();
}

?>
