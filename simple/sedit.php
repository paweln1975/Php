<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" href="../common/styles.css">
</head>
	<body>
		<p>Zadanie 2 - zmiana flagi dla posta z Y na N, z N na Y</p>
		<?php
		
			function select_record ($p_id = 0) {
				return "SELECT * FROM post_item WHERE id=$p_id;";
			}
			
			function update_record ($p_id = 0, $value) {
				$new_value = "";
				if ($value == "N") {
					$new_value = "Y";
				} else {
					$new_value = "N";
				}
				return "UPDATE post_item SET is_read = '$new_value' WHERE id=$p_id";
			}
		
		
			
			$baza=mysqli_connect("localhost","ola","ola321","ola");
			
			
			if (mysqli_connect_errno()) {
				echo "Wystąpił błąd połączenia z bazą" . "<br>";
			} else {
				echo "Podłączenie do bazy danych ok" . "<br>";
				
				$op = trim($_POST['op']);
				$id = trim($_POST['id']);
				
				if ( $op == 'edit' && !empty($id)) {
					echo "Operacja edycji ...<br>";
				
					$wynik = mysqli_query($baza, select_record($id));
				
					if (mysqli_num_rows($wynik) > 0) {
						$row = mysqli_fetch_array($wynik);
						#echo "Rekord znaleziony. Wartość flagi = " . $row['is_read'] . "<br>";
						
						$sql = update_record($id, $row['is_read']);
						
						if (mysqli_query($baza, $sql)) {
							echo "Aktualizacja pomyślna" . "<br>";
						} else {
							echo "Błąd aktualizacji rekordu: " . mysqli_error($baza);
						} 
					} else {
						echo "Rekord nie znaleziony" . "<br>";
					}
				}
				
				
			}
			mysqli_close($baza);
		?>
		
                <a href=stable.php>Powrót</a>
	</body>
</html>