<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>PHP School</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    
  </head>
  <body>
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
    <?php
        include_once 'BSNav.php';
        $nav = new BSNav("");
        $nav->generate_navigation();
    ?>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">PHP</div>
                <div class="card-body">
                    <h5 class="card-title">TODO elements for PHP</h5>
                    <ul class="list-group">
                        <li class="list-group-item">Generic table class</li>
                        <li class="list-group-item">Sorting</li>
                        <li class="list-group-item">Simple search</li>
                        <li class="list-group-item">Basics from w3schools</li>
                        <li class="list-group-item list-group-item-success">Starting servers as Win services</li>
                        <li class="list-group-item">Error handling - simple case: No MySQL db available</li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header">JS</div>
                <div class="card-body">
                    <h5 class="card-title">TODO elements for Java/Java Script</h5>
                    <ul class="list-group">
                        <li class="list-group-item">Basics from w3schools</li>
                        <li class="list-group-item">AJAX</li>
                        <li class="list-group-item">jQuery</li>
                        <li class="list-group-item">Selenium tests</li>
                    </ul>
                </div>
            </div>
            <p>
            <div class="card">    
            <div class="card card-body">
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Colors example
            </a>
            </p>
            <div class="collapse" id="collapseExample">
                
    
                    <ul class="list-group">
                        <li class="list-group-item">Example</li>
                        <li class="list-group-item list-group-item-primary">A simple primary list group item</li>
                        <li class="list-group-item list-group-item-secondary">A simple secondary list group item</li>
                        <li class="list-group-item list-group-item-success">A simple success list group item</li>
                        <li class="list-group-item list-group-item-danger">A simple danger list group item</li>
                        <li class="list-group-item list-group-item-warning">A simple warning list group item</li>
                        <li class="list-group-item list-group-item-info">A simple info list group item</li>
                        <li class="list-group-item list-group-item-light">A simple light list group item</li>
                        <li class="list-group-item list-group-item-dark">A simple dark list group item</li>
                    </ul>
                </div>
            </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">Bootstrap</div>
                <div class="card-body">
                    <h5 class="card-title">TODO elements for Bootstrap</h5>
                    <ul class="list-group">
                        
                            <li class="list-group-item">Add to pagination/big table page - test small table</li>
                            <li class="list-group-item">Use Pagination</li>
                            <li class="list-group-item list-group-item-success">Formular</li>
                            <li class="list-group-item">Check if jQuery is needed and move to offline</li>
                            <li class="list-group-item">Grid</li>
                            <li class="list-group-item">Alerts - success and error handling</li>
                            <li class="list-group-item">Modal dialog - remove confirmation</li>
                        
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header">HTML Forms</div>
                <div class="card-body">
                    <h5 class="card-title">TODO elements for forms</h5>
                    <ul class="list-group">
                        
                        <li class="list-group-item">Allowable values</li>
                        <li class="list-group-item">Reference to dictionary</li>
                        <li class="list-group-item">Date picker</li>
                        <li class="list-group-item">Validations</li>
                        <li class="list-group-item">Other types of fields</li>
                        <li class="list-group-item list-group-item-success">Use bootstrap button for submit form</li>
                        <li class="list-group-item">Confirmation after save/insert operation</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    
  </body>
</html>