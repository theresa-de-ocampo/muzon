<?php
require_once "../commons/src/inc/convert-to-long-date.php";
require_once "../commons/src/inc/dbh.php";
$query = "SELECT * FROM resident WHERE resident_status = ?";

try {
	$stmt = $pdo->prepare($query);
	$stmt->execute(['Active']);

	if ($stmt->rowCount() > 0) {
		$i = 0;
		define("BDAY_POS", 5);
		define("AGE_POS", 6);
		define("STATUS_POS", 12);
		define("N_DB_FIELDS", 15);
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			echo "<tr>";
			for ($i = 0; $i < N_DB_FIELDS; $i++) {
				if ($i == BDAY_POS) {
					$bday = $row[$i];
					$col = convert_to_long_date($row[$i], null);
					echo "<td>$col</td>";
				}
				else if ($i == AGE_POS) {
					$inner_query = "CALL calculate_age(?, @age)";
					$inner_stmt = $pdo->prepare($inner_query);
					$inner_stmt->execute([$bday]);

					$inner_query = "SELECT @age";
					$inner_stmt = $pdo->prepare($inner_query);
					$inner_stmt->execute();
					$col = $inner_stmt->fetchColumn();
					echo "<td>$col</td>";
					echo "<td>$row[$i]</td>";
				}
				else if ($i == STATUS_POS)
					continue;
				else
					echo "<td>$row[$i]</td>";
			}
			echo <<<CLOSER
					<td><a class="fas fa-user-edit"></a></td>
					<td><a class="fas fa-user-minus"></a></td>
				</tr>
CLOSER;
		}
	}
}
catch(PDOException $e) {
	require "../commons/src/inc/terminate-template.php";
}
// connection is closed later after displaying the household table
