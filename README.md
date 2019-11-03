# Php
Training of php for Ola

------------------------------------------------------------------------------
 INSTALLATION
------------------------------------------------------------------------------ 

1. Before starting installing this package check if the following external
   programs are installed:
   
   Apache server version: Apache/2.4.41
   MySQL (version 8.0.18 or above)
   PHP (version 7.3 or above)
   Bootstrap (version 4.3.1) 
   apache-log4php-2.3.0
   
2. Extract the apache-log4php-2.3.0 / zipfile to a dir. 
   
   Create a log4php dir under an include_path.
      Add in php.ini
      include_path = ".;c:\Tools\Apache24\php\apache-log4php-2.3.0\src\main\php"

      Include the Logger class:
   
         require_once('log4php/Logger.php');

3. That's all!

