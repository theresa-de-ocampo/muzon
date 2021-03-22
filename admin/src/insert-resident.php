<?php
if (isset($_POST["add"])) {
	unset($_POST["add"]);
	unset($_POST["resident-id"]);
	require_once "../../commons/src/inc/dbh.php";

	try {
		$pdo->beginTransaction();
		$address = [$_POST["house-no"], $_POST["street"]];

		// Check first if the resident's address is already existing in `household`
		$query = <<<QUERY
			SELECT 
				COUNT(house_no)
			FROM 
				household
			WHERE
				house_no = ? AND
				street = ? AND
				household_status = 'Active'
QUERY;
		$stmt = $pdo->prepare($query);
		$stmt->execute($address);
		$flag = $stmt->fetchColumn();

		// If address is not yet recorded
		if (!$flag) {
			// Restore record from archive if it exists
			$query = <<<QUERY
				UPDATE
					household
				SET
					household_status = 'Active'
				WHERE
					house_no = ? AND
					street = ? AND
					household_status = 'Deleted'
QUERY;
			$stmt = $pdo->prepare($query);
			$stmt->execute($address);

			// If address does not exists in archive, insert a new `household` record
			if (!($stmt->rowCount() > 0)) {
				$query = "INSERT INTO household (house_no, street) VALUES (?, ?)";
				$stmt = $pdo->prepare($query);
				$stmt->execute($address);
			}
		}

		// Insert resident record after establishing parent record (`household` record)
		$query = <<<QUERY
			INSERT INTO
				resident (fname, mname, lname, sex, bday, educ, occupation, citizenship, religion, contact_no, civil_status,
					house_no, street)
			VALUES
				(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
QUERY;

		$stmt = $pdo->prepare($query);
		$stmt->execute(array_values($_POST));

		$pdo->commit();
	}
	catch(PDOException $e) {
		$pdo->rollback();
		$file = "log.txt";
		include "../../commons/src/inc/catch-template.php";
	}
	finally {
		$message = "New resident was successfully added!";
		$redirect = "../residents.php";
		include "../../commons/src/inc/finally-template.php";
	}
}
