<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require_once '../common/GenericDAO.php';
            
            class TPost extends GenericDAO {
                function getTableName() {
                    return "post_item";
                }
            }
            $me = new TPost();
            
            if (isset($_GET['id'])) {
		$id = $_GET['id'];
                $me->read_by_id($id);
            }
        ?>
        <form>
            <input name="id" type="hidden" value="<?php echo $me->getValue('id'); ?>"/>
            <p>
            <label>Summary:</label><br>
            <input name="summary" type="text" value="<?php echo $me->getValue('summary'); ?>"/><br>
            </p>
            <p>
            <label>Description:</label><br>
            <input name="description" type="text" value="<?php echo $me->getValue('description'); ?>"/><br>
            </p>
            <p>
            <label>Read:</label><br>
            <input name="is_read" type="text" value="<?php echo $me->getValue("is_read") ?>"/><br>
            </p>
        </form>
    </body>
</html>
