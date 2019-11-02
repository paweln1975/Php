<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Simple table</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!--link rel="stylesheet" href="../common/styles.css"-->
</head>
	<body>
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="../js/bootstrap.min.js"></script>
		<p>Zadanie 1 - wyświetlenie zawartości tabeli</p>
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="../form/postedit.php">Add new</a>
                    </li>
                </ul>
                
                <p>
		<?php
		
			function generate_form ($p_id) {
				$form = '<form action="sedit.php" method="post">
					<input type="hidden" name="op" value="edit" />
					<input type="hidden" name="id" value="'.$p_id.'" />
					<input type="submit" value="Edit" />
					</form>';
				return $form;
			}
			
                        function generate_form_delete ($pId) {
				$form = '<form action="../form/postedit.php" method="post">
                                        <input type="hidden" name="_method" value="delete" />
					<input type="hidden" name="id" value="'.$pId.'" />
					<input type="submit" value="Delete" />
					</form>';
				return $form;
			}
			
			$baza=mysqli_connect("localhost","ola","ola321","ola");
			
			if (mysqli_connect_errno()) {
				echo "Wystąpił błąd połączenia z bazą.<br>";
			} else {
				$wynik = mysqli_query($baza,"SELECT * FROM post_item;");
				
				echo '<table class="table table-hover">
					<thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
						<th scope="col">SUMMARY</th>
                                                <th scope="col">DESCRIPTION</th>
						<th scope="col">IS READ</th>
						<th scope="col"></th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                    <tbody>';
				while($row = mysqli_fetch_array($wynik)) {
					echo "<tr>";
					echo '<th scope="row"><a href="../form/postedit.php?id=' . $row['id'] . '">' . $row['id'] .  '</a>'.
                                                    "</th>"; 
					echo "<td>" . $row['summary'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
					echo "<td>" . $row['is_read'] . "</td>";
					echo "<td>" . generate_form($row['id']) . "</td>";
                                        echo "<td>" . generate_form_delete($row['id']) . "</td>";
					echo "</tr>"; 
				}
				
				echo "</tbody></table>";
			}
			
			mysqli_close($baza);
		?>
                </p>
	</body>
</html>