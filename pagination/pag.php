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

    <script language="javascript" type="text/javascript">
	function doReload(no_of_records){
            document.location = 'pag.php?pageno=1&no_of_records=' + no_of_records;
        }
    </script>
</head>
<body>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
	<?php
        include_once '../BSNav.php';
        $nav = new BSNav("pag");
        $nav->generate_navigation();
        ?>
            <p>Zadanie 5 - paginacja dla tabeli</p>
                
            <div class="container-fluid">
                <div style="overflow-y: auto;">
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
				
				echo '<table class="table table-sm table-bordered">';
				echo '<thead class="thead-light"><tr><th scope="col">ID</th>';
				for( $x = 1; $x <= 20; $x++ ) {
                                    echo '<th scope="col">COL' . $x . '</th>';
                                }
				
				echo "</tr></thead>";
				echo "<tbody>";
				while($row = mysqli_fetch_array($result)) {
					echo "<tr>";
					echo '<td class="text-nowrap">' . $row['id'] . '</td>';
					
					for( $x = 1; $x <= 20; $x++ ) {
                                            echo '<td class="text-nowrap">' . $row['col' . $x] . '</td>';
                                        }
										
					echo '</tr>'; 
				}
				echo "</tbody>";
				echo "</table>";
			}
			
			mysqli_close($conn);
			
			$me->logTime();
		?>
                </div>
                </div>
                
                <div class="row">
                    <div class="col-md-2">
                        <form class="form-inline">
                            <label for="no_of_records">Show&nbsp;</label>
			<select class="form-control form-control-sm" name="no_of_records" onchange="doReload(this.value);">
				<option value="10" <?php if ($no_of_records == 10) echo "selected"; ?>>10</option>
				<option value="50" <?php if ($no_of_records == 50) echo "selected"; ?>>50</option>
				<option value="100" <?php if ($no_of_records == 100) echo "selected"; ?>>100</option>
			</select>
                        <label>&nbsp;records</label>
                        </form>
                    </div>
                    <div class="col-xs-12 col-md-10">
                        <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item <?php if($pageno <= 1){ echo 'disabled';} ?>"><a class="page-link" href="?pageno=1<?php echo "&no_of_records=" .$no_of_records;?>">First</a></li>
                                    <li class="page-item <?php if($pageno <= 1){ echo 'disabled';} ?>"><a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1) . "&no_of_records=" .$no_of_records; } ?>">Prev</a></li>
                                    <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled';} ?>"><a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1) . "&no_of_records=" .$no_of_records;; } ?>">Next</a></li>
                                    <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled';} ?>"><a class="page-link" href="?pageno=<?php echo $total_pages . "&no_of_records=" .$no_of_records;; ?>">Last</a></li>
                                </ul>
                        </nav>
                    </div>
                </div>
                

		
		
	</body>
</html>