<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" href="../common/styles.css">
</head>
	<body>
		<p>Zadanie 1 - wyświetlenie zawartości tabeli</p>
		<?php
		
			function generate_form ($p_id) {
				$form = '<form action="zadanie2.php" method="post">
					<input type="hidden" name="op" value="edit" />
					<input type="hidden" name="id" value="'.$p_id.'" />
					<input type="submit" value="Edit" />
					</form>';
				return $form;
			}
			
			
			$baza=mysqli_connect("localhost","ola","ola321","ola");
			
			if (mysqli_connect_errno()) {
				echo "Wystąpił błąd połączenia z bazą.<br>";
			} else {
				echo "Podłączenie do bazy danych ok<br>";
				
				$wynik = mysqli_query($baza,"SELECT * FROM post_item;");
				
				echo '<table class="tableex">
					<tr>
						<th>ID</th>
						<th>SUMMARY</th>
						<th>IS READ</th>
						<th></th>
						</tr>';
				while($row = mysqli_fetch_array($wynik)) {
					echo "<tr>";
					echo "<td>" . $row['id'] . "</td>"; 
					echo "<td>" . $row['summary'] . "</td>";
					echo "<td>" . $row['is_read'] . "</td>";
					echo "<td>" . generate_form($row['id']) . "</td>";					
					echo "</tr>"; 
				}
				
				echo "</table>";
			}
			
			mysqli_close($baza);
		?>
	</body>
</html>