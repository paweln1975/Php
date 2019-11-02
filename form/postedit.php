<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../common/styles.css">
    </head>
    <body>
        <p>Zadanie 5 - aktualizacja / wstawienie rekordu</p>
        <p>
            <a class="buttonlink" href="../simple/stable.php">Back</a>
        </p>
        <p>
        <?php
            require_once '../common/GenericDAO.php';
            
            class TPost extends GenericDAO {
                public $summary;
                public $description;
                public $is_read;
                
                function getTableName() {
                    return "post_item";
                }
                function bindParams($stmt) {
                    mysqli_stmt_bind_param($stmt, 'sss', 
                            $this->summary, 
                            $this->description, 
                            $this->is_read);
                }
            }
            $post_dao = new TPost();
            
            $request_method = filter_input(INPUT_SERVER, "REQUEST_METHOD");
            
            
            if ($request_method == "GET")
            {
                $id = filter_input(INPUT_GET, "id");
                // read mode - formular
                $post_dao->read_by_id($id);
                
            } elseif ($request_method == "POST") {
                $post_dao->summary = filter_input(INPUT_POST, "summary");
                $post_dao->description = filter_input(INPUT_POST, "description");
                $post_dao->is_read = filter_input(INPUT_POST, "is_read");
                $id = filter_input(INPUT_POST, "id");
                
                if (!empty($id)) {
                    // update mode
                    $post_dao->update_by_id($id);
                    $post_dao->read_by_id($id);
                } else {
                    if ($post_dao->insert()) {
                        $id = $post_dao->getID();
                        $post_dao->read_by_id($id);
                    } else {
                        die ("Insert failed.");
                    }
                }
            } else {
                die ('Not supported mode.');
            }
            
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
            <p>
            <input name="submit" type="submit" value="Submit"/><br>
            </p>
        </form>
        
        </p>
    </body>
</html>
