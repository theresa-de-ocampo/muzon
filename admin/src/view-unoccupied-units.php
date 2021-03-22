<?php
$query = "SELECT * FROM household WHERE household_status = 'Deleted' ORDER BY street, house_no";

try {
	$stmt = $pdo->prepare($query);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			echo <<<ROW
				<tr>
					<td>$row->house_no</td>
					<td>$row->street</td>
				</tr>
ROW;
		}
	}
}
catch(PDOException $e) {
	require "../commons/src/inc/terminate-template.php";
}
// connection is closed later after displaying all tables
