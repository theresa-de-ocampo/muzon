<?php
require_once "../commons/src/inc/convert-to-long-date.php";
require_once "../commons/src/inc/dbh.php";
$query = "SELECT * FROM past_officers ORDER BY end_date DESC, officer_position";

try {
	$stmt = $pdo->prepare($query);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			$start_date = convert_to_long_date($row->start_date, null);
			$end_date = convert_to_long_date($row->end_date, null);
			echo <<<ROW
				<tr>
					<td>$row->officer_position</td>
					<td>$row->name</td>
					<td>$start_date</td>
					<td>$end_date</td>
				</tr>
ROW;
		}
	}
}
catch(PDOException $e) {
	require "../commons/src/inc/terminate-template.php";
}
// connection is closed later after displaying the last table
