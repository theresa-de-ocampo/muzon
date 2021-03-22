<?php
if (isset($_POST["submit"])) {
	$remove = ["submit", "cancel", "complained-tbl_length", "guardian-tbl_length", "complainant-tbl_length"];
	foreach ($remove as $key)
		unset($_POST[$key]);
	foreach ($_POST as $key => $val)
		if ($val === "")
			$_POST[$key] = NULL;
	require_once "../../commons/src/inc/dbh.php";

	try {
		$pdo->beginTransaction();

		// Query 1: If complainant is an outsider, attempt to insert record to the parent table.
		if ($_POST["complainant-resident-id"] === NULL) {
			$params = ["DEFAULT", $_POST["fname"], $_POST["mname"], $_POST["lname"], $_POST["contact-no"], $_POST["house-no"], 
				$_POST["street"], $_POST["brgy"], $_POST["city-town"], $_POST["province"]];
			$query = "INSERT INTO complainant_outsider VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $pdo->prepare($query);
			$stmt->execute($params);
			$complainant_outsider_id = $pdo->lastInsertId();
		}
		else
			$complainant_outsider_id = NULL;


		// Query 2: Attempt to insert blotter record.
		$query = <<<QUERY
			INSERT INTO
				blotter (incident_date_time, incident_place, offense_subject, incident_narrative, complained_resident_id, guardian_complained_resident_id, complainant_resident_id, complainant_outsider_id) 
			VALUES
				(?, ?, ?, ?, ?, ?, ?, ?)
QUERY;
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(1, $_POST["incident-date-time"], PDO::PARAM_STR);
		$stmt->bindValue(2, $_POST["incident-place"], PDO::PARAM_STR);
		$stmt->bindValue(3, $_POST["offense-subject"], PDO::PARAM_STR);
		$stmt->bindValue(4, $_POST["incident-narrative"], PDO::PARAM_STR);
		$stmt->bindValue(5, $_POST["complained-resident-id"], PDO::PARAM_INT);
		$stmt->bindValue(6, $_POST["guardian-complained-resident-id"], PDO::PARAM_INT);
		$stmt->bindValue(7, $_POST["complainant-resident-id"], PDO::PARAM_INT);
		$stmt->bindParam(8, $complainant_outsider_id, PDO::PARAM_INT);
		$stmt->execute();
		$pdo->commit();
	}
	catch(PDOException $e) {
		$pdo->rollBack();
		$file = "log.txt";
		include "../../commons/src/inc/catch-template.php";
	}
	finally {
		$message = "Blotter record was successfully added!";
		$redirect = "../blotter.php";
		include "../../commons/src/inc/finally-template.php";
	}
}
