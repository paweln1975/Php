<!DOCTYPE html>

<html>
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
        $nav = new BSNav("btable");
        $nav->generate_navigation();
        ?>
    
		<p>Zadanie 4 - wyświetlenie dużej tabeli</p>
		<?php
				
			$baza=mysqli_connect("localhost","ola","ola321","ola");
			
			if (mysqli_connect_errno()) {
				echo "Wystąpił błąd połączenia z bazą.<br>";
			} else {
				echo "Podłączenie do bazy danych ok<br>";
				
				$wynik = mysqli_query($baza,"SELECT * FROM big_table100;");
				
				echo '<table class="table table-sm table-bordered">';
				echo '<thead class="thead-light"><tr><th scope="col">ID</th>';
				for( $x = 1; $x <= 100; $x++ ) {
                                    echo '<th scope="col">COL' . $x . '</th>';
                                }
				
				echo "</tr></thead>";
				echo "<tbody>";
				while($row = mysqli_fetch_array($wynik)) {
					echo "<tr>";
					echo '<td class="text-nowrap">' . $row['id'] . '</td>';
					
					for( $x = 1; $x <= 100; $x++ ) {
                                            echo '<td class="text-nowrap">' . $row['col' . $x] . '</td>';
                                        }
										
					echo '</tr>'; 
				}
				echo "</tbody>";
				echo "</table>";
			}
			
			mysqli_close($baza);
		?>
	</body>
</html>