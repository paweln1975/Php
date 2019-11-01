<!DOCTYPE html>

<html>
<head>
  <link rel="stylesheet" href="styles.css">
  
</head>
	<body>
		<p><a href="cs.php?filter=all">CS matches</a></p>
		
		<?php
			require 'MySQLConnection.php';
			require 'CSTable.php';


			$c = new MySQLConnection('localhost', 'ola', 'ola', 'ola321');
			
			
			$table = new CSTable($c->getConnection());
			
			if (isset($_GET['filter'])) {
				$filter = $_GET['filter'];
			} else {
				$filter = "all";
			}
				
			$table->display($filter);
			
			$c->disconnect();
			
		?>

	</body>
</html>		