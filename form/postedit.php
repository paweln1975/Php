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
            require_once '../common/HttpActionHandler.php';
            
            class TPost extends GenericDAO {
                public $summary;
                public $description;
                public $is_read;
                
                function get_table_name() {
                    return "post_item";
                }
                function bind_params($stmt) {
                    mysqli_stmt_bind_param($stmt, 'sss', 
                            $this->summary, 
                            $this->description, 
                            $this->is_read);
                }
            }
            
            class THandler extends HttpActionHandler {
                public function map_to_dao_post_method($pDao) {
                    $pDao->summary = filter_input(INPUT_POST, "summary");
                    $pDao->description  = filter_input(INPUT_POST, "description");
                    $pDao->is_read = filter_input(INPUT_POST, "is_read");
                }
            }
            
            $post_dao = new TPost();
            $hander = new THandler($post_dao);
            
        ?>
        <div <?php if ($hander->get_method() == "DELETE") echo "hidden" ?>>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input name="id" type="hidden" value="<?php echo $post_dao->get_value('id'); ?>"/>
            <p>
            <label>Summary:</label><br>
            <input name="summary" type="text" value="<?php echo $post_dao->get_value('summary'); ?>"/><br>
            </p>
            <p>
            <label>Description:</label><br>
            <input name="description" type="text" value="<?php echo $post_dao->get_value('description'); ?>"/><br>
            </p>
            <p>
            <label>Read:</label><br>
            <input name="is_read" type="text" value="<?php echo $post_dao->get_value("is_read"); ?>"/><br>
            </p>
            <p>
            <input name="submit" type="submit" value="Submit"/><br>
            </p>
        </form>
        </div>
        </p>
    </body>
</html>
