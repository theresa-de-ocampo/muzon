<?php
require_once "../commons/src/inc/dbh.php";
$query = "SELECT * FROM blotter";

try {
	$stmt = $pdo->prepare($query);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			require "inc/get-case-record.php";

			// Display row
			echo <<<ROW
				<tr>
					<td>$row->blotter_id</td>
					<td>$complained_name</td>
					<td>$complainant_name</td>
					<td>$row->offense_subject</td>
					<td>$row->blotter_status</td>
					<td><a href="blotter-details.php?id=$row->blotter_id" class="fas fa-eye"></a></td>
					<td><a class="fas fa-check-circle"></a></td>
				</tr>
ROW;
		}
	}
}
catch(PDOException $e) {
	require "../commons/src/inc/terminate-template.php";
}
finally {
	$pdo = NULL;
}
