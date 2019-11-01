# Php
Training of php for Ola

------------------------------------------------------------------------------
 INSTALLATION
------------------------------------------------------------------------------ 

1. Before starting installing this package check if the following external
   programs are installed:
   
   a. PHP (version 5.2.x or above). 
   
2. Extract the apache-log4php-2.3.0 / zipfile to a dir (ex: {YOUR_PATH}).

   Include log4php under an include_path dir 
   
   a. Create a log4php dir under an include_path.
      Add in php.ini
      include_path = ".;c:\Tools\Apache24\php\apache-log4php-2.3.0\src\main\php"

      Include the Logger class:
   
         require_once('log4php/Logger.php');

3. That's all! For more details on using Apache log4php please see the HTML docs in the site folder.

