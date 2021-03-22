<?php
require_once "../commons/src/inc/convert-to-long-date.php";
$query = "SELECT * FROM resolution";

try {
	$stmt = $pdo->prepare($query);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			require_once "inc/get-case-record.php";

			$date_reported = convert_to_long_date($row->date_time_reported, null);
			$date_resolved = convert_to_long_date($row->date_resolved, null);

			// Display row
			echo <<<ROW
				<tr>
					<td>$row->resolution_id</td>
					<td>$complained_name</td>
					<td>$complainant_name</td>
					<td>$row->offense_subject</td>
					<td>$date_reported</td>
					<td>$date_resolved</td>
					<td><a href="resolved-case-details.php?id=$row->resolution_id" class="fas fa-eye"></a></td>
				</tr>
ROW;
		}
	}
}
catch(PDOException $e) {
	require "../commons/src/inc/terminate-template.php";
}
// connection is closed later after displaying the last table
