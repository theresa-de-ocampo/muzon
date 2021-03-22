<?php
if (isset($_POST["edit"])) {
	unset($_POST["edit"]);
	require_once "../../commons/src/inc/dbh.php";

	try {
		$pdo->beginTransaction();

		// Query 1: Attempt to insert updated addresss into `household` if address doesn't exists yet.
		$query = "INSERT IGNORE INTO household (house_no, street) VALUES (?, ?)";
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(1, $_POST["house-no"], PDO::PARAM_STR);
		$stmt->bindParam(2, $_POST["street"], PDO::PARAM_STR);
		$stmt->execute();

		// Query 2: Attempt to update record in `resident`.
		$query = <<<QUERY
			UPDATE 
				resident
			SET
				fname = ?,
				mname = ?,
				lname = ?,
				sex = ?,
				bday = ?,
				educ = ?,
				occupation = ?,
				citizenship = ?,
				religion = ?,
				contact_no = ?,
				civil_status = ?,
				house_no = ?,
				street = ?
			WHERE
				resident_id = ?
QUERY;
		$stmt = $pdo->prepare($query);

		$i = 1;
		foreach($_POST as $val) {
			if (!($val == $_POST["resident-id"]))
				$stmt->bindValue($i++, $val, PDO::PARAM_STR);
			else
				$stmt->bindValue($i++, $val, PDO::PARAM_INT);
		}
		$stmt->execute();
		$pdo->commit();
	}
	catch(PDOException $e) {
		$pdo->rollback();
		$file = "log.txt";
		include "../../commons/src/inc/catch-template.php";
	}
	finally {
		$message = "Update was successful!";
		$redirect = "../residents.php";
		include "../../commons/src/inc/finally-template.php";
	}
}
