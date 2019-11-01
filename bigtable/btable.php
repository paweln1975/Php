<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" href="../common/styles.css">
</head>
	<body>
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