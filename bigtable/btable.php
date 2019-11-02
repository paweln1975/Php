<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>PHP school</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    
  </head>
<body>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
        <?php
        include_once '../BSNav.php';
        $nav = new BSNav("btable");
        $nav->generate_navigation();
        ?>
    
		<p>Zadanie 3 - wyświetlenie dużej tabeli</p>
		<?php
				
			$baza=mysqli_connect("localhost","ola","ola321","ola");
			
			if (mysqli_connect_errno()) {
				echo "Wystąpił błąd połączenia z bazą.<br>";
			} else {
				echo "Podłączenie do bazy danych ok<br>";
				
				$wynik = mysqli_query($baza,"SELECT * FROM big_table100;");
				
				echo '<table class="tableex"><tr><th>ID</th>';
				
				for( $x = 1; $x <= 100; $x++ )
					echo "<th>COL" . $x . "</th>";
				
				echo "</tr>";
				
				while($row = mysqli_fetch_array($wynik)) {
					echo "<tr>";
					echo "<td>" . $row['id'] . "</td>";
					
					for( $x = 1; $x <= 100; $x++ )
						echo "<td>" . $row['col' . $x] . "</td>";
										
					echo "</tr>"; 
				}
				
				echo "</table>";
			}
			
			mysqli_close($baza);
		?>
	</body>
</html>