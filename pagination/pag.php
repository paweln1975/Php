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

    <script language="javascript" type="text/javascript">
	function doReload(no_of_records){
            document.location = 'zadanie4.php?pageno=1&no_of_records=' + no_of_records;
        }
    </script>
</head>
	<body>
	<?php
        include_once '../BSNav.php';
        $nav = new BSNav("pag");
        $nav->generate_navigation();
        ?>
		<p>Zadanie 4 - paginacja dla tabeli</p>
		<?php
			require_once '../common/MyLogger.php';
                        
			$me = new class() extends MyLogger {
				public function getName() { return "Pagination";}
			};
			
				
			$conn=mysqli_connect("localhost","ola","ola321","ola");
			
			if (mysqli_connect_errno()) {
				echo "Wystąpił błąd połączenia z bazą.<br>";
				
			} else {
				$me->getLogger()->debug ("Podłączenie do bazy danych ok");
				
				if (isset($_GET['pageno'])) {
					$pageno = $_GET['pageno'];
				} else {
					$pageno = 1;
				}
				
				if (isset($_GET['no_of_records'])) {
					$no_of_records = $_GET['no_of_records'];
				} else {
					$no_of_records = 10;
				}
				
				$offset = ($pageno-1) * $no_of_records;
				
				// get the total pages
				$total_pages_sql = "SELECT COUNT(*) FROM big_table100";
				
				$me->getLogger()->debug("Executing a query:" . $total_pages_sql);
				$result_pages = mysqli_query($conn,$total_pages_sql);
				
				$total_rows = mysqli_fetch_array($result_pages)[0];
				$me->getLogger()->debug("Query returned " . $total_rows . " rows.");
				
				$total_pages = ceil($total_rows / $no_of_records);
				
				$sql = "SELECT * FROM big_table100 LIMIT $offset, $no_of_records;";
				$me->getLogger()->debug("Executing a query: " . $sql);
				
				$result = mysqli_query($conn,$sql);
				
				echo '<table class="tableex"><tr><th>ID</th>';
				
				for( $x = 1; $x <= 100; $x++ )
					echo "<th>COL" . $x . "</th>";
				
				echo "</tr>";
				
				while($row = mysqli_fetch_array($result)) {
					echo "<tr>";
					echo "<td>" . $row['id'] . "</td>";
					
					for( $x = 1; $x <= 100; $x++ )
						echo "<td>" . $row['col' . $x] . "</td>";
										
					echo "</tr>"; 
				}
				
				echo "</table>";
			}
			
			mysqli_close($conn);
			
			$me->logTime();
		?>
		
		<form>
			<label for="no_of_records">Ilość rekordów na stronie</label>
			<select name="no_of_records" onchange="doReload(this.value);">
				<option value="10" <?php if ($no_of_records == 10) echo "selected"; ?>>10</option>
				<option value="50" <?php if ($no_of_records == 50) echo "selected"; ?>>50</option>
				<option value="100" <?php if ($no_of_records == 100) echo "selected"; ?>>100</option>
			</select>
		</form>
		
		
		<div class="center">
			<div class="pagination">
				<a href="?pageno=1<?php echo "&no_of_records=" .$no_of_records;?>">First</a>
				<a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1) . "&no_of_records=" .$no_of_records; } ?>">Prev</a>
				<a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1) . "&no_of_records=" .$no_of_records;; } ?>">Next</a>
				<a href="?pageno=<?php echo $total_pages . "&no_of_records=" .$no_of_records;; ?>">Last</a>
			</div>
		</div>

		
		
	</body>
</html>