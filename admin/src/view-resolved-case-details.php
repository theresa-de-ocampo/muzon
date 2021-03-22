<?php
require_once "../commons/src/inc/dbh.php";
require_once "../commons/src/inc/convert-to-long-date.php";
$resolution_id = $_SESSION["resolution-id"];
$query = "SELECT * FROM resolution WHERE resolution_id = ?";

try {
	$stmt = $pdo->prepare($query);
	$stmt->bindParam(1, $resolution_id, PDO::PARAM_INT);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		$row = $stmt->fetch(PDO::FETCH_OBJ);
		require_once "inc/get-case-record.php";

		$guardian_id = $row->guardian_complained_resident_id;
		if (!empty($guardian_id)) {
			$inner_query = "SELECT CONCAT(fname, ' ', lname) FROM resident WHERE resident_id = ?";
			$inner_stmt = $pdo->prepare($inner_query);
			$inner_stmt->bindParam(1, $guardian_id, PDO::PARAM_INT);
			$inner_stmt->execute();
			$guardian_name = $inner_stmt->fetchColumn();
		}
		else
			$guardian_name = "N/A";

		$date_time_reported = convert_to_long_date(null, $row->date_time_reported);
		$incident_date_time = convert_to_long_date(null, $row->incident_date_time);
		$date_resolved = convert_to_long_date($row->date_resolved, null);

		echo <<<TBL_CONTENT
			<tr>
				<th>Resolved Case No.</th>
				<td>$row->resolution_id</td>
			</tr>
			<tr>
				<th>Complained Resident</th>
				<td>$complained_name</td>
			</tr>
			<tr>
				<th>Guardian of Complained Resident</th>
				<td>$guardian_name</td>
			</tr>
			<tr>
				<th>Complainant</th>
				<td>$complainant_name</td>
			</tr>
			<tr>
				<th>Date & Time Reported</th>
				<td>$date_time_reported</td>
			</tr>
			<tr>
				<th>Date & Time of Incident</th>
				<td>$incident_date_time</td>
			</tr>
			<tr>
				<th>Date Resolved</th>
				<td>$date_resolved</td>
			</tr>
			<tr>
				<th>Place of Incident</th>
				<td>$row->incident_place</td>
			</tr>
			<tr>
				<th>Status</th>
				<td>$row->blotter_status</td>
			</tr>
			<tr>
				<th>Offense Subject</th>
				<td>$row->offense_subject</td>
			</tr>
			<tr>
				<th>Incident Narrative</th>
				<td>$row->incident_narrative</td>
			</tr>
			<tr>
				<th>Resolution Narrative</th>
				<td>$row->resolution_narrative</td>
			</tr>
TBL_CONTENT;
	}
}
catch(PDOException $e) {
	require "../commons/src/inc/terminate-template.php";
}
finally {
	$pdo = NULL;
}
