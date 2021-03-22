<?php
require_once "../commons/src/inc/convert-to-long-date.php";
$query = "SELECT * FROM terminated_officers ORDER BY date_terminated, officer_position";

try {
	$stmt = $pdo->prepare($query);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			$start_date = convert_to_long_date($row->start_date, null);
			$date_terminated = convert_to_long_date($row->date_terminated, null);
			echo <<<ROW
				<tr>
					<td>$row->officer_position</td>
					<td>$row->name</td>
					<td>$row->cause_of_termination</td>
					<td>$start_date</td>
					<td>$date_terminated</td>
				</tr>
ROW;
		}
	}
}
catch(PDOException $e) {
	require "../commons/src/inc/terminate-template.php";
}
// connection is closed later after displaying all tables
