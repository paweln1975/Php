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
                function bindUpdateParams($stmt) {
                    $value1 = $this->getValue('summary');
                    $value2 = 'Modified';
                    $value3 = $this->getValue('is_read');
                    mysqli_stmt_bind_param($stmt, 'sss', $value1, $value2, $value3);
                }
            }
            $post_dao = new TPost();
            
            if (isset($_GET['id'])) {
		$id = $_GET['id'];
                $post_dao->read_by_id($id);
            }
        ?>
        <form>
            <input name="id" type="hidden" value="<?php echo $post_dao->getValue('id'); ?>"/>
            <p>
            <label>Summary:</label><br>
            <input name="summary" type="text" value="<?php echo $post_dao->getValue('summary'); ?>"/><br>
            </p>
            <p>
            <label>Description:</label><br>
            <input name="description" type="text" value="<?php echo $post_dao->getValue('description'); ?>"/><br>
            </p>
            <p>
            <label>Read:</label><br>
            <input name="is_read" type="text" value="<?php echo $post_dao->getValue("is_read"); ?>"/><br>
            </p>
        </form>
        
        <?php
            $post_dao->update_by_id($id)
        ?>
    </body>
</html>
