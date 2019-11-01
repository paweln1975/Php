<?php
	class CSTable {
		var $conn;
		
		var $sql = "SELECT NAME, OUR_SCORE, OPPONENT_SCORE, MATCH_DATE FROM
					MATCHES m INNER JOIN TEAMS t ON m.OPPONENT_ID = t.ID ";
					
		var $where_draw = "WHERE OUR_SCORE = OPPONENT_SCORE";
		var $where_win = "WHERE OUR_SCORE > OPPONENT_SCORE";
		var $where_defeat = "WHERE OUR_SCORE < OPPONENT_SCORE";
		
		function CSTable ($p_conn) {
			$this->conn = $p_conn;
		}
		
		function display($p_mode) {
			$sql_merge = $this -> sql;
			if ($p_mode == "draw"){
				$sql_merge = $sql_merge . $this -> where_draw;
			} elseif ($p_mode == "win") {
				$sql_merge = $sql_merge . $this -> where_win;	
			} elseif ($p_mode == "defeat") {
				$sql_merge = $sql_merge . $this -> where_defeat;
			}
			
			$sql_merge = $sql_merge . ";";
			
			$result = mysqli_query($this->conn, $sql_merge);
			echo '<table class="tableex">
					<tr>
						<th>DATE</th>
						<th>OPPONENT</th>
						<th>OUR SCORE</th>
						<th>OPPONENT SCORE</th>
						<th>RESULT</th>
					</tr>';
			while($row = mysqli_fetch_array($result)) {
				echo "<tr>";
				echo "<td>" . $row['MATCH_DATE'] . "</td>";
				echo "<td>" . $row['NAME'] . "</td>"; 
				echo "<td>" . $row['OUR_SCORE'] . "</td>";
				echo "<td>" . $row['OPPONENT_SCORE'] . "</td>";
				echo "<td><a href=cs.php?filter=" . $this->calc_result($row['OUR_SCORE'], $row['OPPONENT_SCORE']) . ">" . strtoupper($this->calc_result($row['OUR_SCORE'], $row['OPPONENT_SCORE'])) . "</a></td>";
				echo "</tr>"; 
			}
				
			echo "</table>";
		}
		
		function calc_result ($my_score, $opponent_score) {
			if ($my_score == $opponent_score) {
				return "draw";
			} elseif ($my_score > $opponent_score) {
				return "win";
			} else {
				return "defeat";
			}
		}
	}
?>