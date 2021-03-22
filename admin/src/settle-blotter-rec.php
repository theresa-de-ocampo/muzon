<?php
if (isset($_POST["submit"])) {
	require_once "../../commons/src/inc/dbh.php";
	$blotter_id = $_POST["blotter-id"];
	$blotter_status = $_POST["blotter-status"];
	$date_resolved = $_POST["date-resolved"];
	$resolution_narrative = $_POST["resolution-narrative"];

	try {
		$pdo->beginTransaction();

		// Query 1: Attempt to retrieve data of newly resolved blotter record.
		$query = "SELECT * FROM blotter WHERE blotter_id = ?";
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(1, $blotter_id, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_OBJ);

		// Query 2: Attempt to insert retrieved record to `resolution` along with the new fields.
		$query = "INSERT INTO resolution VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(1, "DEFAULT", PDO::PARAM_INT);
		$stmt->bindParam(2, $row->date_time_reported, PDO::PARAM_STR);
		$stmt->bindParam(3, $row->incident_date_time, PDO::PARAM_STR);
		$stmt->bindParam(4, $row->incident_place, PDO::PARAM_STR);
		$stmt->bindParam(5, $blotter_status, PDO::PARAM_STR);
		$stmt->bindParam(6, $row->offense_subject, PDO::PARAM_STR);
		$stmt->bindParam(7, $row->incident_narrative, PDO::PARAM_STR);
		$stmt->bindParam(8, $row->complained_resident_id, PDO::PARAM_INT);
		$stmt->bindParam(9, $row->guardian_complained_resident_id, PDO::PARAM_INT);
		$stmt->bindParam(10, $row->complainant_resident_id, PDO::PARAM_INT);
		$stmt->bindParam(11, $row->complainant_outsider_id, PDO::PARAM_INT);
		$stmt->bindParam(12, $resolution_narrative, PDO::PARAM_STR);
		$stmt->bindParam(13, $date_resolved, PDO::PARAM_STR);
		$stmt->execute();

		// Query 3: Delete retrieved record from `blotter`.
		$query = "DELETE FROM blotter WHERE blotter_id = ?";
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(1, $blotter_id, PDO::PARAM_INT);
		$stmt->execute();

		$pdo->commit();
	}
	catch(PDOException $e) {
		$pdo->rollBack();
		$file = "log.txt";
		include "../../commons/src/inc/catch-template.php";
	}
	finally {
		$message = "Case was successfully marked as resolved!";
		$redirect = "../blotter.php";
		include "../../commons/src/inc/finally-template.php";
	}
}
