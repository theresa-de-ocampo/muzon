<?php
if (isset($_POST["submit"])) {
	unset($_POST["submit"], $_POST["cancel"]);
	foreach ($_POST as $key => $value)
		if (strpos($key, "tbl_length"))
			unset($_POST[$key]);

	require_once "../../commons/src/inc/dbh.php";
	$i = 1;

	try {
		$pdo->beginTransaction();

		foreach ($_POST as $value) {
			// Query 1: Get previous officer.
			$query = <<<QUERY
				SELECT
					officer_id
				FROM
					officer
				WHERE
					officer_position = ? AND
					officer_status = 'Current'
QUERY;
			$stmt = $pdo->prepare($query);
			$stmt->bindParam(1, $i, PDO::PARAM_INT);
			$stmt->execute();
			$prev_officer_id = $stmt->fetchColumn();

			// Query 2: Update `officer_status` and `end_date` of previous officer.
			$query = <<<QUERY
				UPDATE officer
				SET
					officer_status = 'Past',
					end_date = CURDATE()
				WHERE
					officer_id = ?
QUERY;
			$stmt = $pdo->prepare($query);
			$stmt->bindParam(1, $prev_officer_id, PDO::PARAM_INT);
			$stmt->execute();

			// Query 3: Insert new officer.
			$query = <<<QUERY
				INSERT INTO
					officer (officer_position, officer_status, resident_id)
				VALUES
					(?, ?, ?)
QUERY;
			$stmt = $pdo->prepare($query);
			$stmt->bindParam(1, $i, PDO::PARAM_INT);
			$stmt->bindValue(2, 'Current', PDO::PARAM_STR);
			$stmt->bindParam(3, $value, PDO::PARAM_INT);
			$stmt->execute();

			$i += 1;
		}
		
		$pdo->commit();
	}
	catch(PDOException $e) {
		$pdo->rollBack();
		$file = "log.txt";
		include "../../commons/src/inc/catch-template.php";
	}
	finally {
		$message = "New set of officers was successfully published!";
		$redirect = "../home.php";
		include "../../commons/src/inc/finally-template.php";
	}
}
