<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>PHP School</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

  </head>
  <body>
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
    <?php
                include_once '../BSNav.php';
                $nav = new BSNav("stable");
                $nav->generate_navigation();
    ?>    
        
        
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
            
        <div class="container">   
        <div class="row">
            <div class="col-xs-12">
    
        </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-2">
    
            </div>
            <div class="col-xs-4 col-md-8">
                <div <?php if ($hander->get_method() == "DELETE") echo "hidden" ?>>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input name="id" type="hidden" value="<?php echo $post_dao->get_value('id'); ?>"/>
                        <div class="form-group">
                            <label for="summary">Summary</label>
                            <input class="form-control" name="summary" type="text" value="<?php echo $post_dao->get_value('summary'); ?>"/><br>

                            <label for="description">Description</label>
                            <input class="form-control" name="description" type="text" value="<?php echo $post_dao->get_value('description'); ?>"/><br>
                        
                            <label for="is_read">Read</label>
                            <input class="form-control" name="is_read" type="text" value="<?php echo $post_dao->get_value("is_read"); ?>"/><br>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-primary" href="/simple/stable.php" role="button">Back</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xs-4 col-md-2">
    
            </div>
        </div>
        </div>
        
        
    </body>
</html>
