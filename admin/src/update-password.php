<?php
if (isset($_POST["change-password"])) {
	require_once "../../commons/src/inc/dbh.php";
	$officer_id = $_POST["officer-id"];
	$password = password_hash($_POST["new-password"], PASSWORD_DEFAULT);
	$query = "UPDATE administrator SET admin_password = ? WHERE officer_id = ?";

	try {
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(1, $password, PDO::PARAM_STR);
		$stmt->bindParam(2, $officer_id, PDO::PARAM_INT);
		$stmt->execute();
	}
	catch(PDOException $e) {
		$file = "log.txt";
		include "../../commons/src/inc/catch-template.php";
	}
	finally {
		$message = "Password was successfully changed!";
		$redirect = "../account.php";
		include "../../commons/src/inc/finally-template.php";
	}
}
