<?php
if (isset($_POST["submit"])) {
	require_once "../../commons/src/inc/dbh.php";
	$officer_id = $_POST["officer-id"];
	$cause_of_termination = $_POST["cause-of-termination"];
	$date_terminated = $_POST["date-terminated"];
	$termination_narrative = $_POST["termination-narrative"];
	$replacement_id = $_POST["replacement-id"];

	try {
		$pdo->beginTransaction();

		// Query 1: Attempt to retrieve data of newly terminated officer record.
		$query = "SELECT * FROM officer WHERE officer_id = ?";
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(1, $officer_id, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_OBJ);
		$officer_position = $row->officer_position;

		// Query 2: Attempt to insert retrieved record to `terminated_officer` along with the new fields.
		$query = "INSERT INTO terminated_officer VALUES (?, ?, ?, ?, ?, ?, ?)";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(1, "DEFAULT", PDO::PARAM_INT);
		$stmt->bindParam(2, $officer_position, PDO::PARAM_STR);
		$stmt->bindParam(3, $row->start_date, PDO::PARAM_STR);
		$stmt->bindParam(4, $date_terminated, PDO::PARAM_STR);
		$stmt->bindParam(5, $cause_of_termination, PDO::PARAM_STR);
		$stmt->bindParam(6, $termination_narrative, PDO::PARAM_STR);
		$stmt->bindParam(7, $row->resident_id, PDO::PARAM_INT);
		$stmt->execute();

		// Query 3: Attempt to delete retrieved record from `officer`.
		$query = "DELETE FROM officer WHERE officer_id = ?";
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(1, $officer_id, PDO::PARAM_INT);
		$stmt->execute();

		// Query 4: Attempt insert new replacement to `officer`
		$query = "INSERT INTO officer (officer_position, start_date, officer_status, resident_id) VALUES (?, ?, ?, ?)";
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(1, $officer_position, PDO::PARAM_STR);
		$stmt->bindParam(2, $date_terminated, PDO::PARAM_STR);
		$stmt->bindValue(3, 'Current', PDO::PARAM_STR);
		$stmt->bindParam(4, $replacement_id, PDO::PARAM_INT);
		$stmt->execute();

		$pdo->commit();
	}
	catch(PDOException $e) {
		$pdo->rollBack();
		$file = "log.txt";
		include "../../commons/src/inc/catch-template.php";
	}
	finally {
		$message = "An officer was successfully replaced!";
		$redirect = "../home.php";
		include "../../commons/src/inc/finally-template.php";
	}
}
